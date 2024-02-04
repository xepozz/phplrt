<?php

declare(strict_types=1);

namespace Phplrt\Source\Tests\Unit;

use Phplrt\Contracts\Source\FileInterface;
use Phplrt\Contracts\Source\ReadableInterface;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\ExpectationFailedException;

#[Group('phplrt/source'), Group('unit')]
class FileTest extends TestCase
{
    /**
     * @throws ExpectationFailedException
     */
    #[DataProvider('provider')]
    public function testSources(\Closure $factory): void
    {
        $readable = $factory();

        $this->assertSame($this->getSources(), $readable->getContents());
    }

    /**
     * @throws ExpectationFailedException
     */
    #[DataProvider('provider')]
    public function testCloneable(\Closure $factory): void
    {
        $readable = $factory();

        $this->assertSame($this->getSources(), (clone $readable)->getContents());
    }

    #[DataProvider('provider')]
    public function testSerializable(\Closure $factory): void
    {
        $readable = $factory();

        $unserialized = \unserialize(\serialize($readable));

        $this->assertSame($this->getSources(), $unserialized->getContents());
    }

    public static function filesDataProvider(): array
    {
        $filter = fn(array $cb) => $cb[0]() instanceof FileInterface;

        return \array_filter(self::provider(), $filter);
    }

    /**
     * @throws ExpectationFailedException
     */
    #[DataProvider('filesDataProvider')]
    public function testPathname(\Closure $factory): void
    {
        /** @var ReadableInterface $readable */
        $readable = $factory();

        $path = $readable->getPathname();

        $this->assertSame($path, $readable->getPathname());
        $this->assertSame($path, (clone $readable)->getPathname());
        $this->assertSame($path, \unserialize(\serialize($readable))->getPathname());
    }

    protected static function getPathname(): string
    {
        return __FILE__;
    }
}
