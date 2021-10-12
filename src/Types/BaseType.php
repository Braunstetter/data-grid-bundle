<?php

namespace Braunstetter\DataGridBundle\Types;

use Braunstetter\DataGridBundle\Contracts\GridBuilderInterface;
use Braunstetter\DataGridBundle\Contracts\GridFactoryInterface;
use Braunstetter\DataGridBundle\Contracts\GridTypeInterface;
use Braunstetter\DataGridBundle\GridBuilder;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class BaseType implements GridTypeInterface
{
    /**
     * @var OptionsResolver
     */
    private OptionsResolver $optionsResolver;

    public function buildGrid(GridBuilderInterface $builder, array $options)
    {
    }

    public function buildView()
    {
        // TODO: Implement buildView() method.
    }

    public function finishView()
    {
        // TODO: Implement finishView() method.
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // TODO: Implement configureOptions() method.
    }

    public function getBlockPrefix(): string
    {
        return static::fqcnToBlockPrefix(static::class) ?: '';
    }

    /**
     * @throws ExceptionInterface
     */
    public function createBuilder(GridFactoryInterface $factory, string $name, iterable $data, array $options = []): GridBuilderInterface
    {
        try {
            $options = $this->getOptionsResolver()->resolve($options);
        } catch (ExceptionInterface $e) {
            throw new $e(sprintf('An error has occurred resolving the options of the form "%s": ', get_debug_type($this)).$e->getMessage(), $e->getCode(), $e);
        }

        $builder = $this->newBuilder($factory, $name, $data , $options);
        $builder->setType($this);

        return $builder;
    }
    /**
     * Creates a new builder instance.
     *
     * Override this method if you want to customize the builder class.
     *
     * @return GridBuilderInterface The new builder instance
     */
    protected function newBuilder(GridFactoryInterface $factory, string $name, iterable $data, array $options): GridBuilderInterface
    {
        return new GridBuilder($name, $factory, $data, $options);
    }

    /**
     * Converts a fully-qualified class name to a block prefix.
     *
     * @param string $fqcn The fully-qualified class name
     *
     * @return string|null The block prefix or null if not a valid FQCN
     */
    public static function fqcnToBlockPrefix(string $fqcn): ?string
    {
        // Non-greedy ("+?") to match "type" suffix, if present
        if (preg_match('~([^\\\\]+?)(type)?$~i', $fqcn, $matches)) {
            return strtolower(preg_replace(['/([A-Z]+)([A-Z][a-z])/', '/([a-z\d])([A-Z])/'], ['\\1_\\2', '\\1_\\2'], $matches[1]));
        }

        return null;
    }

    /**
     * @return OptionsResolver
     */
    public function getOptionsResolver(): OptionsResolver
    {
        if (!isset($this->optionsResolver)) {
            $this->optionsResolver = new OptionsResolver();
        }

        $this->configureOptions($this->optionsResolver);

        return $this->optionsResolver;
    }

}