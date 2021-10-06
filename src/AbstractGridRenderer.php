<?php

namespace Braunstetter\DataGridBundle;

use Braunstetter\DataGridBundle\Contracts\GridRendererEngineInterface;

class AbstractGridRenderer implements Contracts\GridRendererInterface
{

    /**
     * @inheritDoc
     */
    public function renderBlock(GridView $view, string $blockName, array $variables = []): string
    {
        // TODO: Implement renderBlock() method.
    }

    /**
     * @inheritDoc
     */
    public function searchAndRenderBlock(GridView $view, string $blockNameSuffix, array $variables = []): string
    {
        // TODO: Implement searchAndRenderBlock() method.
    }

    public function getEngine(): GridRendererEngineInterface
    {
        // TODO: Implement getEngine() method.
    }

    public function setTheme(GridView $view, mixed $themes, bool $useDefaultThemes = true)
    {
        // TODO: Implement setTheme() method.
    }
}