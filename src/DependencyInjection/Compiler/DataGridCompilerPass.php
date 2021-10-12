<?php

namespace Braunstetter\DataGridBundle\DependencyInjection\Compiler;

use Braunstetter\DataGridBundle\Twig\DataGridExtension;
use ReflectionClass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use function dirname;

class DataGridCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $viewDir = dirname((new ReflectionClass(DataGridExtension::class))->getFileName(), 2).'/Resources/views';

        $loader = $container->getDefinition('twig.loader.native_filesystem');
        $templateIterator = $container->getDefinition('twig.template_iterator');
        $templatePaths = $templateIterator->getArgument(1);

        $coreThemePath = $viewDir . '/Grid';
        $loader->addMethodCall('addPath', [$coreThemePath]);
        $templatePaths[$coreThemePath] = null;

        $templateIterator->replaceArgument(1, $templatePaths);
    }
}