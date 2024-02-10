<?php

declare(strict_types=1);

namespace Phplrt\Contracts\Parser;

use Phplrt\Contracts\Source\ReadableInterface;

/**
 * An interface that implements methods for parsing source code.
 *
 * @template TNode of object
 */
interface ParserInterface
{
    /**
     * Parses sources into an abstract source tree (AST) or list of AST nodes.
     *
     * @param ReadableInterface $source
     * @return iterable<TNode>
     *
     * @throws ParserExceptionInterface
     */
    public function parse(ReadableInterface $source): iterable;
}
