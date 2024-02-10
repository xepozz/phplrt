<?php

declare(strict_types=1);

namespace Phplrt\Lexer\Token;

use Phplrt\Contracts\Lexer\Channel;
use Phplrt\Contracts\Lexer\ChannelInterface;
use Phplrt\Contracts\Lexer\TokenInterface;
use Phplrt\Lexer\Printer\PrettyPrinter;

class Token implements TokenInterface, \Stringable
{
    /**
     * @var int<0, max>
     */
    private readonly int $bytes;

    /**
     * @param non-empty-string|int $name
     * @param int<0, max> $offset
     */
    public function __construct(
        private readonly string|int $name,
        private readonly string $value,
        private readonly int $offset = 0,
        private readonly ChannelInterface $channel = Channel::DEFAULT,
    ) {
        $this->bytes = \strlen($this->value);
    }

    public function getName(): int|string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getBytes(): int
    {
        return $this->bytes;
    }

    public function getChannel(): ChannelInterface
    {
        return $this->channel;
    }

    public function __toString(): string
    {
        $instance = PrettyPrinter::getInstance();

        return $instance->printToken($this);
    }
}
