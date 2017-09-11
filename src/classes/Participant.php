<?php
namespace App\Src\Classes;

use App\Models\Apis\Lol\Statics\ChampionApi;

class Participant{
	private $teamId;
	private $spell1Id;
	private $spell2Id;
	private $championId;
	private $summonerId;
	private $runes;
	private $masteries;

	private $_summoner;
	private $_allies;
	private $_enemies;

	public function __construct($participantDto){
		$className = get_class($this);
		foreach ($participantDto as $key => $value) {
			if(property_exists($className,$key)){
				$this->{$key} = $value;
			}
		}
	}
	public function getChampion(){
		return ChampionApi::find()->withChampionId($this->championId)->get();
	}
	public function getSummonerId(){
		return $this->summonerId;
	}

	public function getTeamId(){
		return $this->teamId;
	}
	public function getAllies($participants){

	}

	public function getEnemies($participants){}
}