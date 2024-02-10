<?php

declare(strict_types=1);

namespace Phplrt\Contracts\Lexer;

enum Channel implements ChannelInterface
{
    /**
     * Main channel for all tokens.
     */
    case DEFAULT;

    /**
     * A special channel/category of tokens, which
     * denotes a hidden (at the lexer level) token.
     */
    case HIDDEN;

    /**
     * A special channel/category of tokens for
     * a token that marks the end of the lexer.
     */
    case EOI;

    /**
     * A special channel/category of tokens for an unrecognized
     * token at the level of lexical analysis.
     */
    case UNKNOWN;

    public function getName(): string
    {
        return $this->name;
    }
}
