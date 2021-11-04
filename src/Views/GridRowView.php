<?php

namespace Braunstetter\DataGridBundle\Views;

class GridRowView
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
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

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

}