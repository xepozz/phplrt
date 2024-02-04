<?php

declare(strict_types=1);

namespace Phplrt\Visitor\Tests\Unit\Visitor\Stub;

use Phplrt\Contracts\Ast\NodeInterface;

/**
 * @internal This is an internal library class, please do not use it in your code.
 * @psalm-internal Phplrt\Visitor\Tests\Unit
 */
class Node implements NodeInterface
{
    public function __construct(
        private int $id,
        /**
         * @var array<NodeInterface>
         */
        public array $children = []
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \Traversable|NodeInterface[]
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator(['children' => $this->children]);
    }

    public function getOffset(): int
    {
        return 0;
    }
}
