<?php

namespace Braunstetter\DataGridBundle\Types;

use Braunstetter\DataGridBundle\Contracts\GridBuilderInterface;
use Braunstetter\DataGridBundle\Contracts\GridFactoryInterface;
use Braunstetter\DataGridBundle\Contracts\GridTypeInterface;
use Braunstetter\DataGridBundle\Contracts\GridViewInterface;
use Braunstetter\DataGridBundle\GridBuilder;
use Braunstetter\DataGridBundle\Util;
use Braunstetter\DataGridBundle\Views\GridRowView;
use Braunstetter\DataGridBundle\Views\GridView;
use Pagerfanta\PagerfantaInterface;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function PHPUnit\Framework\isInstanceOf;

abstract class BaseType implements GridTypeInterface
{
    /**
     * @var OptionsResolver
     */
    private OptionsResolver $optionsResolver;

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->define('pagination_view')
            ->allowedTypes('string')
            ->default('twig')
            ->info('Define the view for the pagerfanta renderer.');

        $resolver->define('pagination_template')
            ->allowedTypes('string')
            ->default('@DataGrid/pagination/default.html.twig')
            ->info('Define the template used by the pagerfanta renderer.');

        $resolver->define('show_bulk_actions')
            ->allowedTypes('bool')
            ->default(true)
            ->info('Define if the grid should show bulk actions or not.');
    }

    public function buildGrid(GridBuilderInterface $builder, array $options)
    {
    }

    public function buildView(GridViewInterface $view, array $options): GridView
    {
        $data = $view->getGrid()->getConfig()->getData();

        if (!isset($options['pagination'])) {
            $view->vars = array_replace($view->vars, ['pagination' => $data instanceof PagerfantaInterface]);
        }

        $view->vars = array_replace($view->vars, [
            'pagination_view' => $options['pagination_view'],
            'pagination_template' => $options['pagination_template'],
        ]);

        if ($options['show_bulk_actions']) {
            foreach ($view->getActions() as $field) {
                dump($field);
            }
        }

        dump($view, $options, $view->getFields(), $view->getActions(), $view->getBulkActions());
        return $view;
    }

    public function buildRowView(GridRowView $view, array $options): GridRowView
    {
        return $view;
    }

    public function getBlockPrefix(): string
    {
        return Util::fqcnToBlockPrefix(static::class) ?: '';
    }

    /**
     * @throws ExceptionInterface
     */
    public function createBuilder(GridFactoryInterface $factory, string $name, iterable $data, array $options = []): GridBuilderInterface
    {
        try {
            $options = $this->getOptionsResolver()->resolve($options);
        } catch (ExceptionInterface $e) {
            throw new $e(sprintf('An error has occurred resolving the options of the grid "%s": ', get_debug_type($this)) . $e->getMessage(), $e->getCode(), $e);
        }

        $builder = $this->newBuilder($factory, $name, $data, $options);
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