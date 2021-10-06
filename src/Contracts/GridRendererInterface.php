<?php

namespace Braunstetter\DataGridBundle\Contracts;

use Braunstetter\DataGridBundle\GridView;

interface GridRendererInterface
{
    /**
     * Returns the engine used by this renderer.
     *
     * @return GridRendererEngineInterface The renderer engine
     */
    public function getEngine(): GridRendererEngineInterface;

    /**
     * Sets the theme(s) to be used for rendering a view and its children.
     *
     * @param GridView $view             The view to assign the theme(s) to
     * @param mixed    $themes           The theme(s). The type of these themes
     *                                   is open to the implementation.
     * @param bool     $useDefaultThemes If true, will use default themes specified
     *                                   in the renderer
     */
    public function setTheme(GridView $view, mixed $themes, bool $useDefaultThemes = true);

    /**
     * Renders a named block of the grid theme.
     *
     * @param GridView $view      The view for which to render the block
     * @param array    $variables The variables to pass to the template
     *
     * @return string The HTML markup
     */
    public function renderBlock(GridView $view, string $blockName, array $variables = []): string;

    /**
     * Searches and renders a block for a given name suffix.
     *
     * @param GridView $view      The view for which to render the block
     * @param array    $variables The variables to pass to the template
     *
     * @return string The HTML markup
     */
    public function searchAndRenderBlock(GridView $view, string $blockNameSuffix, array $variables = []): string;
}