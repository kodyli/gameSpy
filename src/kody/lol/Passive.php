<?php
namespace App\Src\Kody\Lol;

class Passive extends AAbility {
	public function __construct(){}

	public function setDescription($description){
		return parent::setDescription($description)->setToolTip($description,array());
	}
	public function fillData(array $passiveDto){
		parent::fillData($passiveDto);
	}
	protected function getImageBaseUrl(){
		return '';
		//return 'http://ddragon.leagueoflegends.com/cdn/6.24.1/img/passive';
	}
}