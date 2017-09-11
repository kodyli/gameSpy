<?php
namespace App\Http\Services;
use App\Models\Apis\Lol\SummonerApi;
use App\Models\Apis\Lol\Statics\ChampionApi;
use App\Models\Apis\Lol\GameApi;
use App\Http\Requests\SearchRequest;
use App\Src\Classes\Participant;


class LolService extends Service{
	public function __construct(){}

	public function getGameInfo(SearchRequest $searchRequest){
		$region = $searchRequest->input('region');
		$summoner = SummonerApi::find($region)->getSummoner($searchRequest->input('summonerName'));
		$game = GameApi::find($region)->getGame($summoner);
		return $game;
	}

	/*public function getActiveGame($summonerId){
		return GameApi::find()->getGame($summonerId);
	}*/

	public function getChampion($id){
		return ChampionApi::find()->withChampionId($id)->get();
	}
}