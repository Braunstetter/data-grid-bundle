<?php

namespace Braunstetter\DataGridBundle;

use Braunstetter\DataGridBundle\Contracts\GridConfigInterface;
use Braunstetter\DataGridBundle\Contracts\GridInterface;
use Braunstetter\DataGridBundle\Types\Field\FieldType;
use Braunstetter\DataGridBundle\Views\GridRowView;
use Braunstetter\DataGridBundle\Views\GridView;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface;

class Grid implements GridInterface
{
    private GridConfigInterface $config;

    public function __construct(GridConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @throws ExceptionInterface
     */
    public function createView(): GridView
    {
        $type = $this->getConfig()->getType();
        $options = $this->getConfig()->getOptions();
        $gridView = $this->createGridView();

        $this->setDefaults($gridView);

        foreach ($this->config->getData() as $item) {
            $gridView->addRowView($type->buildRowView(
                $this->createGridRowView($item), $options));
        }

        $gridView->setGridFields($this->getResolveFields());
        $type->buildView($gridView, $options);

        return $gridView;
    }

    /**
     * @return GridConfigInterface
     */
    public function getConfig(): GridConfigInterface
    {
        return $this->config;
    }

    private function createGridView(): GridView
    {
        return new GridView($this);
    }

    private function createGridRowView($data): GridRowView
    {
        return new GridRowView($data);
    }

    private function setDefaults(GridView $view)
    {
        $view->vars = array_replace($view->vars, [
            'grid' => $view
        ]);
    }

    /**
     * @throws ExceptionInterface
     */
    private function getResolveFields(): array
    {
        $resolvedFields = [];

        foreach ($this->getConfig()->getFields() as $name => $values) {

            if ($values['type'] === null) {
                $fieldType = new FieldType();
            } else {
                $fieldType = new $values['type'];
            }

            $options = $fieldType->createOptions($values['options']);
            $fieldView = $fieldType->createView($name, $this, $options);
            $fieldType->finishView($fieldView, $options);
            $resolvedFields[] = $fieldView;
        }

        return $resolvedFields;
    }

}