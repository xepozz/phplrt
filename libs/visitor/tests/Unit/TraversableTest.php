<?php

declare(strict_types=1);

namespace Phplrt\Visitor\Tests\Unit;

use Phplrt\Visitor\Tests\Unit\Stub\Counter;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\ExpectationFailedException;

#[Group('phplrt/visitor'), Group('unit')]
#[TestDox('A set of tests that count the number of passes by nodes.')]
class TraversableTest extends TestCase
{
    /**
     * @throws ExpectationFailedException
     */
    #[TestDox('Counting the number of Visitor::before() method calls using AST node')]
    public function testNodeBefore(): void
    {
        $this->traverse($this->node(), $counter = new Counter());

        $this->assertSame(1, $counter->before);
    }

    /**
     * @throws ExpectationFailedException
     */
    #[TestDox('Counting the number of Visitor::before() method calls using array of AST nodes')]
    public function testNodesBefore(): void
    {
        $this->traverse($this->nodes(2), $counter = new Counter());

        $this->assertSame(1, $counter->before);
    }

    /**
     * @throws ExpectationFailedException
     */
    #[TestDox('Counting the number of Visitor::after() method calls using AST node')]
    public function testNodeAfter(): void
    {
        $this->traverse($this->node(), $counter = new Counter());

        $this->assertSame(1, $counter->after);
    }

    /**
     * @throws ExpectationFailedException
     */
    #[TestDox('Counting the number of Visitor::after() method calls using array of AST nodes')]
    public function testNodesAfter(): void
    {
        $this->traverse($this->nodes(2), $counter = new Counter());

        $this->assertSame(1, $counter->after);
    }

    /**
     * @throws ExpectationFailedException
     */
    #[TestDox('Counting the number of Visitor::enter() method calls using AST node')]
    public function testNodeEnter(): void
    {
        $this->traverse($this->node(), $counter = new Counter());

        $this->assertSame(self::NODES_COUNT_STUB, $counter->enter);
    }

    /**
     * @throws ExpectationFailedException
     */
    #[TestDox('Counting the number of Visitor::enter() method calls using array of AST nodes')]
    public function testNodesEnter(): void
    {
        $this->traverse($this->nodes(2), $counter = new Counter());

        $this->assertSame(self::NODES_COUNT_STUB * 2, $counter->enter);
    }

    /**
     * @throws ExpectationFailedException
     */
    #[TestDox('Counting the number of Visitor::leave() method calls using AST node')]
    public function testNodeLeave(): void
    {
        $this->traverse($this->node(), $counter = new Counter());

        $this->assertSame(self::NODES_COUNT_STUB, $counter->leave);
    }

    /**
     * @throws ExpectationFailedException
     */
    #[TestDox('Counting the number of Visitor::leave() method calls using array of AST nodes')]
    public function testNodesLeave(): void
    {
        $this->traverse($this->nodes(2), $counter = new Counter());

        $this->assertSame(self::NODES_COUNT_STUB * 2, $counter->leave);
    }
}
