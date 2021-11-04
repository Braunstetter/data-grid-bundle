<?php

namespace Braunstetter\DataGridBundle\Contracts;

use Braunstetter\DataGridBundle\GridConfigBuilder;

interface GridConfigBuilderInterface extends GridConfigInterface
{
    public function getGridConfig(): GridConfigBuilder;
    
}