<?php

namespace Braunstetter\DataGridBundle;

use Braunstetter\DataGridBundle\Contracts\GridConfigBuilderInterface;
use Braunstetter\DataGridBundle\Contracts\GridInterface;

class Grid implements GridInterface
{
    private GridConfigBuilderInterface $configBuilder;

    public function __construct(GridConfigBuilderInterface $configBuilder)
    {
        $this->configBuilder = $configBuilder;
    }

}