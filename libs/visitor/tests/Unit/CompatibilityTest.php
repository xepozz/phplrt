<?php

declare(strict_types=1);

namespace Phplrt\Visitor\Tests\Unit;

use Phplrt\Contracts\Ast\NodeInterface;
use Phplrt\Visitor\ExecutorInterface;
use Phplrt\Visitor\TraverserInterface;
use Phplrt\Visitor\VisitorInterface;
use PHPUnit\Framework\Attributes\Group;

/**
 * Note: Changing the behavior of these tests is allowed ONLY when updating
 *       a MAJOR version of the package.
 */
#[Group('phplrt/visitor'), Group('unit')]
class CompatibilityTest extends TestCase
{
    public function testExecutorCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class implements ExecutorInterface {
            public function execute(iterable $nodes): iterable {}
        };
    }

    public function testTraverserCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class implements TraverserInterface {
            public function with(VisitorInterface $visitor, bool $prepend = false): TraverserInterface {}
            public function without(VisitorInterface $visitor): TraverserInterface {}
            public function traverse(iterable $nodes): iterable {}
        };
    }

    public function testVisitorCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class implements VisitorInterface {
            public function before(iterable $nodes): ?iterable {}
            public function enter(NodeInterface $node) {}
            public function leave(NodeInterface $node) {}
            public function after(iterable $nodes): ?iterable {}
        };
    }
}
