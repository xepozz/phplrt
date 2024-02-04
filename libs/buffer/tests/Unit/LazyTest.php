<?php

declare(strict_types=1);

namespace Phplrt\Buffer\Tests\Unit;

use Phplrt\Buffer\BufferInterface;
use Phplrt\Buffer\LazyBuffer;
use PHPUnit\Framework\Attributes\Group;

#[Group('phplrt/buffer'), Group('unit')]
class LazyTest extends TestCase
{
    protected static function create(iterable $tokens): BufferInterface
    {
        return new LazyBuffer($tokens);
    }
}
