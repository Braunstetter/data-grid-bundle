<?php

namespace Braunstetter\DataGridBundle;

use Braunstetter\DataGridBundle\Contracts\GridRegistryInterface;
use Braunstetter\DataGridBundle\Contracts\GridTypeInterface;
use Psr\Container\ContainerInterface;

class DataGridRegistry implements GridRegistryInterface
{

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritDoc
     */
    public function getType(string $name): GridTypeInterface
    {
        return $this->container->get($name);
    }

    /**
     * @inheritDoc
     */
    public function hasType(string $name): bool
    {
        return $this->container->has($name);
    }
}