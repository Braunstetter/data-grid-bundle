<?php

namespace Braunstetter\DataGridBundle\DependencyInjection;

use Braunstetter\DataGridBundle\Contracts\FieldTypeInterface;
use Braunstetter\DataGridBundle\Contracts\GridTypeInterface;
use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class DataGridBundleExtension extends Extension
{
    /**
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');


        $container->registerForAutoconfiguration(GridTypeInterface::class)
            ->addTag('grid.type');

        $container->registerForAutoconfiguration(FieldTypeInterface::class)
            ->addTag('grid.field_type');
    }
}