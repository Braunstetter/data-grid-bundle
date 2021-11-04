<?php

namespace Braunstetter\DataGridBundle\Types\Field;

use Braunstetter\DataGridBundle\Contracts\GridFieldTypeInterface;
use Braunstetter\DataGridBundle\Contracts\GridFieldViewInterface;
use Braunstetter\DataGridBundle\Contracts\GridInterface;
use Braunstetter\DataGridBundle\Views\GridFieldView;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BaseFieldType implements GridFieldTypeInterface
{
    /**
     * @var OptionsResolver
     */
    private OptionsResolver $optionsResolver;

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->define('getValue')
            ->allowedTypes('callable', 'null')
            ->default(null)
            ->info('This callback allows you to change the display of this field.');

        $resolver->define('label')
            ->allowedTypes('string', 'null')
            ->default(null)
            ->info('Set a custom label for this field.');

        $resolver->define('label_sr_only')
            ->allowedTypes('bool')
            ->default(false)
            ->info('Decide if the label should be displayed only to screen readers.');

        $resolver->define('mapped')
            ->allowedTypes( 'bool')
            ->default(true)
            ->info('Decide if this field should be mapped to a value on the row entity.');

        $resolver->define('label_attr')
            ->allowedTypes('array')
            ->default([])
            ->info('Attributes special for the label.');

        $resolver->define('link_attr')
            ->allowedTypes('array')
            ->default([])
            ->info('Attributes special for the link tag.');

        $resolver->define('target_url')
            ->allowedTypes('string', 'null', 'callable')
            ->info('The target url for a clickable link.');

        $resolver->define('label_icon')
            ->allowedTypes('string', 'null')
            ->info('The path to the svg icon for the label of this field.');

        $resolver->define('value_icon')
            ->allowedTypes('string', 'null')
            ->info('The path to the svg icon for the value of this field.');
    }

    /**
     * @throws ExceptionInterface
     */
    public function createOptions(array $options): array
    {
        try {
            $options = $this->getOptionsResolver()->resolve($options);
        } catch (ExceptionInterface $e) {
            throw new $e(sprintf('An error has occurred resolving the options of the FieldType "%s": ', get_debug_type($this)) . $e->getMessage(), $e->getCode(), $e);
        }

        return $options;
    }

    public function createView(string $name, GridInterface $grid, array $options)
    {
        $view = new GridFieldView();
        $view->vars = array_merge($view->vars, $options);

        $view->vars = array_replace($view->vars, [
            'name' => $name,
            'label' => $options['label'] ?: $name,
        ]);

        return $view;
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

    public function finishView(GridFieldViewInterface $view, array $options)
    {
    }
}