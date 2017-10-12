<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Src\Kody\Lol\Summoner;

class SummonerTest extends TestCase{
    protected static $summoner;

    protected function setUp(){
        parent::setUp();
        self::$summoner = new Summoner();
    }

    protected function tearDown(){
        parent::tearDown();
        self::$summoner = null;
    }
    public function testSummonerId(){
    	self::$summoner->setSummonerId(86);
        $this->assertEquals(86,self::$summoner->getSummonerId());
    }
    public function testHasName(){
        self::$summoner->setName('longmashou');
        $this->assertEquals('longmashou',self::$summoner->getName());
    }

    public function testWhereRegion(){
        self::$summoner -> whereRegion('na1');
        $diff = array_diff_assoc(
            [
                'region'=>'na1'
            ],
            self::$summoner->getUrlParams()
        );
        $this->assertTrue(count($diff) ==0);
    }

    public function testFindSummonerByName(){
        self::$summoner -> whereSummonerName('longmashou');

        $diff = array_diff_assoc(
            [
                'summonerName'=>'longmashou'
            ],
            self::$summoner->getUrlParams()
        );
        $this->assertTrue(count($diff) ==0);
    }

    public function testGetLink(){
        self::$summoner -> whereRegion('na1')
                        -> whereSummonerName('longmashou');
        $this->assertEquals('https://na1.api.riotgames.com/lol/summoner/v3/summoners/by-name/longmashou',self::$summoner->getLink());
    }

    public function testSend(){
        self::$summoner -> whereRegion('na1')
                        -> whereSummonerName('longmashou')
                        ->send();
        $this->assertEquals(74801162, self::$summoner->getSummonerId());
        $this->assertEquals('longmashou', self::$summoner->getName());
    }
}
