<?php

namespace Braunstetter\DataGridBundle\Types\Field;

use Braunstetter\DataGridBundle\Contracts\GridFieldViewInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActionType extends BaseFieldType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->define('action_type')
            ->allowedTypes('string')
            ->default('default')
            ->info('Set the type of this action.');

        $resolver->define('bulk')
            ->allowedTypes('bool')
            ->default(false)
            ->info('Is this action used for bulk operations?');

        $resolver->setRequired('target_url');

        $resolver->setDefaults(
            [
                'mapped' => false,
                'label_sr_only' => true
            ],
        );

    }

    public function finishView(GridFieldViewInterface $view, array $options)
    {
        parent::finishView($view, $options);

        $view->vars = array_replace($view->vars, [
            'link_attr' => ['class' => 'action action-' . $options['action_type']],
        ]);
    }


}