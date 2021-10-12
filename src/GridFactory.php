<?php

namespace Braunstetter\DataGridBundle;

use Braunstetter\DataGridBundle\Contracts\GridBuilderInterface;
use Braunstetter\DataGridBundle\Contracts\GridFactoryInterface;
use Braunstetter\DataGridBundle\Contracts\GridInterface;
use Braunstetter\DataGridBundle\Types\GridType;
use Exception;
use Traversable;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface;

class GridFactory implements GridFactoryInterface
{
    private DataGridRegistry $registry;

    public function __construct(DataGridRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @throws ExceptionInterface
     */
    public function create(iterable $data, string $type = GridType::class, array $options = []): GridInterface
    {
        return $this->createBuilder($data, $type, $options)->getGrid();
    }

    /**
     * @throws Exception|ExceptionInterface
     */
    public function createBuilder(iterable $data, string $type = GridType::class, array $options = []): GridBuilderInterface
    {
        return $this->createNamedBuilder($this->registry->getType($type)->getBlockPrefix(), $data, $options, $type);
    }

    /**
     * @throws Exception|ExceptionInterface
     */
    private function createNamedBuilder(string $name, iterable $data = null, array $options = [], string $type = GridType::class): GridBuilderInterface
    {
        $type = $this->registry->getType($type);
        $builder = $type->createBuilder($this, $name, $data, $options);

        $type->buildGrid($builder, $builder->getOptions());

        return $builder;
    }


}