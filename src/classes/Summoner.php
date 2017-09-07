<?php
namespace App\Src\Classes;
use App\Src\Contracts\ISummoner;

/**
* Game Player
*/
class Summoner implements ISummoner{
	public $profileIconId;
	public $name;
	public $summonerLevel;
	public $id;
	public $accountId;

	public function __construct($summonerDTO){
		$className = get_class($this);
		foreach ($summonerDTO as $key => $value) {
			if(property_exists($className,$key)){
				$this->{$key} = $value;
			}
		}
	}

	public function setSummonerId($id){
		$this->id = $id;
		return $this;
	}
	
	public function getSummonerId(){
		return $this->id;
	}

	public function getSummonerName(){
		return $this->name;
	}
}