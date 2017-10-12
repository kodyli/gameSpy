<?php
namespace App\Src\Kody\Lol;

use App\Src\Kody\Contracts\IGame;
use App\Src\Kody\Contracts\IMap;
use App\Src\Kody\Lol\Champion;

class Game extends LolModel implements IGame {
	protected $url ='/lol/spectator/v3/active-games/by-summoner/{summonerId}';
	protected $platformId;
	protected $gameId;
	protected $map;
	protected $blueTeam=[];
	protected $redTeam=[];

	protected $team1;
	protected $team2;

	public function __construct(){
		//parent::__construct();
	}

	public function getPlatformId(){
	    return $this->platformId;
	}
	 
	public function setPlatformId($platformId){
	    $this->platformId =strtolower($platformId);
	    return $this;
	}
	public function setMap(IMap $map){
		$this->map = $map;
		return $this;
	}
	public function getMap(){
		return $this->map;
	}
	public function setRedTeam(array $participants){
		$this->redTeam = $participants;
		return $this;
	}
	public function getRedTeam(){
		return $this->redTeam;

	}
	public function setBlueTeam(array $participants){
		$this->blueTeam = $participants;
		return $this;
	}
	public function getBlueTeam(){
		return $this->blueTeam;
	}

	public function whereSummonerId(int $summonerId){
		$this->addUrlParam('summonerId',$summonerId);
		return $this;
	}

	protected function validateResponse(array $response){
		return true;
	}
	protected function setValues(array $response){
		$this->setPlatformId($response['platformId']);
		$map = Map::find($response['mapId']);
		$this->setMap($map);
		$this->buildTeams($response['participants'],$this->getUrlParams()['summonerId']);
		
	}
	private function buildTeams(array $participants,int $blueTeamFlag){
		$team100=array("participants"=>array(),"type"=>null);
		$team200= array("participants"=>array(),"type"=>null);

		foreach ($participants as $currentGameParticipant) {
			$participantObj= $this->createParticipant($currentGameParticipant);
			
			if($participantObj->getTeamId()==100){
				array_push($team100["participants"], $participantObj);
			}else{
				array_push($team200["participants"], $participantObj);
			}

			if($team100["type"]==null&& $participantObj->getSummonerId()==$blueTeamFlag){
					$team100["type"]="A";
					$team200["type"]="E";
				}
		}

		if($team100["type"]=="A"){
			$this->setRedTeam($team200["participants"]);
			$this->setBlueTeam($team100["participants"]);
		}else{
			$this->setRedTeam($team100["participants"]);
			$this->setBlueTeam($team200["participants"]);
		}
	}

	private function createParticipant($currentGameParticipant){
		$participantObj= new Participant();
		$participantObj->setTeamId($currentGameParticipant['teamId']);
		$participantObj->setSummonerId($currentGameParticipant['summonerId']);
		$participantObj->setName($currentGameParticipant['summonerName']);
		$champion = $this->createChampion($currentGameParticipant['championId']);
		$participantObj->setChampion($champion);

		$championLevel = $this->getChampionLevel($participantObj->getSummonerId(),$participantObj->getChampion()->getId());
		$participantObj->setChampionLevel($championLevel);
		return $participantObj;
	}

	private function createChampion($championId){
		$champion = new Champion();
		$champion->whereRegion($this->getPlatformId())
				->whereChampionId($championId)
				->withTag('all')
				->send();
		return $champion;
	}

	private function getChampionLevel(int $summonerId, int $championId){
		return 6;
	}
}