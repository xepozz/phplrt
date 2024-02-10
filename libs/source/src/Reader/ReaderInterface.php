<?php

declare(strict_types=1);

namespace Phplrt\Source\Reader;

use Phplrt\Contracts\Position\PositionInterface;
use Phplrt\Contracts\Source\ReadableInterface;

interface ReaderInterface
{
    /**
     * Returns expected line from the given source.
     */
    public function line(ReadableInterface $source, PositionInterface $position): string|\Stringable;

    /**
     * Returns expected lines from the given source.
     *
     * @return iterable<int<1, max>, string|\Stringable>
     */
    public function lines(ReadableInterface $source, PositionInterface $from, PositionInterface $to): iterable;
}
