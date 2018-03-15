<?php

namespace Laravel\Health\Tests;

use Mockery\Mock;
use PHPUnit\Framework\TestCase as PHPUnitTestCase

class TestCase extends PHPUnitTestCase
{
    public function tearDown()
    {
        \Mockery::close();
        parent::tearDownAfterClass();
    }
}