<?php

declare(strict_types=1);

namespace Phplrt\Source\Tests\Unit;

use Phplrt\Source\Tests\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group('phplrt/source'), Group('unit')]
abstract class TestCase extends BaseTestCase {}
