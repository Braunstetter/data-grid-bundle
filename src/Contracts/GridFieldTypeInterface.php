<?php

namespace Braunstetter\DataGridBundle\Contracts;

use Symfony\Component\OptionsResolver\OptionsResolver;

interface GridFieldTypeInterface
{
    public function configureOptions(OptionsResolver $resolver);

    public function createOptions(array $options): array;

    public function finishView(GridFieldViewInterface $view, array $options);

}