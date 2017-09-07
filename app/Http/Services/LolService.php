<?php
namespace App\Http\Services;
use App\Models\Apis\Lol\SummonerApi;
use App\Models\Apis\Lol\Statics\ChampionApi;
use App\Models\Apis\Lol\GameApi;
use App\Http\Requests\SearchRequest;
use App\Src\Classes\Participant;


class LolService extends Service{
	public function __construct(){}

	public function getParticipantInfo(SearchRequest $searchRequest){
		$summoner = SummonerApi::find($searchRequest->input('region'))->getSummoner($searchRequest->input('summonerName'));
		//$game = GameApi::find()->getGame($summoner);
		return $summoner;
	}

	/*public function getActiveGame($summonerId){
		return GameApi::find()->getGame($summonerId);
	}*/

	public function getChampion($id){
		return ChampionApi::find()->withChampionId($id)->get();
	}
}