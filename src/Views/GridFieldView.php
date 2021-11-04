<?php

namespace Braunstetter\DataGridBundle\Views;


use Braunstetter\DataGridBundle\Contracts\GridFieldTypeInterface;
use Braunstetter\DataGridBundle\Contracts\GridFieldViewInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

class GridFieldView implements GridFieldViewInterface
{
    private GridFieldTypeInterface $grid;

    public array $vars = [
        'attr' => []
    ];

    public function getValue(object|array $object): mixed
    {
        $accessor = PropertyAccess::createPropertyAccessor();

        if ($this->vars['mapped'] === false) {
            return null;
        }

        if (!$this->vars['getValue']) {
            if (is_object($object)) {
                return $accessor->getValue($object, $this->vars['name']);
            }

            return $accessor->getValue($object, sprintf('[%s]', $this->vars['name']));
        }

        return call_user_func($this->vars['getValue'], $object);
    }

    public function getUrl($item)
    {
        if (!$this->vars['target_url']) {
            return null;
        }

        if (is_string($this->vars['target_url'])) {
            return $this->vars['target_url'];
        }

        if (is_callable($this->vars['target_url'])) {
            return call_user_func($this->vars['target_url'], $item);
        }

        throw  throw new \InvalidArgumentException('It is not possible to create an url out of your arguments');
    }
}