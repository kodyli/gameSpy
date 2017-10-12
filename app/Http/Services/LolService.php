<?php
namespace App\Http\Services;


use App\Http\Requests\SearchRequest;
use App\Src\Kody\Lol\Summoner;
use App\Src\Kody\Lol\Game;
use App\Src\Kody\Lol\Champion;


class LolService extends Service{
	public function __construct(){}

	public function getGameInfo(SearchRequest $searchRequest){
		$region = $searchRequest->input('region');
		$summonerName = $searchRequest->input('summonerName'); 
		$summonerId = $this->getSummonerId($region,$summonerName);
		return $this->getGame($region, $summonerId);
	}
	public function getSummonerId(string $region, string $summonerName){
		$summoner = new Summoner();
		$summoner -> whereRegion($region)
                -> whereSummonerName($summonerName)
                -> send();
        return $summoner -> getSummonerId();
	}

	public function getGame(string $region, int $summonerId){
		$game = new Game();
		$game ->whereRegion($region)
    				->whereSummonerId($summonerId)
    				->send();
    	return $game;
	}
	public function getChampion(int $championId){
		$champion = new Champion();
		$champion ->whereRegion('na1')
    					->whereChampionId($championId)
    					->withTag('all')
    					->send();
    	return $champion;
	}
}