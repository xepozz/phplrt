<?php

declare(strict_types=1);

namespace Phplrt\Visitor\Tests\Unit\Visitor;

use Phplrt\Visitor\Tests\Unit\Visitor\Stub\Counter;
use Phplrt\Visitor\Traverser;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\ExpectationFailedException;

#[Group('phplrt/visitor'), Group('unit')]
#[TestDox('A set of tests that check the interaction of Visitor instances with the Traversable container.')]
class VisitorsTest extends TestCase
{
    /**
     * @throws ExpectationFailedException
     */
    #[TestDox('Check that the visitor worked if added')]
    public function testVisitorAppending(): void
    {
        (new Traverser())
            ->with($a = new Counter())
            ->traverse($this->node());

        $this->assertWasCalled($a);
    }

    /**
     * @throws ExpectationFailedException
     */
    #[TestDox('Check that the several visitor worked if added')]
    public function testVisitorsAppending(): void
    {
        (new Traverser())
            ->with($a = new Counter())
            ->with($b = new Counter())
            ->traverse($this->node());

        $this->assertWasCalled($a);
        $this->assertWasCalled($b);
    }

    /**
     * @throws ExpectationFailedException
     */
    #[TestDox('Check that the several visitor is ignored if deleted')]
    public function testVisitorsRemoving(): void
    {
        (new Traverser())
            ->with($a = new Counter())
            ->with($b = new Counter())
            ->without($a)
            ->traverse($this->node());

        $this->assertWasNotCalled($a);
        $this->assertWasCalled($b);
    }

    /**
     * @throws ExpectationFailedException
     */
    private function assertWasCalled(Counter $visitor): void
    {
        $this->assertGreaterThan(0, $visitor->before);
        $this->assertGreaterThan(0, $visitor->after);
        $this->assertGreaterThan(0, $visitor->enter);
        $this->assertGreaterThan(0, $visitor->leave);
    }

    /**
     * @throws ExpectationFailedException
     */
    private function assertWasNotCalled(Counter $visitor): void
    {
        $this->assertSame(0, $visitor->before);
        $this->assertSame(0, $visitor->after);
        $this->assertSame(0, $visitor->enter);
        $this->assertSame(0, $visitor->leave);
    }
}
