<?php

declare(strict_types=1);

namespace Phplrt\Source\Tests\Unit\Source;

use Phplrt\Contracts\Source\SourceExceptionInterface;
use Phplrt\Source\Exception\NotFoundException;
use Phplrt\Source\File;
use PHPUnit\Framework\Attributes\Group;

#[Group('phplrt/source'), Group('unit')]
class ErrorsTest extends TestCase
{
    /**
     * @throws SourceExceptionInterface
     */
    public function testFileNotFound(): void
    {
        $file = __DIR__ . '/not-exists.txt';

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('File "' . $file . '" not found');

        File::fromPathname($file);
    }

    protected static function getPathname(): string
    {
        return __DIR__ . '/resources/example.txt';
    }
}
