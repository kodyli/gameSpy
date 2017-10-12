<?php
namespace App\Src\Kody\Contracts;

interface IAbility{
	
	public function setKey($key);
	public function getKey();
	public function setName($name);
	public function getName();
	public function setDescription($description);
	public function getDescription();
	public function setToolTip(string $toolTip, array $effectBurn);
	public function getToolTip();
	public function setImage($image);
	public function getImage();
	public function setDemageType($demageType);
	public function getDemageType();
}