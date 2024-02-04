<?php

declare(strict_types=1);

namespace Phplrt\Buffer\Tests\Unit\Buffer;

use Phplrt\Buffer\ArrayBuffer;
use Phplrt\Buffer\BufferInterface;
use PHPUnit\Framework\Attributes\Group;

#[Group('phplrt/buffer'), Group('unit')]
class ArrayTest extends TestCase
{
    protected static function create(iterable $tokens): BufferInterface
    {
        return new ArrayBuffer($tokens);
    }
}
