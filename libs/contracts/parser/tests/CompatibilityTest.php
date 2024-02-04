<?php

declare(strict_types=1);

namespace Phplrt\Contracts\Parser\Tests;

use Phplrt\Contracts\Parser\ParserInterface;
use PHPUnit\Framework\Attributes\Group;

#[Group('phplrt/parser-contracts')]
class CompatibilityTest extends TestCase
{
    public function testParserCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class implements ParserInterface {
            public function parse($source): iterable {}
        };
    }
}