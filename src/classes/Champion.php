<?php
namespace App\Src\Classes;

use Illuminate\Support\Facades\Cache;
use App\Src\Contracts\IChampion;
use App\Src\Classes\Passive;
use App\Src\Classes\Spell;

class Champion implements IChampion{
	
	public $id;
	public $key;
	public $name;
	public $title;
	public $info;
	public $image;
	public $skins;
	public $blurb;
	public $lore;
	public $enemytips;
	public $allytips;
	public $partype;
	public $stats;
	public $spells;
	public $recommended;
	public $passive;

	public $championLevel;
	public $championPoints;
	public $lastPlayTime;

	private $_passive;
	private $_spells;

	public function __construct($propertyMap,$championMastery){

		$className = get_class($this);
		foreach ($propertyMap as $key1 => $value1) {
			if(property_exists($className,$key1)){
				$this->{$key1} = $value1;
			}
		}

		foreach ($championMastery as $key2 => $value2) {
			if(property_exists($className,$key2)){
				$this->{$key2} = $value2;
			}
		}
		/*foreach ($propertyMap as $key => $value) {
			$this->{$key} = $value;
		}
		foreach ($championMastery as $key => $value) {
			$this->{$key} = $value;
		}*/
		$this->setPassvie($this->passive);
		$this->setSpells($this->spells);
	}

	public function setId($id){
		$this->id =$id;
	}
	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	public function getAbilities(){
		$abilities = array($this->getPassive());
		foreach ($this->getSpells() as $spell) {
			array_push($abilities,$spell);
		}
		return $abilities;
	}


	private function getPassive(){
		if($this->_passive == null){
			$this->setPassvie($this->passive);
		}
		return $this->_passive;
	}

	private function setPassvie($passive){
		$this->_passive = new Passive($passive);
	}

	public function getSpells(){
		if($this->_spells == null){
			$this->setSpells($this->spells);
		}
		return $this->_spells;
	}

	private function setSpells($spells){
		$this->_spells = Spell::getSpells($spells);
	}

	public function getLevel(){
		return $this->championLevel;
	}

	public function getLastPlayDate(){
		$seconds = $this->lastPlayTime / 1000;
		return date("m/d/Y", $seconds);
	}
}