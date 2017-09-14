<?php
namespace App\Src\Classes;

use App\Src\Contracts\IAbility;
use App\Src\Classes\DamageType;

abstract class AbilityAbstract implements IAbility{

	private $name;
	private $description;
	private $tooltip;
	private $image;

	private $effectBurn;
	private $cooldownBurn;
	private $rangeBurn;
	private $costBurn;

	private $_compiledTooltip;
	private $_damageType;

	public function __construct($argument){
		foreach ($argument as $key => $value) {
			$this->{$key} = $value;
		}
		//$this->setDamageType();
	}

	public function getName(){
		return $this->name;
	}

	public function getDesc(){
		return $this->description;
	}
	
	public function getTooltip(){
		if($this->_compiledTooltip==null){
			$this->compileTooltip();
		}
		return $this->_compiledTooltip;
	}

	public function getDamageType(){
		return $this->_damageType;
	}

	public function setDamageType($type=null){
		if($type==null){
			$type=DamageType::getDamageType($this->getTooltip());
		}
		$this->_damageType=$type;
	}

	public function getImageUrl(){
		return $this->getImageBaseUrl().'/'.$this->image['full'];
	}

	protected abstract function getImageBaseUrl();

	private function compileTooltip(){
		$effectBurn = $this->effectBurn;
		$pattern ='|({{\s*)([a-z]+)([1-9]+)(\s*}})|';
		//{{ e2 }}, matches[1]='{{ ';matches[2]='e';matches[3]='1';matches[4]=' }}';
		$callBack = function($matches){
			$text ="";
			switch ($matches[2]) {
				case 'e':
					$index = intval($matches[3]);
					$text=$this->effectBurn[$index];
					break;
				default:
					# code...
					break;
			}
			return $text;
		};
		$this->_compiledTooltip = preg_replace_callback($pattern,$callBack,$this->tooltip);
	}
}