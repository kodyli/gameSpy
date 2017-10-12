<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Src\Kody\Lol\Map;

class MapTest extends TestCase
{
    protected static $map;
    protected function setUp(){
        parent::setUp();
        self::$map = new Map();
    }
    protected function tearDown(){
        parent::tearDown();
        self::$map = null;
    }

    public function testNameGetterSetter(){
    	self::$map -> setName('The Crystal Scar');
    	$this->assertEquals('The Crystal Scar',self::$map->getName());
    }

    public function testImageGetterSetter(){
		self::$map -> setImage ('map8.png');
    	$this->assertEquals('map8.png',self::$map->getImage());
    }
}
