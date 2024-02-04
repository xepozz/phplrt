<?php

declare(strict_types=1);

namespace Phplrt\Source\Tests\Unit;

use Phplrt\Source\PreferContentReadingInterface;
use Phplrt\Source\VirtualFileInterface;
use PHPUnit\Framework\Attributes\Group;

/**
 * Note: Changing the behavior of these tests is allowed ONLY when updating
 *       a MAJOR version of the package.
 */
#[Group('phplrt/source'), Group('unit')]
class CompatibilityTest extends TestCase
{
    public function testVirtualFileCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class () implements VirtualFileInterface {
            public function getPathname(): string {}
            public function getStream() {}
            public function getContents(): string {}
            public function getHash(): string {}
        };
    }

    public function testPreferContentReadingCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class () implements PreferContentReadingInterface {};
    }
}
