<?php

namespace Braunstetter\DataGridBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DataGridExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('grid', null, ['node_class' => 'Braunstetter\DataGridBundle\Twig\Node\RenderBlockNode', 'is_safe' => ['html']]),
            new TwigFunction('grid_start', null, ['node_class' => 'Braunstetter\DataGridBundle\Twig\Node\RenderBlockNode', 'is_safe' => ['html']]),
            new TwigFunction('grid_table', null, ['node_class' => 'Braunstetter\DataGridBundle\Twig\Node\RenderBlockNode', 'is_safe' => ['html']]),
            new TwigFunction('grid_head', null, ['node_class' => 'Braunstetter\DataGridBundle\Twig\Node\RenderBlockNode', 'is_safe' => ['html']]),
            new TwigFunction('grid_body', null, ['node_class' => 'Braunstetter\DataGridBundle\Twig\Node\RenderBlockNode', 'is_safe' => ['html']]),
            new TwigFunction('grid_pager', null, ['node_class' => 'Braunstetter\DataGridBundle\Twig\Node\RenderBlockNode', 'is_safe' => ['html']]),
        ];
    }

}