<?php

namespace Twig\Tests\Node;

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Twig\Node\Expression\AssignNameExpression;
use Twig\Node\Expression\NameExpression;
use Twig\Node\ForNode;
use Twig\Node\Node;
use Twig\Node\PrintNode;
use Twig\Test\NodeTestCase;

class ForTest extends NodeTestCase
{
    public function testConstructor()
    {
        $keyTarget = new AssignNameExpression('key', 1);
        $valueTarget = new AssignNameExpression('item', 1);
        $seq = new NameExpression('items', 1);
        $body = new Node([new PrintNode(new NameExpression('foo', 1), 1)], [], 1);
        $else = null;
        $node = new ForNode($keyTarget, $valueTarget, $seq, null, $body, $else, 1);
        $node->setAttribute('with_loop', false);

        $this->assertEquals($keyTarget, $node->getNode('key_target'));
        $this->assertEquals($valueTarget, $node->getNode('value_target'));
        $this->assertEquals($seq, $node->getNode('seq'));
        $this->assertEquals($body, $node->getNode('body'));
        $this->assertFalse($node->hasNode('else'));

        $else = new PrintNode(new NameExpression('foo', 1), 1);
        $node = new ForNode($keyTarget, $valueTarget, $seq, null, $body, $else, 1);
        $node->setAttribute('with_loop', false);
        $this->assertEquals($else, $node->getNode('else'));
    }

    public function getTests()
    {
        $tests = [];

        $keyTarget = new AssignNameExpression('key', 1);
        $valueTarget = new AssignNameExpression('item', 1);
        $seq = new NameExpression('items', 1);
        $body = new Node([new PrintNode(new NameExpression('foo', 1), 1)], [], 1);
        $else = null;
        $node = new ForNode($keyTarget, $valueTarget, $seq, null, $body, $else, 1);
        $node->setAttribute('with_loop', false);

        $tests[] = [$node, <<<EOF
// line 1
\$__internal_compile_0 = new \Twig\Runtime\LoopIterator({$this->getVariableGetter('items')});
\$__internal_compile_1 = function (\$__internal_compile_0, &\$context, \$blocks, &\$__internal_compile_1, \$depth) {
    \$macros = \$this->macros;
    \$__internal_compile_2 = \$context;
    foreach (\$__internal_compile_0 as \$context["key"] => \$context["item"]) {
        yield {$this->getVariableGetter('foo')};
    }
    unset(\$context['key'], \$context['item']);
    \$context = array_intersect_key(\$context, \$__internal_compile_2) + \$__internal_compile_2;
    return; yield;
};
\Closure::bind(\$__internal_compile_1, \$this, self::class);
yield from \$__internal_compile_1(\$__internal_compile_0, \$context, \$blocks, \$__internal_compile_1, 0);
EOF
        ];

        $keyTarget = new AssignNameExpression('k', 1);
        $valueTarget = new AssignNameExpression('v', 1);
        $seq = new NameExpression('values', 1);
        $body = new Node([new PrintNode(new NameExpression('foo', 1), 1)], [], 1);
        $else = null;
        $node = new ForNode($keyTarget, $valueTarget, $seq, null, $body, $else, 1);
        $node->setAttribute('with_loop', true);

        $tests[] = [$node, <<<EOF
// line 1
\$__internal_compile_0 = new \Twig\Runtime\LoopIterator({$this->getVariableGetter('values')});
\$__internal_compile_1 = function (\$__internal_compile_0, &\$context, \$blocks, &\$__internal_compile_1, \$depth) {
    \$macros = \$this->macros;
    \$__internal_compile_2 = \$context;
    \$context['loop'] = new \Twig\Runtime\LoopContext(\$__internal_compile_0, \$__internal_compile_2, \$blocks, \$__internal_compile_1, \$depth);
    foreach (\$__internal_compile_0 as \$context["k"] => \$context["v"]) {
        yield {$this->getVariableGetter('foo')};
    }
    unset(\$context['k'], \$context['v'], \$context['loop']);
    \$context = array_intersect_key(\$context, \$__internal_compile_2) + \$__internal_compile_2;
    return; yield;
};
\Closure::bind(\$__internal_compile_1, \$this, self::class);
yield from \$__internal_compile_1(\$__internal_compile_0, \$context, \$blocks, \$__internal_compile_1, 0);
EOF
        ];

        $keyTarget = new AssignNameExpression('k', 1);
        $valueTarget = new AssignNameExpression('v', 1);
        $seq = new NameExpression('values', 1);
        $body = new Node([new PrintNode(new NameExpression('foo', 1), 1)], [], 1);
        $else = null;
        $node = new ForNode($keyTarget, $valueTarget, $seq, null, $body, $else, 1);
        $node->setAttribute('with_loop', true);

        $tests[] = [$node, <<<EOF
// line 1
\$__internal_compile_0 = new \Twig\Runtime\LoopIterator({$this->getVariableGetter('values')});
\$__internal_compile_1 = function (\$__internal_compile_0, &\$context, \$blocks, &\$__internal_compile_1, \$depth) {
    \$macros = \$this->macros;
    \$__internal_compile_2 = \$context;
    \$context['loop'] = new \Twig\Runtime\LoopContext(\$__internal_compile_0, \$__internal_compile_2, \$blocks, \$__internal_compile_1, \$depth);
    foreach (\$__internal_compile_0 as \$context["k"] => \$context["v"]) {
        yield {$this->getVariableGetter('foo')};
    }
    unset(\$context['k'], \$context['v'], \$context['loop']);
    \$context = array_intersect_key(\$context, \$__internal_compile_2) + \$__internal_compile_2;
    return; yield;
};
\Closure::bind(\$__internal_compile_1, \$this, self::class);
yield from \$__internal_compile_1(\$__internal_compile_0, \$context, \$blocks, \$__internal_compile_1, 0);
EOF
        ];

        $keyTarget = new AssignNameExpression('k', 1);
        $valueTarget = new AssignNameExpression('v', 1);
        $seq = new NameExpression('values', 1);
        $body = new Node([new PrintNode(new NameExpression('foo', 1), 1)], [], 1);
        $else = new PrintNode(new NameExpression('foo', 1), 1);
        $node = new ForNode($keyTarget, $valueTarget, $seq, null, $body, $else, 1);
        $node->setAttribute('with_loop', true);

        $tests[] = [$node, <<<EOF
// line 1
\$__internal_compile_0 = new \Twig\Runtime\LoopIterator({$this->getVariableGetter('values')});
\$__internal_compile_1 = function (\$__internal_compile_0, &\$context, \$blocks, &\$__internal_compile_1, \$depth) {
    \$macros = \$this->macros;
    \$__internal_compile_2 = \$context;
    \$context['loop'] = new \Twig\Runtime\LoopContext(\$__internal_compile_0, \$__internal_compile_2, \$blocks, \$__internal_compile_1, \$depth);
    foreach (\$__internal_compile_0 as \$context["k"] => \$context["v"]) {
        yield {$this->getVariableGetter('foo')};
    }
    if (0 === \$__internal_compile_0->getIndex0()) {
        yield {$this->getVariableGetter('foo')};
    }
    unset(\$context['k'], \$context['v'], \$context['loop']);
    \$context = array_intersect_key(\$context, \$__internal_compile_2) + \$__internal_compile_2;
    return; yield;
};
\Closure::bind(\$__internal_compile_1, \$this, self::class);
yield from \$__internal_compile_1(\$__internal_compile_0, \$context, \$blocks, \$__internal_compile_1, 0);
EOF
        ];

        return $tests;
    }
}
