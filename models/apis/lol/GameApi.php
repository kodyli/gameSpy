<?php
namespace App\Models\Apis\Lol;

use App\Models\Apis\Lol\LolApi;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Cache;
use App\Src\Classes\Game;
use App\Src\Classes\Summoner;

class GameApi extends LolApi{
	const URL = 'https://na1.api.riotgames.com/lol/spectator/v3/active-games/by-summoner';
	private $summonerId;
	public function __construct(){
		parent::__construct();
		$this->setUrl(self::URL);
	}

	public function getGame(Summoner $summoner){
		$api = $this->getFullUrl();
		if (!Cache::has($api)){
			$a =Curl::to($api)
        	->withHeader('X-Riot-Token:'.LolApi::API_KEY)
        	->withContentType('application/json')
        	->get();
        	Cache::forever($api, $a);
		}
		$json = json_decode(Cache::get($api),true);
        $game = new Game($json);
        return $game;
	}

	private function getFullUrl(){
		return "{$this->getUrl()}/{$this->summonerId}";
	}

	public static function find(){
		return new GameApi();
	}
}