<?php
namespace App\Src\Kody\Contracts;

interface IGame{
	public function setMap(IMap $map);
	public function getMap();
	public function setRedTeam(array $participants);
	public function getRedTeam();
	public function setBlueTeam(array $participants);
	public function getBlueTeam();
}