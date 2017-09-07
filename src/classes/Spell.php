<?php
namespace App\Src\Classes;

/**
* Champion spell
*/
class Spell extends AbilityAbstract{
	private $_damageType;


	public function __construct($argument){
		parent::__construct($argument);
	}

	public function getDamageType(){
		if($this->_damageType ==null){
			$this->setDamageType();
		}
		return $this->_damageType;
	}

	public function setDamageType($type=null){
		if($type==null){
			$type=DamageType::getDamageType($this->getTooltip());
		}
		$this->_damageType=$type;
	}


	protected function getImageBaseUrl(){
		return 'http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell';
	}

	/**
     * Get an array of spell instance
     * @var array champion spells data from riot
     */
	public static function getSpells($spells){
		$_spells = array();
		foreach ($spells as $spell) {
			array_push($_spells,new Spell($spell));
		}
		return $_spells;
	}
}