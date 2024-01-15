<?php

namespace unit;

use app\file\xml\XMLFile;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class XMLFileTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->xml = new XMLFile();
        $this->expectedArray = [
            'book' => [
                'title' => 'Introduction to XML',
                'author' => 'John Doe',
                'price' => 19.99
            ]
        ];
    }

    /** @test */
    public function decodeXML()
    {
        $encoder = new XmlEncoder();

        $context = [
            XmlEncoder::DECODER_IGNORED_NODE_TYPES => [\XML_PI_NODE, \XML_COMMENT_NODE],
            'xml_format_output' => true,
        ];

        $xmlContent = '<?xml version="1.0" encoding="UTF-8"?>
                        <bookstore>
                          <book>
                            <title>Introduction to XML</title>
                            <author>John Doe</author>
                            <price>19.99</price>
                          </book>
                        </bookstore>';

        $decoded = $encoder->decode($xmlContent, 'xml', $context);

        $this->assertEquals($this->expectedArray, $decoded);
    }

    /**
     * @test
     * @dataProvider Exception
     */
    public function pushThrowsError($reqStorageType)
    {

        $this->expectException(\Exception::class);

        $this->xml->pushData($this->expectedArray, $reqStorageType);
    }

    public function Exception()
    {
        return [
            ['excel'],
            ['csv'],
            ['mongoDB']
        ];
    }
}