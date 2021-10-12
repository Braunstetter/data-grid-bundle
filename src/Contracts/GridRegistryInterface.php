<?php

namespace Braunstetter\DataGridBundle\Contracts;

use Exception;

interface GridRegistryInterface
{
    /**
     * Returns a form type by name.
     *
     * These methods register the type extensions from the form extensions.
     *
     * @return GridTypeInterface The type
     *
     * @throws Exception/InvalidArgumentException if the type can not be retrieved from any extension
     */
    public function getType(string $name): GridTypeInterface;

    /**
     * Returns whether the given form type is supported.
     *
     * @return bool Whether the type is supported
     */
    public function hasType(string $name): bool;
}