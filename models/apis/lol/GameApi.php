<?php
namespace App\Models\Apis\Lol;

use App\Models\Apis\Lol\LolApi;
use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Cache;
use App\Src\Classes\Game;
use App\Src\Classes\Summoner;

class GameApi extends LolApi{
	const URL = 'https://{region}.api.riotgames.com/lol/spectator/v3/active-games/by-summoner/{summonerId}';
	private $summonerId;
	private $region;
	public function __construct($region){
		parent::__construct();
		$this->setUrl(self::URL);
		$this->region = $region;
	}

	public function getGame(Summoner $summoner){
		$api = $this->getFullUrl($summoner->getSummonerId());
		if (!Cache::has($api)){
			$a =Curl::to($api)
        	->withHeader('X-Riot-Token:'.LolApi::API_KEY)
        	->withContentType('application/json')
        	->get();

        	$expiresAt = Carbon::now()->addMinutes(180);
			Cache::put($api, $a, $expiresAt);
		}
		$json = json_decode(Cache::get($api),true);
        $game = new Game($json,$summoner);
        return $game;
	}

	private function getFullUrl($summonerId){
		$regexRegion ='({region})';

		$callbackRegion = function($matches){
			return strtolower($this->region);
		};

		$replacedRegion = preg_replace_callback($regexRegion,$callbackRegion,self::URL);

		$regexRegionSummonerId ='({summonerId})';
		$callbackSummonerId = function($matches) use ($summonerId){
			return $summonerId;
		};

		return preg_replace_callback($regexRegionSummonerId,$callbackSummonerId,$replacedRegion);
	}

	public static function find($region){
		$gameApi = new GameApi($region);
		return $gameApi;
	}
}