<?php
namespace App\Src\Classes;

use App\Src\Contracts\IGame;
use App\Src\Classes\Participant;

class Game implements IGame{
	private $gameId;
	private $mapId;
	private $gameMode;
	private $gameType;
	private $gameQueueConfigId;
	public $participants;
	private $observers;
	private $platformId;
	private $bannedChampions;
	private $gameStartTime;
	private $gameLength;


	private $_participants;
	private $_enemies;
	private $_allies;
	private $_summoner;

	public function __construct($currentGameInfo,$summoner){
		$className = get_class($this);
		foreach ($currentGameInfo as $key => $value) {
			if(property_exists($className,$key)){
				$this->{$key} = $value;
			}
		}

		$this->setMap($this->mapId);
		$this->setSummoner($summoner);
		//$this->setParticipants($this->participants);
	}

	public function setMap($mapId){
		$this->mapId = $mapId;
	}
	public function getMap(){
		return $this->mapId;
	}

	public function getEnemies(){
		return $this->_enemies;
	}
	public function getAllies(){
		return $this->_allies;
	}
	public function setSummoner($summoner){
		$this->_summoner = $summoner;
	}

	public function getSummoner(){
		return $this->_summoner;
	}

	/**
	* set summoner
	*@var array $participants data from riot
	*/
	public function setParticipants($participants){
		$team100=array("participants"=>array(),"type"=>null);
		$team200= array("participants"=>array(),"type"=>null);

		if($this->_participants == null){
			$this->_participants = array();
		}
		foreach ($participants as $participant) {
			$_participant= new Participant($participant);
			array_push($this->_participants, $_participant);


			if($_participant->getTeamId()=='100'){
				array_push($team100["participants"], $_participant);
			}else{
				array_push($team200["participants"], $_participant);
			}

			if($team100["type"]==null&&$_participant->getSummonerId()==$this->getSummoner()->getSummonerId()){
					$team100["type"]="A";
					$team200["type"]="E";
				}
		}

		if($team100["type"]=="A"){
			$this->_allies = $team100["participants"];
			$this->_enemies = $team200["participants"];
		}else{
			$this->_allies = $team200["participants"];
			$this->_enemies = $team100["participants"];
		}

	}

	public function getParticipants(){
		return $this->_participants;
	}
	
}