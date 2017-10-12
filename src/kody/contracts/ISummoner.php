<?php
namespace App\Src\Kody\Contracts;

interface ISummoner{
	public function setSummonerId(int $summonerId);
	public function getSummonerId();
}