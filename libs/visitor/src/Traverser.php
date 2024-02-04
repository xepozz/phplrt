<?php

declare(strict_types=1);

namespace Phplrt\Visitor;

class Traverser implements TraverserInterface
{
    /**
     * @param list<VisitorInterface> $visitors
     */
    final public function __construct(private array $visitors = []) {}

    public static function through(VisitorInterface ...$visitors): self
    {
        return new static($visitors);
    }

    public function with(VisitorInterface $visitor, bool $prepend = false): TraverserInterface
    {
        $fn = $prepend ? '\\array_unshift' : '\\array_push';
        $fn($this->visitors, $visitor);

        return $this;
    }

    public function without(VisitorInterface $visitor): TraverserInterface
    {
        $filter = static fn(VisitorInterface $haystack): bool => $haystack !== $visitor;
        $this->visitors = \array_filter($this->visitors, $filter);

        return $this;
    }

    /**
     * @param iterable<array-key, object> $nodes
     *
     * @return iterable<array-key, object>
     */
    public function traverse(iterable $nodes): iterable
    {
        return (new Executor($this->visitors))->execute($nodes);
    }
}
