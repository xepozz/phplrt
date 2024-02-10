<?php

declare(strict_types=1);

namespace Phplrt\Contracts\Lexer;

/**
 * The lexical token that returns from {@see LexerInterface}.
 */
interface TokenInterface
{
    /**
     * Returns the unique name or identifier of the token.
     *
     * In the case that the token is not identified in any way in the grammar
     * (for example, quotes or curly braces), then the value ({@see getValue()})
     * of such a token can be used as a name.
     *
     * @return non-empty-string|int
     */
    public function getName(): string|int;

    /**
     * Returns the position (offset) of the token in the source, in bytes.
     *
     * @return int<0, max>
     */
    public function getOffset(): int;

    /**
     * Returns the value of the captured subgroup.
     */
    public function getValue(): string;

    /**
     * The token size in bytes.
     *
     * Please note that the actual size may differ from the number of bytes in
     * the token's value. For example, a token denoting the end of source
     * (T_EOI) can be represented as a "\0" character, but the actual size of
     * such a token is zero.
     *
     * @return int<0, max>
     */
    public function getBytes(): int;

    /**
     * Returns the channel (category) of the token.
     *
     * Note that a channel can be either a standard channel
     * ({@see Channel}) or a custom channel that implements
     * a common interface ({@see ChannelInterface}).
     */
    public function getChannel(): ChannelInterface;
}
