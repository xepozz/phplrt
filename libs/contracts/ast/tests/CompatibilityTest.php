<?php

declare(strict_types=1);

namespace Phplrt\Contracts\Ast\Tests;

use Phplrt\Contracts\Ast\NodeInterface;
use PHPUnit\Framework\Attributes\Group;

/**
 * Note: Changing the behavior of these tests is allowed ONLY when updating
 *       a MAJOR version of the package.
 */
#[Group('phplrt/ast-contracts')]
class CompatibilityTest extends TestCase
{
    public function testNodeCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class () implements NodeInterface {
            public function getIterator(): \Traversable {}
        };
    }
}
