<?php

declare(strict_types=1);

namespace Phplrt\Exception\Tests\Unit;

use Phplrt\Exception\Tests\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group('phplrt/exception'), Group('unit')]
abstract class TestCase extends BaseTestCase {}
