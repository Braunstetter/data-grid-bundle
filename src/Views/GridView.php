<?php

namespace Braunstetter\DataGridBundle\Views;

use Braunstetter\DataGridBundle\Contracts\GridInterface;
use Braunstetter\DataGridBundle\Contracts\GridViewInterface;
use Braunstetter\DataGridBundle\Util;

class GridView implements GridViewInterface
{
    private GridInterface $grid;

    public array $vars = [
        'attr' => []
    ];

    /**
     * @var array<GridRowView>
     */
    public array $gridRows = [];

    /**
     * @var array<GridFieldView>
     */
    public array $gridFields = [];

    public function __construct(GridInterface $grid)
    {
        $type = $grid->getConfig()->getType();

        $this->grid = $grid;
        $this->vars['unique_block_prefix'] = $grid->getConfig()->getType()->getBlockPrefix();
        $this->vars['cache_key'] = Util::fqcnToBlockPrefix($type::class) . '_' . $type->getBlockPrefix();
    }

    public function getGrid(): GridInterface
    {
        return $this->grid;
    }

    public function addRowView(GridRowView $view): static
    {
        $this->gridRows[] = $view;
        return $this;
    }

    public function setGridFields(array $fields): static
    {
        $this->gridFields = $fields;
        return $this;
    }

    public function getFields(): array
    {
        return $this->gridFields;
    }

    public function getActions(): array
    {
        return array_filter($this->gridFields, fn($field) => isset($field->vars['action_type']));
    }

    public function getBulkActions(): array
    {
        return array_filter($this->getActions(), fn($field) => isset($field->vars['bulk']) && $field->vars['bulk'] === true);
    }

    public function hasBulkActions(): bool
    {
        return !empty($this->getBulkActions());
    }
}