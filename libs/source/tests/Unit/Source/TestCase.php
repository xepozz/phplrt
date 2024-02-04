<?php

declare(strict_types=1);

namespace Phplrt\Source\Tests\Unit\Source;

use Phplrt\Source\File;
use Phplrt\Source\Tests\Unit\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group('phplrt/source'), Group('unit')]
abstract class TestCase extends BaseTestCase
{
    public static function provider(): array
    {
        return [
            'File::fromSources + filename' => [
                static function () {
                    return File::fromSources(static::getSources(), static::getPathname());
                },
            ],
            'File::fromSources' => [
                static function () {
                    return File::fromSources(static::getSources());
                },
            ],
            'File::fromPathname' => [
                static function () {
                    return File::fromPathname(static::getPathname());
                },
            ],
            'File::fromSplFileInfo + SplFileInfo' => [
                static function () {
                    return File::fromSplFileInfo(new \SplFileInfo(static::getPathname()));
                },
            ],
            'File::fromResource + filename' => [
                static function () {
                    $resource = \fopen(static::getPathname(), 'rb');

                    return File::fromResource($resource, static::getPathname());
                },
            ],
            'File::fromResource' => [
                static function () {
                    return File::fromResource(\fopen(static::getPathname(), 'rb'));
                },
            ],
        ];
    }

    protected static function getSources(): string
    {
        return \file_get_contents(static::getPathname());
    }

    abstract protected static function getPathname(): string;
}
