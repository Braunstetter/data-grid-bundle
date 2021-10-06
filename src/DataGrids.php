<?php

namespace Braunstetter\DataGridBundle;

/**
 * Entry point of the DataGridBundle.
 *
 * @author Michael Brauner <michaelbrauner82@gmail.com>
 */
final class DataGrids
{
    /**
     * Creates a grid factory with the default configuration.
     */
    public static function createGridFactory()
    {
        return self::createFormFactoryBuilder()->getGridFactory();
    }

    /**
     * Creates a grid factory builder with the default configuration.
     */
    public static function createFormFactoryBuilder()
    {
        return new GridFactoryBuilder();
    }

    /**
     * This class cannot be instantiated.
     */
    private function __construct()
    {
    }
}