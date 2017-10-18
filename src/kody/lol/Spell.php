<?php
namespace App\Src\Kody\Lol;

use App\Src\Kody\Lol\AAbility;

class Spell extends AAbility {
	public function __construct(){
	}

	public function fillData(array $championSpellDto){
		parent::fillData($championSpellDto);
		$this->setToolTip($championSpellDto['tooltip']);
	}

	protected function getImageBaseUrl(){
		return '';
		return 'http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell';
	}
}