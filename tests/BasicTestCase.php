<?php

declare(strict_types=1);

class BasicTestCase extends PHPUnit\Framework\TestCase
{
    public function testCase()
    {
        $this->assertTrue(true);
    }

    public function testAnotherCase()
    {
        $this->assertFalse(false);
    }
}