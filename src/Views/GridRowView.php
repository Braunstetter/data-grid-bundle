<?php

namespace Braunstetter\DataGridBundle\Views;

class GridRowView
{
    private GridView $gridView;

    public function __construct(GridView $gridView)
    {
        $this->gridView = $gridView;
    }

    /**
     * The variables assigned to this view.
     */
    public array $vars = [
        'attr' => [],
    ];

    /**
     * The child views.
     *
     * @var array<GridRowView>
     */
    public array $children = [];

    public function getGridView() : GridView
    {
        return $this->getGridView();
    }
}