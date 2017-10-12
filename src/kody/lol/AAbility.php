<?php
namespace App\Src\Kody\Lol;

use App\Src\Kody\Contracts\IAbility;

abstract class AAbility implements IAbility {
	protected $key;
	protected $name;
	protected $description;
	protected $toolTip;
	protected $image;
	protected $demageType;
	
	public function __construct(){
	}
	public function getDemageType(){
	    return $this->demageType;
	}
	public function setDemageType($demageType){
	    $this->demageType = $demageType;
	    return $this;
	}
	public function getImage(){
	    return $this->image;
	}
	public function setImage($image){
	    $this->image =$this->getImageBaseUrl().'/'.$image;
	    return $this;
	}
	public function getToolTip(){
	    return $this->toolTip;
	}
	public function setToolTip(string $toolTip, array $effectBurn){
	    $this->toolTip =preg_replace('/<br><br>/', '<br>',  $this->parseToolTip($toolTip,$effectBurn));
	    $this->setDemageType(DamageType::getDamageTypeCss($this->toolTip));
	    return $this;
	}
	public function getDescription(){
	    return $this->description;
	}
	public function setDescription($description){
	    $this->description = $description;
	    return $this;
	}
	public function getKey(){
	    return $this->key;
	}
	public function setKey($key){
	    $this->key = $key;
	    return $this;
	}
	public function getName(){
	    return $this->name;
	}
	public function setName($name){
	    $this->name = $name;
	    return $this;
	}
	public function fillData(array $abilityDto){
		$this->setName($abilityDto['name']);
		$this->setDescription($abilityDto['description']);
		$this->setImage($abilityDto['image']['full']);
		return $this;
	}
	protected abstract function getImageBaseUrl();
	private function parseToolTip(string $toolTip, array $effectBurn){
		if(count($effectBurn)>0){
			$pattern ='|({{\s*)([a-z]+)([1-9]+)(\s*}})|';
			//{{ e2 }}, matches[1]='{{ ';matches[2]='e';matches[3]='1';matches[4]=' }}';
			$callBack = function($matches) use($effectBurn){
				$text ="";
				switch ($matches[2]) {
					case 'e':
						$index = intval($matches[3]);
						$text=$effectBurn[$index];
						break;
					default:
						# code...
						break;
				}
				return $text;
			};
			$toolTip = preg_replace_callback($pattern,$callBack,$toolTip);
		}
		return $toolTip;
	}
}