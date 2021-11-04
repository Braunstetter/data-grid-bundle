<?php

namespace Braunstetter\DataGridBundle\Contracts;

interface GridConfigInterface
{
    public function getName(): string;

    public function getType(): GridTypeInterface;

    public function getOptions(): array;

    public function getData(): iterable;

    public function getFields(): array;
}