<?php

namespace Braunstetter\DataGridBundle;

use Braunstetter\DataGridBundle\Contracts\GridBuilderInterface;
use Braunstetter\DataGridBundle\Contracts\GridFactoryInterface;
use Braunstetter\DataGridBundle\Contracts\GridInterface;

class GridBuilder extends GridConfigBuilder implements GridBuilderInterface
{

    public function __construct(?string $name, GridFactoryInterface $factory, iterable $data, array $options = [])
    {
        parent::__construct($name, $options);

        $this->setGridFactory($factory)->setData($data);
    }

    public function create(string $name, iterable $data, string $type = null, array $options = []): GridBuilderInterface
    {
        return $this->getGridFactory()->createBuilder($data);
    }

    public function getGrid(): GridInterface
    {
        return new Grid($this->getGridConfig());
    }
}