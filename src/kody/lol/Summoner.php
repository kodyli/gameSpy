<?php
namespace App\Src\Kody\Lol;

use App\Src\Kody\Contracts\ISummoner;

class Summoner extends LolModel implements ISummoner {
	protected $url ='/lol/summoner/v3/summoners/by-name/{summonerName}';
	protected $summonerId;
	protected $name;

	public function __construct(){
		//parent::__construct();
	}

	public function setSummonerId(int $summonerId){
		$this->summonerId = $summonerId;
		return $this;
	}
	public function getSummonerId(){
		return $this->summonerId;
	}
	public function setName(string $name){
		$this->name = $name;
	}
	public function getName(){
		return $this->name;
	}
	
	public function whereSummonerName(string $name){
		return $this->addUrlParam('summonerName',$this->replaceSpace($name));
	}

	protected function validateResponse(array $response){
		return true;
	}
	protected function setValues(array $response){
		$this->setSummonerId($response['id']);
		$this->setName($response['name']);
	}

	private function replaceSpace(string $name){
		return preg_replace('/\s+/', '%20', $name);
	}
}