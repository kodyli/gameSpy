<?php

namespace App\Models\Apis\Lol\Statics;

use App\Models\Apis\Lol\LolApi;
use App\Src\Classes\Champion;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Cache;



class ChampionApi extends LolApi{	
	private $_summonerId;
	public $id;
	const URL = 'https://na1.api.riotgames.com/lol/static-data/v3/champions';
	
	public function __construct(){
		parent::__construct();
		$this->setUrl(self::URL);
	}

	public function withChampionId($id){
		$this->id = $id;
		return $this;
	}
	public function withSummonerId($summonerId){
		$this->_summonerId= $summonerId;
		return $this;
	}
	public function get(){
		$api = $this->getFullUrl();
		if (!Cache::has($api)){
			$a =Curl::to($api)
        	->withHeader('X-Riot-Token:'.LolApi::API_KEY)
        	->withContentType('application/json')
        	->withData(array('locale' => 'en_US','tags'=>'all'))
        	->get();
        	Cache::forever($api, $a);
		}
		$json = json_decode(Cache::get($api),true);
        
        $mastery = $this->getChampionMasteryUrl($this->_summonerId,$this->id);
		if (!Cache::has($mastery)){
			$m =Curl::to($mastery)
        	->withHeader('X-Riot-Token:'.LolApi::API_KEY)
        	->withContentType('application/json')
        	->withData(array('locale' => 'en_US','tags'=>'all'))
        	->get();
        	Cache::forever($mastery, $m);
		}
		$jsonM = json_decode(Cache::get($mastery),true);
		$champion = new Champion($json,$jsonM);
        return $champion;
	}

	public function list(){
		return Curl::to($this->url)
        ->withHeader('X-Riot-Token:'.LolApi::API_KEY)
        ->withContentType('application/json')
        ->withData(array('locale' => 'en_US'))
        ->get();
	}

	private function getFullUrl(){
		return "{$this->getUrl()}/{$this->id}";
	}


	public static function find(){
		return new ChampionApi();
	}

	private function getChampionMasteryUrl($summonerId,$championId){
    	return "https://na1.api.riotgames.com/lol/champion-mastery/v3/champion-masteries/by-summoner/{$summonerId}/by-champion/{$championId}";
	}
}