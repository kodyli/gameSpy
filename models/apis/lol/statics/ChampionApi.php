<?php

namespace App\Models\Apis\Lol\Statics;

use App\Models\Apis\Lol\LolApi;
use App\Src\Classes\Champion;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Cache;



class ChampionApi extends LolApi{	
	public $id;
	private $url = 'https://na1.api.riotgames.com/lol/static-data/v3/champions';
	public function __construct(){
		
	}

	public function withChampionId($id){
		$this->id = $id;
		return $this;
	}

	public function get(){
		$api = "{$this->url}/{$this->id}";
		if (!Cache::has($api)){
			$a =Curl::to($api)
        	->withHeader('X-Riot-Token:'.LolApi::API_KEY)
        	->withContentType('application/json')
        	->withData(array('locale' => 'en_US','tags'=>'all'))
        	->get();
        	Cache::forever($api, $a);
		}
		$json = json_decode(Cache::get($api),true);
        $champion = new Champion($json);
        return $champion;
	}

	public function list(){
		return Curl::to($this->url)
        ->withHeader('X-Riot-Token:'.LolApi::API_KEY)
        ->withContentType('application/json')
        ->withData(array('locale' => 'en_US'))
        ->get();
	}

	public static function find(){
		return new ChampionApi();
	}
}