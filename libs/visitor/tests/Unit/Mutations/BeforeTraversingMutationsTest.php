<?php

declare(strict_types=1);

namespace Phplrt\Visitor\Tests\Unit\Mutations;

use Phplrt\Visitor\Tests\Unit\Stub\Node;
use Phplrt\Visitor\Tests\Unit\TestCase;
use Phplrt\Visitor\Visitor;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * @testdox A set of tests that verify an AST modification using the Visitor::before() method.
 */
#[Group('phplrt/visitor'), Group('unit')]
class BeforeTraversingMutationsTest extends TestCase
{
    /**
     * @testdox Modifying a collection of AST nodes using array return
     *
     * @throws ExpectationFailedException
     */
    public function testUpdateRootsByArrayWhenEntering(): void
    {
        $actual = $this->traverse($original = $this->nodes(2), new class () extends Visitor {
            public function before(iterable $nodes): ?iterable
            {
                return \is_array($nodes) ? [] : null;
            }
        });

        $this->assertSame([], $actual);
        $this->assertNotSame($original, $actual);
    }

    /**
     * @testdox Modifying an AST node using array return
     *
     * @throws ExpectationFailedException
     */
    public function testUpdateRootByArrayWhenEntering(): void
    {
        $actual = $this->traverse($original = $this->node(), new class () extends Visitor {
            public function before(iterable $nodes): ?iterable
            {
                return $nodes instanceof Node && $nodes->getId() === 0 ? [] : $nodes;
            }
        });

        $this->assertSame([], $actual);
        $this->assertNotSame($original, $actual);
    }

    /**
     * @testdox Modifying a collection of AST nodes using a new node object return
     *
     * @throws ExpectationFailedException
     */
    public function testUpdateRootsByNodeWhenEntering(): void
    {
        $actual = $this->traverse($original = $this->nodes(2), new class () extends Visitor {
            public function before(iterable $nodes): ?iterable
            {
                return \is_array($nodes) ? new Node(42) : null;
            }
        });

        $this->assertEquals(new Node(42), $actual);
        $this->assertNotSame($original, $actual);
    }

    /**
     * @testdox Modifying an AST node using a new node object return
     *
     * @throws ExpectationFailedException
     */
    public function testUpdateRootByNodeWhenEntering(): void
    {
        $actual = $this->traverse($original = $this->node(), new class () extends Visitor {
            public function before(iterable $nodes): ?iterable
            {
                return $nodes instanceof Node && $nodes->getId() === 0 ? new Node(42) : $nodes;
            }
        });

        $this->assertEquals(new Node(42), $actual);
        $this->assertNotSame($original, $actual);
    }
}
