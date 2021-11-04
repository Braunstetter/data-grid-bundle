<?php

namespace Braunstetter\DataGridBundle\Contracts;

interface GridBuilderInterface
{

    public function create(string $name, iterable $data, string $type = null, array $options = []): GridBuilderInterface;

    public function getGrid(): GridInterface;

    public function getOptions(): array;

    public function addField($name, array $options = [], GridFieldTypeInterface $type = null): GridBuilderInterface;

}