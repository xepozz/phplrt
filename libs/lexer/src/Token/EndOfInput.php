<?php

declare(strict_types=1);

namespace Phplrt\Lexer\Token;

final class EndOfInput extends BaseToken
{
    /**
     * @var string
     */
    private const EOI_VALUE = "\0";

    /**
     * @param int<0, max> $offset
     */
    public function __construct(private int $offset = 0) {}

    public function getName(): string
    {
        return self::END_OF_INPUT;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getValue(): string
    {
        return self::EOI_VALUE;
    }

    public function getBytes(): int
    {
        return 0;
    }

    /**
     * @return non-empty-string
     */
    public function __toString(): string
    {
        return '\0';
    }
}
