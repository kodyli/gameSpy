<?php
namespace App\Src\Kody\Contracts;

interface IParticipant extends ISummoner{
	public function setName(string $name);
	public function getName();
}