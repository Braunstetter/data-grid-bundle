<?php

namespace Braunstetter\DataGridBundle;

use Twig\Environment;
use Twig\Template;
use Braunstetter\DataGridBundle\Views\GridView;

class GridRendererEngine extends AbstractGridRendererEngine
{

    /**
     * @var Environment
     */
    private Environment $environment;

    /**
     * @var Template
     */
    private $template;

    public function __construct(array $defaultThemes, Environment $environment)
    {
        parent::__construct($defaultThemes);
        $this->environment = $environment;
    }

    public function renderBlock(GridView $view, $resource, string $blockName, array $variables = [])
    {
        $cacheKey = $view->vars[self::CACHE_KEY_VAR];

        $context = $this->environment->mergeGlobals($variables);

        ob_start();

        // By contract,This method can only be called after getting the resource
        // (which is passed to the method). Getting a resource for the first time
        // (with an empty cache) is guaranteed to invoke loadResourcesFromTheme(),
        // where the property $template is initialized.

        // We do not call renderBlock here to avoid too many nested level calls
        // (XDebug limits the level to 100 by default)
        $this->template->displayBlock($blockName, $context, $this->resources[$cacheKey]);

        return ob_get_clean();
    }

    /**
     * @inheritDoc
     */
    protected function loadResourceForBlockName(string $cacheKey, GridView $view, string $blockName): bool
    {
        // The caller guarantees that $this->resources[$cacheKey][$block] is
        // not set, but it doesn't have to check whether $this->resources[$cacheKey]
        // is set. If $this->resources[$cacheKey] is set, all themes for this
        // $cacheKey are already loaded (due to the eager population, see doc comment).
        if (isset($this->resources[$cacheKey])) {
            // As said in the previous, the caller guarantees that
            // $this->resources[$cacheKey][$block] is not set. Since the themes are
            // already loaded, it can only be a non-existing block.
            $this->resources[$cacheKey][$blockName] = false;

            return false;
        }

        // Recursively try to find the block in the themes assigned to $view,
        // then of its parent view, then of the parent view of the parent and so on.
        // When the root view is reached in this recursion, also the default
        // themes are taken into account.

        // Check each theme whether it contains the searched block
        if (isset($this->themes[$cacheKey])) {
            for ($i = \count($this->themes[$cacheKey]) - 1; $i >= 0; --$i) {
                $this->loadResourcesFromTheme($cacheKey, $this->themes[$cacheKey][$i]);
                // CONTINUE LOADING (see doc comment)
            }
        }

//        // Check the default themes once we reach the root view without success
//        if (!$view->parent) {
            if (!isset($this->useDefaultThemes[$cacheKey]) || $this->useDefaultThemes[$cacheKey]) {
                for ($i = \count($this->defaultThemes) - 1; $i >= 0; --$i) {
                    $this->loadResourcesFromTheme($cacheKey, $this->defaultThemes[$i]);
                    // CONTINUE LOADING (see doc comment)
                }
            }
//        }
//
//        // Proceed with the themes of the parent view
//        if ($view->parent) {
//            $parentCacheKey = $view->parent->vars[self::CACHE_KEY_VAR];
//
//            if (!isset($this->resources[$parentCacheKey])) {
//                $this->loadResourceForBlockName($parentCacheKey, $view->parent, $blockName);
//            }
//
//            // EAGER CACHE POPULATION (see doc comment)
//            foreach ($this->resources[$parentCacheKey] as $nestedBlockName => $resource) {
//                if (!isset($this->resources[$cacheKey][$nestedBlockName])) {
//                    $this->resources[$cacheKey][$nestedBlockName] = $resource;
//                }
//            }
//        }

        // Even though we loaded the themes, it can happen that none of them
        // contains the searched block
        if (!isset($this->resources[$cacheKey][$blockName])) {
            // Cache that we didn't find anything to speed up further accesses
            $this->resources[$cacheKey][$blockName] = false;
        }

        return false !== $this->resources[$cacheKey][$blockName];
    }

    /**
     * Loads the resources for all blocks in a theme.
     *
     * @param mixed $theme The theme to load the block from. This parameter
     *                     is passed by reference, because it might be necessary
     *                     to initialize the theme first. Any changes made to
     *                     this variable will be kept and be available upon
     *                     further calls to this method using the same theme.
     */
    protected function loadResourcesFromTheme(string $cacheKey, &$theme)
    {
        if (!$theme instanceof Template) {
            /* @var Template $theme */
            $theme = $this->environment->load($theme)->unwrap();
        }

        if (null === $this->template) {
            // Store the first Template instance that we find so that
            // we can call displayBlock() later on. It doesn't matter *which*
            // template we use for that, since we pass the used blocks manually
            // anyway.
            $this->template = $theme;
        }

        // Use a separate variable for the inheritance traversal, because
        // theme is a reference and we don't want to change it.
        $currentTheme = $theme;

        $context = $this->environment->mergeGlobals([]);

        // The do loop takes care of template inheritance.
        // Add blocks from all templates in the inheritance tree, but avoid
        // overriding blocks already set.
        do {
            foreach ($currentTheme->getBlocks() as $block => $blockData) {
                if (!isset($this->resources[$cacheKey][$block])) {
                    // The resource given back is the key to the bucket that
                    // contains this block.
                    $this->resources[$cacheKey][$block] = $blockData;
                }
            }
        } while (false !== $currentTheme = $currentTheme->getParent($context));
    }
}