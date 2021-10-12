<?php

namespace Braunstetter\DataGridBundle\Contracts;

use Braunstetter\DataGridBundle\GridConfigBuilder;

interface GridConfigBuilderInterface
{
    public function getGridConfig(): GridConfigBuilder;
    public function getName(): string;
    public function getType(): GridTypeInterface;
}