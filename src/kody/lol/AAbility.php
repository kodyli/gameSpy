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
	public function setToolTip(string $toolTip){
	    $this->toolTip =$toolTip;
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
		$this->setImage($abilityDto['image']);
		return $this;
	}
	protected abstract function getImageBaseUrl();

}