<?php

namespace Braunstetter\DataGridBundle\Views;

use Braunstetter\DataGridBundle\AbstractGridRendererEngine;
use function count;

class GridView
{

    public array $vars = [
        'unique_block_prefix' => 'blubber',
        'attr' => [],
        AbstractGridRendererEngine::CACHE_KEY_VAR => 'blah'
    ];

    /**
     * @var array<GridRowView>
     */
    public array $gridRows = [];

    private bool $rendered = false;

    public function isRendered(): bool
    {
        if (true === $this->rendered) {
            return $this->rendered;
        }

        return $this->rendered = true;
    }

    public function setRendered(): static
    {
        $this->rendered = true;

        return $this;
    }
}