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
	private $participants;
	private $observers;
	private $platformId;
	private $bannedChampions;
	private $gameStartTime;
	private $gameLength;


	private $_participants;


	public function __construct($currentGameInfo){
		$className = get_class($this);
		foreach ($currentGameInfo as $key => $value) {
			if(property_exists($className,$key)){
				$this->{$key} = $value;
			}
		}

		$this->setMap($this->mapId);
		$this->setParticipants($this->participants);
	}

	public function setMap($mapId){
		$this->mapId = $mapId;
	}
	public function getMap(){
		return $this->mapId;
	}

	/**
	* set summoner
	*@var array $participants data from riot
	*/
	public function setParticipants($participants){
		if($this->_participants == null){
			$this->_participants = array();
		}
		foreach ($participants as $participant) {
			array_push($this->_participants, new Participant($participant));
		}
	}

	public function getParticipants(){
		return $this->_participants;
	}
	
}