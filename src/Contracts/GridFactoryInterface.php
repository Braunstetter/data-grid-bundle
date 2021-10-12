<?php

namespace Braunstetter\DataGridBundle\Contracts;

use Braunstetter\DataGridBundle\Types\GridType;
use Traversable;

interface GridFactoryInterface
{
    public function create(Traversable $data, string $type = GridType::class, array $options = []): GridInterface;
    public function createBuilder(Traversable $data, string $type = GridType::class, array $options = []): GridBuilderInterface;
}