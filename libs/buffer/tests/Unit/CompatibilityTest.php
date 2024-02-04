<?php

declare(strict_types=1);

namespace Phplrt\Buffer\Tests\Unit;

use Phplrt\Buffer\BufferInterface;
use Phplrt\Buffer\FactoryInterface;
use Phplrt\Contracts\Lexer\TokenInterface;
use PHPUnit\Framework\Attributes\Group;

/**
 * Note: Changing the behavior of these tests is allowed ONLY when updating
 *       a MAJOR version of the package.
 */
#[Group('phplrt/buffer'), Group('unit')]
class CompatibilityTest extends TestCase
{
    public function testBufferCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class () implements BufferInterface {
            public function seek($offset): void {}
            public function current(): TokenInterface {}
            public function key(): int {}
            public function valid(): bool {}
            public function rewind(): void {}
            public function next(): void {}
        };
    }

    public function testFactoryCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class () implements FactoryInterface {
            public function create(iterable $tokens, ?int $size = null): BufferInterface {}
        };
    }
}
