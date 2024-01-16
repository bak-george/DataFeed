<?php

namespace App\Tests\unit;

use App\app\file\json\JSONFile;
use PHPUnit\Framework\TestCase;

class JSONFileTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->json = new JSONFile();
        $this->expectedArray = [
            'entityId' => 340,
            'categoryName' => 'Green Mountain Ground Coffee',
            'sku' => 20,
            'name' => 'Green Mountain Coffee French Roast Ground Coffee 24 2.2oz Bag',
            'description' => 'here is a description',
            'shortdesc' => 'Green Mountain Coffee French Roast Ground Coffee 24 2.2oz Bag steeps cup after cup of smoky-sweet, complex dark roast coffee from Green Mountain Ground Coffee.',
            'price' => 41.6000,
            'link' => 'http://www.coffeeforless.com/green-mountain-coffee-french-roast-ground-coffee-24-2-2oz-bag.html',
            'image' => 'http://mcdn.coffeeforless.com/media/catalog/product/images/uploads/intro/frac_box.jpg',
            'brand' => 'Green Mountain Coffee',
            'rating' => 0,
            'caffeineType' => 'Caffeinated',
            'count' => 24,
            'flavored' => 'No',
            'seasonal' => 'No',
            'instock' => 'Yes',
            'facebook' => 1,
            'isKcup' => 0,
            'fileName' => 'test.xml',
        ];

    }

    /** @test */
    public function testingTheDecoding()
    {
        $result = $this->json->decoding('test.json');

        $this->assertEquals($this->expectedArray, $result);
    }
}