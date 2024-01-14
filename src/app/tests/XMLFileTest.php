<?php

namespace app\tests;

use app\file\AbstractFile;
use app\file\xml\XMLFile;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class XMLFileTest extends TestCase
{
    private $prophet;

    public function testDecoding()
    {

    }

    protected function setUp(): void
    {
        $this->prophet = new Prophet;
    }

    protected function tearDown(): void
    {
        $this->prophet->checkPredictions();
    }
}