<?php

declare(strict_types=1);

namespace Phplrt\Contracts\Lexer;

use Phplrt\Contracts\Source\ReadableInterface;

/**
 * An interface that is an abstract implementation of a lexer.
 */
interface LexerInterface
{
    /**
     * Returns a set of token objects from the passed source.
     *
     * @psalm-mutation-free This method may not be pure, but it does not change
     *                      the internal state of the lexer and can be used in
     *                      asynchronous and parallel computing.
     *
     * @param ReadableInterface $source Source object to lex.
     * @param int<0, max> $offset Initial offset in bytes, relative to which the
     *        lexical analysis of the source code MUST be started.
     * @param int<1, max>|null $length Length of sources for analysis. If the
     *        length parameter is specified as {@see null}, then the source MUST
     *        be analyzed to the end.
     * @return iterable<TokenInterface> List of analyzed tokens.
     *
     * @throws LexerExceptionInterface An error occurs before source processing
     *         starts, when the given source cannot be recognized or if the
     *         lexer settings contain errors.
     * @throws LexerRuntimeExceptionInterface An exception that occurs after
     *         starting the lexical analysis and indicates problems in the
     *         analyzed source.
     */
    public function lex(ReadableInterface $source, int $offset = 0, int $length = null): iterable;
}
