<?php

namespace Braunstetter\DataGridBundle\Contracts;

use Braunstetter\DataGridBundle\Views\GridView;

interface GridInterface
{
    public function createView(): GridView;
    public function getConfig(): GridConfigInterface;
}