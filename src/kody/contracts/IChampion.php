<?php
namespace App\Src\Kody\Contracts;

interface IChampion {
	public function setId($id);
	public function getId();
	public function setEnemyTips($enemyTips);
	public function getEnemyTips();

	public function setName($name);
	public function getName();
	
	public function setTitle($title);
	public function getTitle();

	public function setImage($image);
	public function getImage();

	public function setPassive($passive);
	public function getPassive();

	public function setAllyTips($allyTips);
	public function getAllyTips();

	public function setKey($key);
	public function getKey();

	public function setSpells($spells);
	public function getSpells();
	
	public function setAbilities($abilities);
	public function getAbilities();
}