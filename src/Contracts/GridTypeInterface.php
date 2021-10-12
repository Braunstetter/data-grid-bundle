<?php

namespace Braunstetter\DataGridBundle\Contracts;

use Symfony\Component\OptionsResolver\Exception\ExceptionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface GridTypeInterface
{
    public function buildGrid(GridBuilderInterface $builder, array $options);

    public function buildView();

    public function finishView();

    /**
     * @throws ExceptionInterface
     */
    public function createBuilder(GridFactoryInterface $factory, string $name, iterable $data, array $options = []): GridBuilderInterface;

    public function configureOptions(OptionsResolver $resolver);

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     *
     * @return string The prefix of the template block name
     */
    public function getBlockPrefix(): string;



}