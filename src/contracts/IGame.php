<?php	
namespace App\Src\Contracts;

interface IGame{
	public function getEnemies();
	public function getAllies();
	public function getMap();
}