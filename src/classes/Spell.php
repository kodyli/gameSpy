<?php
namespace App\Src\Classes;

/**
* Champion spell
*/
class Spell extends AbilityAbstract{
	public function __construct($argument){
		parent::__construct($argument);
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