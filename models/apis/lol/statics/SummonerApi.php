<?php

namespace App\Models\Apis\Lol;

use App\Models\Apis\Lol\LolApi;
use App\Http\Requests\SearchRequest;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Cache;
use App\Src\Classes\Summoner;


class SummonerApi extends LolApi{

	const URL = 'https://{region}.api.riotgames.com/lol/summoner/v3/summoners/by-name/{summonerName}';

	private $region;

	public function getSummoner($summonerName){
		$api = $this->getFullUrl($summonerName);
		if (!Cache::has($api)){
			$a =Curl::to($api)
        	->withHeader('X-Riot-Token:'.LolApi::API_KEY)
        	->withContentType('application/json')
        	->get();
        	Cache::forever($api, $a);
		}
		$json = json_decode(Cache::get($api),true);
        $summoner = new Summoner($json);
        return $summoner;
	}

	public function setRegion($region){
		$this->region = $region;
	}

	public static function find($region){
		$summonerApi = new SummonerApi();
		$summonerApi->setRegion($region);
		return $summonerApi;
	}

	

	public function getFullUrl($summonerName){

		$regexRegion ='({region})';

		$callbackRegion = function($matches){
			return strtolower($this->region);
		};

		$replacedRegion = preg_replace_callback($regexRegion,$callbackRegion,self::URL);

		$regexRegionSummonerName ='({summonerName})';
		$callbackSummonerName = function($matches)use ($summonerName){
			return strtolower($summonerName);
		};

		return preg_replace_callback($regexRegionSummonerName,$callbackSummonerName,$replacedRegion);
	}
}