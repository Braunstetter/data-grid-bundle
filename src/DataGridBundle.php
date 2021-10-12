<?php

namespace Braunstetter\DataGridBundle;

use Braunstetter\DataGridBundle\DependencyInjection\Compiler\DataGridCompilerPass;
use Braunstetter\DataGridBundle\DependencyInjection\DataGridBundleExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DataGridBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new DataGridCompilerPass());
    }

    public function getContainerExtension(): DataGridBundleExtension
    {
        if (null === $this->extension) {
            $this->extension = new DataGridBundleExtension();
        }

        return $this->extension;
    }
}