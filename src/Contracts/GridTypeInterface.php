<?php

namespace Braunstetter\DataGridBundle\Contracts;

use Braunstetter\DataGridBundle\Views\GridRowView;
use Braunstetter\DataGridBundle\Views\GridView;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface GridTypeInterface
{

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

    public function buildGrid(GridBuilderInterface $builder, array $options);
    public function buildView(GridViewInterface $view, array $options): GridView;

    public function buildRowView(GridRowView $view, array $options): GridRowView;

}