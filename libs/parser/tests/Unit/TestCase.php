<?php

declare(strict_types=1);

namespace Phplrt\Parser\Tests\Unit;

use Phplrt\Contracts\Ast\NodeInterface;
use Phplrt\Parser\Tests\TestCase as BaseTestCase;
use Phplrt\Visitor\Traverser;
use Phplrt\Visitor\Visitor;
use PHPUnit\Framework\Attributes\Group;

#[Group('phplrt/parser'), Group('unit')]
abstract class TestCase extends BaseTestCase
{
    protected function analyze(iterable $ast): array
    {
        $result = [];

        Traverser::through(
            new class ($result) extends Visitor {
                private $result;

                public function __construct(array &$result)
                {
                    $this->result = &$result;
                }

                public function enter(NodeInterface $node)
                {
                    $this->result[] = [$node->name, \iterator_count($node->getIterator())];
                }
            }
        )->traverse($ast);

        return $result;
    }
}
