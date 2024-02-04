<?php

declare(strict_types=1);

namespace Phplrt\Contracts\Source\Tests;

use Phplrt\Contracts\Source\FileInterface;
use Phplrt\Contracts\Source\ReadableInterface;
use Phplrt\Contracts\Source\SourceExceptionInterface;
use Phplrt\Contracts\Source\SourceFactoryInterface;
use PHPUnit\Framework\Attributes\Group;

#[Group('phplrt/source-contracts')]
class CompatibilityTest extends TestCase
{
    public function testFileCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class implements FileInterface {
            public function getPathname(): string {}

            public function getStream() {}
            public function getContents(): string {}
            public function getHash(): string {}
        };
    }

    public function testReadableCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class implements ReadableInterface {
            public function getStream() {}
            public function getContents(): string {}
            public function getHash(): string {}
        };
    }

    public function testSourceExceptionCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class extends \Exception implements SourceExceptionInterface {};
    }

    public function testSourceFactoryCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class implements SourceFactoryInterface {
            public function create($source): ReadableInterface {}
            public function createFromString(string $content = '', string $name = null): ReadableInterface {}
            public function createFromFile(string $filename): FileInterface {}
            public function createFromStream($stream, string $name = null): ReadableInterface {}
        };
    }
}