<?php

declare(strict_types=1);

namespace Phplrt\Source\Reader;

use Phplrt\Contracts\Position\PositionInterface;
use Phplrt\Contracts\Source\ReadableInterface;
use Phplrt\Contracts\Source\SourceExceptionInterface;

class Reader implements ReaderInterface
{
    /**
     * Shifts the stream position to the specified line.
     *
     * @param resource $stream
     */
    private function seekToLine(mixed $stream, PositionInterface $position): void
    {
        $actual = 1;
        $expected = $position->getLine();

        while ($actual < $expected && !\feof($stream)) {
            \fgets($stream);
            $actual++;
        }
    }

    /**
     * @return resource
     * @throws SourceExceptionInterface
     */
    private function getStreamFromLine(ReadableInterface $source, PositionInterface $position): mixed
    {
        $stream = $source->getStream();

        $this->seekToLine($stream, $position);

        return $stream;
    }

    /**
     * @throws SourceExceptionInterface
     */
    public function line(ReadableInterface $source, PositionInterface $position): string
    {
        $stream = $this->getStreamFromLine($source, $position);

        return (string)\fgets($stream);
    }

    /**
     * @throws SourceExceptionInterface
     */
    public function lines(ReadableInterface $source, PositionInterface $from, PositionInterface $to): iterable
    {
        $actual = $from->getLine();
        $expected = $to->getLine();

        $stream = $this->getStreamFromLine($source, $from);

        while ($expected >= $actual && !\feof($stream)) {
            yield $actual++ => \rtrim((string)\fgets($stream), "\r\n");
        }
    }
}
