<?php
namespace App\Src\Kody\Lol;

use App\Src\Kody\Contracts\IParticipant;
use App\Src\Kody\Contracts\IChampion;

class Participant extends LolModel implements IParticipant{
	protected $levelUrl='/lol/champion-mastery/v3/champion-masteries/by-summoner/{summonerId}/by-champion/{championId}';
	protected $summonerId;
	protected $name;
	protected $champion;
	protected $bot;
	protected $teamId;
	protected $spell1;
	protected $spell2;
	protected $runs;
	protected $masteries;
	protected $championLevel;
	
	public function __construct(){
		parent::__construct();
	}

	public function getChampionLevel(){
	    return $this->championLevel;
	}
	 
	public function setChampionLevel($championLevel){
	    $this->championLevel = $championLevel;
	    return $this;
	}

	public function getMasteries(){
	    return $this->masteries;
	}
	 
	public function setMasteries($masteries){
	    $this->masteries = $masteries;
	    return $this;
	}

	public function getRuns(){
	    return $this->runs;
	}
	 
	public function setRuns($runs){
	    $this->runs = $runs;
	    return $this;
	}
	public function getSpell2(){
	    return $this->spell2;
	}
	 
	public function setSpell2($spell2){
	    $this->spell2 = $spell2;
	    return $this;
	}
	public function getSpell1(){
	    return $this->spell1;
	}
	 
	public function setSpell1($spell1){
	    $this->spell1 = $spell1;
	    return $this;
	}

	public function getTeamId(){
	    return $this->teamId;
	}
	 
	public function setTeamId(int $teamId){
	    $this->teamId = $teamId;
	    return $this;
	}

	public function getBot(){
	    return $this->bot;
	}
	 
	public function setBot(bool $bot){
	    $this->bot = $bot;
	    return $this;
	}

	public function getSummonerId(){
	    return $this->summonerId;
	}
	 
	public function setSummonerId(int $summonerId){
	    $this->summonerId = $summonerId;
	    return $this;
	}

	public function getName(){
	    return $this->name;
	}
	 
	public function setName(string $name){
	    $this->name = $name;
	    return $this;
	}

	public function getChampion(){
	    return $this->champion;
	}
	 
	public function setChampion(IChampion $champion){
	    $this->champion = $champion;
	    return $this;
	}

	protected function validateResponse(array $response){
		return true;
	}
	protected function setValues(array $response){}
}