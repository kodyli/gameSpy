<?php
namespace App\Src\Classes;

/**
* Champion passive
*/
class Passive extends AbilityAbstract{
	public function __construct($argument){
		parent::__construct($argument);
	}

	public function getTooltip(){
		return $this->getDesc();
	}
	protected function getImageBaseUrl(){
		return 'http://ddragon.leagueoflegends.com/cdn/6.24.1/img/passive';
	}
}