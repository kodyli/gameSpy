<?php	
namespace App\Src\Contracts;

interface IChampion{
	public function setId($id);
	public function getId();
	public function getLevel();
}