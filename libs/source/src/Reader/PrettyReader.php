<?php

declare(strict_types=1);

namespace Phplrt\Source\Reader;

use Phplrt\Contracts\Position\PositionInterface;
use Phplrt\Contracts\Source\ReadableInterface;
use Phplrt\Contracts\Source\SourceExceptionInterface;

final class PrettyReader implements ReaderInterface
{
    /**
     * @param non-empty-string $depthChars The set of characters
     *        in a string that are treated as nesting depth characters.
     *        In most cases, these are spaces and tabs.
     */
    public function __construct(
        private readonly ReaderInterface $printer = new Reader(),
        private readonly string $depthChars = "\t ",
    ) {}

    /**
     * Returns the nesting depth value for the given line.
     *
     * @return int<0, max>
     */
    private function getNestingLevel(string $text): int
    {
        /** @var int<0, max> */
        return \strlen($text) - \strlen(\ltrim($text, $this->depthChars));
    }

    /**
     * @param iterable<string|\Stringable> $lines
     * @return int<0, max>
     */
    private function getMinimalNestingLevel(iterable $lines): int
    {
        $level = \PHP_INT_MAX;

        foreach ($lines as $text) {
            $text = (string) $text;

            // Compute minimal nesting level only if the line of code
            // contains non-empty text.
            if (\trim($text) !== '') {
                $level = \min($level, $this->getNestingLevel($text));
            }
        }

        if ($level === \PHP_INT_MAX) {
            return 0;
        }

        return $level;
    }

    /**
     * @throws SourceExceptionInterface
     */
    public function line(ReadableInterface $source, PositionInterface $position): string
    {
        $result = $this->printer->line($source, $position);

        return \rtrim(\ltrim((string) $result, $this->depthChars), "\r\n" . $this->depthChars);
    }

    /**
     * @throws SourceExceptionInterface
     */
    public function lines(ReadableInterface $source, PositionInterface $from, PositionInterface $to): iterable
    {
        $result = $this->printer->lines($source, $from, $to);

        if ($result instanceof \Traversable) {
            $result = \iterator_to_array($result, true);
        }

        if ($result === []) {
            return [];
        }

        $level = $this->getMinimalNestingLevel($result);

        foreach ($result as $line => $text) {
            $result[$line] = \substr((string) $text, $level);
        }

        return $result;
    }
}
