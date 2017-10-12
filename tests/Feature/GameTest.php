<?php

namespace Tests\Feature;

use Tests\TestCase;
use Exception;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Src\Kody\Lol\Summoner;
use App\Src\Kody\Lol\Game;
use App\Src\Kody\Lol\Map;
class GameTest extends TestCase{
	protected static $game;
	protected static $summoner;
    protected function setUp(){
        parent::setUp();
        self::$summoner = new Summoner();
        self::$game = new Game();
    }

    protected function tearDown(){
        parent::tearDown();
        self::$summoner = null;
    }

    public function testMapGetterSetter(){
    	$map = new Map();
    	$map->setName('The Crystal Scar');
    	$map->setImage('map8.png');
    	self::$game->setMap($map);
		$this->assertEquals('The Crystal Scar',self::$game->getMap()->getName());
    	$this->assertEquals('http://ddragon.leagueoflegends.com/cdn/6.8.1/img/map/map8.png',self::$game->getMap()->getImage());
    }

    public function testRedTeamGetterSetter(){
    	self::$game->setRedTeam(array());
    	$this->assertTrue(count(self::$game->getRedTeam()) ==0);

    }
    public function testBlueGetterTeamSetter(){
		self::$game->setRedTeam(array());
    	$this->assertTrue(count(self::$game->getRedTeam()) ==0);
    }

    public function testSendWithException(){
    	$this->expectException(Exception::class);
		self::$summoner -> whereRegion('na1')
                        -> whereSummonerName('longmashou')
                        -> send();
		self::$game ->whereRegion('na1')
    				->whereSummonerId(self::$summoner->getSummonerId())
    				->send();
    	
    }
    public function testSend(){
    	self::$summoner -> whereRegion('na1')
                        -> whereSummonerName('Sydrel')
                        -> send();
        //$this->assertEquals(47444663,self::$summoner->getSummonerId());
                
    	self::$game ->whereRegion('na1')
    				->whereSummonerId(self::$summoner->getSummonerId())
    				->send();
    	$this->assertEquals('The Crystal Scar',self::$game->getMap()->getName());
    	$this->assertEquals('http://ddragon.leagueoflegends.com/cdn/6.8.1/img/map/map11.png',self::$game->getMap()->getImage());
    	$this->assertTrue(count(self::$game->getRedTeam()) ==5);
    	$this->assertTrue(count(self::$game->getRedTeam()) ==5);
        //$this->assertEquals(self::$game->getRedTeam()[0]->getName(),'test');

        $this->assertEquals(self::$game->getPlatformId(),'na1');
    }
}
