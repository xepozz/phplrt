<?php

declare(strict_types=1);

namespace Phplrt\Contracts\Lexer\Tests;

use Phplrt\Contracts\Lexer\ChannelInterface;
use Phplrt\Contracts\Lexer\LexerInterface;
use Phplrt\Contracts\Lexer\TokenInterface;
use Phplrt\Contracts\Source\ReadableInterface;
use PHPUnit\Framework\Attributes\Group;

/**
 * Note: Changing the behavior of these tests is allowed ONLY when updating
 *       a MAJOR version of the package.
 */
#[Group('phplrt/lexer-contracts')]
class CompatibilityTest extends TestCase
{
    public function testLexerCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class () implements LexerInterface {
            public function lex(mixed $source, int $offset = 0, int $length = null): iterable {}
        };
    }

    public function testTokenCompatibility(): void
    {
        self::expectNotToPerformAssertions();

        new class () implements TokenInterface {
            public function getName(): string|int {}
            public function getOffset(): int {}
            public function getValue(): string {}
            public function getBytes(): int {}
            public function getChannel(): ChannelInterface {}
        };
    }
}
