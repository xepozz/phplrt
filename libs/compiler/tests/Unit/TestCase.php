<?php

declare(strict_types=1);

namespace Phplrt\Compiler\Tests\Unit;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase as BaseTestCase;

#[Group('phplrt/compiler'), Group('unit')]
abstract class TestCase extends BaseTestCase {}
