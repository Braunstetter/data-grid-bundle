<?php

namespace Braunstetter\DataGridBundle\Contracts;


interface GridBuilderInterface
{
    /**
     * Creates a grid builder.
     *
     * @param string $name The name of the grid or the name of the property
     * @param iterable $data The iterable data rows of this grid
     * @param string|null $type The type of the grid or null if name is a property
     * @param array<string, mixed> $options
     *
     * @return self
     */
    public function create(string $name, iterable $data, string $type = null, array $options = []): GridBuilderInterface;

    public function getGrid() : GridInterface;

}