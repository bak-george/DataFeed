<?php

namespace unit;

use App\app\file\AbstractFile;
use PHPUnit\Framework\TestCase;

class AbstractFileTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->abstract = new AbstractFile();

    }
}