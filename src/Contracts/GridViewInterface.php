<?php

namespace Braunstetter\DataGridBundle\Contracts;

interface GridViewInterface
{
    public function getGrid(): GridInterface;
    public function getFields(): array;
    public function getActions(): array;
    public function getBulkActions(): array;
    public function hasBulkActions(): bool;

}