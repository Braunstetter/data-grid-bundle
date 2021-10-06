<?php

namespace Braunstetter\DataGridBundle;

use Braunstetter\DataGridBundle\Contracts\GridFactoryBuilderInterface;
use Braunstetter\DataGridBundle\Contracts\GridFactoryInterface;

class GridFactoryBuilder implements GridFactoryBuilderInterface
{

    public function getGridFactory(): GridFactoryInterface
    {
        return new GridFactory();
    }

}