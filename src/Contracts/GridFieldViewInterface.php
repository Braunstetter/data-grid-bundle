<?php

namespace Braunstetter\DataGridBundle\Contracts;

interface GridFieldViewInterface
{
    public function getValue(object|array $object): mixed;
}