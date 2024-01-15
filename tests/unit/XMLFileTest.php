<?php

namespace unit;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class XMLFileTest extends TestCase
{
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
        $expectedArray = [
            'book' => [
                'title' => 'Introduction to XML',
                'author' => 'John Doe',
                'price' => 19.99
            ]
        ];

        $this->assertEquals($expectedArray, $decoded);
    }
}