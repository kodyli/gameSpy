<?php
namespace App\Src\Classes;

use App\Src\Contracts\IAbility;
use App\Src\Classes\DamageType;

abstract class AbilityAbstract implements IAbility{

	private $name;
	private $description;
	private $tooltip;
	public $image;

	private $effectBurn;
	private $cooldownBurn;
	private $rangeBurn;
	private $costBurn;
	protected $key = null;

	private $_compiledTooltip;
	private $_damageType;

	public function __construct($argument){

		$className = get_class($this);
		foreach ($argument as $key1 => $value1) {
			if(property_exists($className,$key1)){
				$this->{$key1} = $value1;
			}
		}
		$this->setTooltip();
	}

	public function getName(){
		return $this->name;
	}

	public function getDesc(){
		return $this->description;
	}
	public function setTooltip(){
		$this->compileTooltip();
		$this->_compiledTooltip=preg_replace('/<br><br>/', '', $this->_compiledTooltip);
	}
	public function getTooltip(){
		return $this->_compiledTooltip;
	}

	public function getDamageTypeCss(){
		return DamageType::getDamageTypeCss($this->getTooltip());
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
	public function getKey(){
		if($this->key == null){
			$this->key = preg_replace('/[^\w]+/', '', $this->name);
		}
		return $this->key;
	}
}