<?php
namespace App\Src\Classes;

use App\Src\Contracts\IAbility;

/**
* 
*/
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

	public function __construct($argument){
		foreach ($argument as $key => $value) {
			$this->{$key} = $value;
		}
	}

	public function getName(){
		return $this->name;
	}

	public function getDesc(){
		return $this->description;
	}
	
	public function getTooltip(){
		if($this->_compiledTooltip==null){
			$this->_compiledTooltip = $this->compileTooltip();
		}
		return $this->_compiledTooltip;
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
	
		return preg_replace_callback($pattern,$callBack,$this->tooltip);
		//return $this->effectBurn[intval('2')];
		//return intval('2');
	}
}