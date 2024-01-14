<?php

use app\file\xml\XMLFile;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class XMLFileTest extends TestCase
{
    public function testDecodingSuccess()
    {
        $fileName = 'test.xml';
        $fileContent = '<root><item>your data</item></root>';


    }
}