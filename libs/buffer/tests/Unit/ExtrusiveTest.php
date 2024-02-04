<?php

declare(strict_types=1);

namespace Phplrt\Buffer\Tests\Unit;

use Phplrt\Buffer\BufferInterface;
use Phplrt\Buffer\ExtrusiveBuffer;
use PHPUnit\Framework\Attributes\Group;

#[Group('phplrt/buffer'), Group('unit')]
class ExtrusiveTest extends TestCase
{
    protected static function create(iterable $tokens): BufferInterface
    {
        return new ExtrusiveBuffer($tokens);
    }
}
