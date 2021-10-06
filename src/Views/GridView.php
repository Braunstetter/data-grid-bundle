<?php

namespace Braunstetter\DataGridBundle;

class GridView
{
    /**
     * The variables assigned to this view.
     */
    public array $vars = [
        'attr' => [],
    ];

    /**
     * @var array<GridRowView>
     */
    public array $gridRows = [];
}