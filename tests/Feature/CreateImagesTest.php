<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\File;
use Ixudra\Curl\Facades\Curl;

class CreateImagesTest extends TestCase
{
    public function testInsertDir(){
 		$res = Curl::to('https://na1.api.riotgames.com/lol/static-data/v3/champions?locale=en_US&tags=image&tags=passive&tags=spells&api_key=RGAPI-18e169b7-8f35-4dc6-b6a9-070141e000dd')
			->asJson(true)
			->get();
		$resData = $res['data'];

		foreach ($resData as $key => $temp_champion){
			$key1 = $temp_champion['key'];
			$dir = public_path().'/img/'.$key1;
			$result = File::makeDirectory($dir,0775);
			if($result == true){
				$this->saveChampiionImage($temp_champion,$dir);
				$this->savePassiveImage($temp_champion['passive'],$dir);
				$this->saveSpellImages($temp_champion['spells'],$dir);	
			}
    		$this->assertTrue($result);
		}
    }
    private function saveChampiionImage(array $champion,string $path){
    	$image = $champion['image'];
    	$name = $image['full'];
    	$url = 'https://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion';
	    $this->downloadImage($url,$path,$name);

    }
    private function savePassiveImage(array $passive,string $path){
    	$image = $passive['image'];
    	$name = $image['full'];
    	$url = 'http://ddragon.leagueoflegends.com/cdn/6.24.1/img/passive';
	    $this->downloadImage($url,$path,$name);
    }
    private function saveSpellImages(array $spells,string $path){
    	foreach ($spells as $spell) {
    		$image = $spell['image'];
	    	$name = $image['full'];
	    	$url = 'http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell';
	    	$this->downloadImage($url,$path,$name);
    	}
    }

    private function downloadImage($url,$path,$name){
    	Curl::to($url.'/'.$name)
			->withContentType('image/png')
			->download($path.'/'.$name);
    }
}
