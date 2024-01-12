<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use Symfony\Component\Serializer\Encoder\XmlEncoder;

$options = getopt('', ['file:']);

$fileName = (string)$options['file'];

$filePath = __DIR__ . '/../../../inputFiles/' . $fileName;

if (file_exists($filePath)) {
    echo "The file $fileName exists in the folder.";
} else {
    echo "The file $fileName does not exist in the folder.";
}

$xmlEncoder = new XmlEncoder();

$context = [
    XmlEncoder::DECODER_IGNORED_NODE_TYPES => [\XML_PI_NODE, \XML_COMMENT_NODE],
    'xml_format_output' => true,
];
/*
$xmlContent = '<?xml version="1.0" encoding="utf-8"?><catalog><item><entity_id>340</entity_id><CategoryName><![CDATA[Green Mountain Ground Coffee]]></CategoryName><sku>20</sku><name><![CDATA[Green Mountain Coffee French Roast Ground Coffee 24 2.2oz Bag]]></name><description></description><shortdesc><![CDATA[Green Mountain Coffee French Roast Ground Coffee 24 2.2oz Bag steeps cup after cup of smoky-sweet, complex dark roast coffee from Green Mountain Ground Coffee.]]></shortdesc><price>41.6000</price><link>http://www.coffeeforless.com/green-mountain-coffee-french-roast-ground-coffee-24-2-2oz-bag.html</link><image>http://mcdn.coffeeforless.com/media/catalog/product/images/uploads/intro/frac_box.jpg</image><Brand><![CDATA[Green Mountain Coffee]]></Brand><Rating>0</Rating><CaffeineType>Caffeinated</CaffeineType><Count>24</Count><Flavored>No</Flavored><Seasonal>No</Seasonal><Instock>Yes</Instock><Facebook>1</Facebook><IsKCup>0</IsKCup></item><item><entity_id>340</entity_id><CategoryName><![CDATA[Green Mountain Ground Coffee]]></CategoryName><sku>20</sku><name><![CDATA[Green Mountain Coffee French Roast Ground Coffee 24 2.2oz Bag]]></name><description></description><shortdesc><![CDATA[Green Mountain Coffee French Roast Ground Coffee 24 2.2oz Bag steeps cup after cup of smoky-sweet, complex dark roast coffee from Green Mountain Ground Coffee.]]></shortdesc><price>41.6000</price><link>http://www.coffeeforless.com/green-mountain-coffee-french-roast-ground-coffee-24-2-2oz-bag.html</link><image>http://mcdn.coffeeforless.com/media/catalog/product/images/uploads/intro/frac_box.jpg</image><Brand><![CDATA[Green Mountain Coffee]]></Brand><Rating>0</Rating><CaffeineType>Caffeinated</CaffeineType><Count>24</Count><Flavored>No</Flavored><Seasonal>No</Seasonal><Instock>Yes</Instock><Facebook>1</Facebook><IsKCup>0</IsKCup></item></catalog>';
*/
if (is_readable($file)) {
    $xmlContent = file_get_contents($file);
}

$decodedArray = $xmlEncoder->decode($xmlContent, 'xml', $context);

var_dump($decodedArray);