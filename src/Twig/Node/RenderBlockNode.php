<?php

namespace Braunstetter\DataGridBundle\Twig\Node;

use Twig\Compiler;
use Twig\Node\Expression\FunctionExpression;

final class RenderBlockNode extends FunctionExpression
{
    public function compile(Compiler $compiler): void
    {
        $compiler->addDebugInfo($this);
        $arguments = iterator_to_array($this->getNode('arguments'));
        $compiler->write('$this->env->getRuntime(\'Braunstetter\DataGridBundle\GridRenderer\')->renderBlock(');

        if (isset($arguments[0])) {
            $compiler->subcompile($arguments[0]);
            $compiler->raw(', \''.$this->getAttribute('name').'\'');

            if (isset($arguments[1])) {
                $compiler->raw(', ');
                $compiler->subcompile($arguments[1]);
            }
        }

        $compiler->raw(')');
    }
}