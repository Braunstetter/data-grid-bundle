<?php

namespace Braunstetter\DataGridBundle\Contracts;


use Braunstetter\DataGridBundle\Views\GridView;

interface GridRendererEngineInterface
{
    public function setTheme(GridView $view, $themes, bool $useDefaultThemes = true);
    public function getResourceForBlockName(GridView $view, string $blockName);
    public function getResourceForBlockNameHierarchy(GridView $view, array $blockNameHierarchy, int $hierarchyLevel);
    public function getResourceHierarchyLevel(GridView $view, array $blockNameHierarchy, int $hierarchyLevel);
    public function renderBlock(GridView $view, $resource, string $blockName, array $variables = []);
}