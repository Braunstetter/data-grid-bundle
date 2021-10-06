<?php
namespace Braunstetter\DataGridBundle\Contracts;

interface GridFactoryBuilderInterface
{
    /**
     * Builds and returns the factory.
     *
     * @return GridFactoryInterface The form factory
     */
    public function getGridFactory();
}