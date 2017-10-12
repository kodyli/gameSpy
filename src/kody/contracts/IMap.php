<?php
namespace App\Src\Kody\Contracts;

interface IMap{

	public function setName(string $name);
	public function getName();
	public function setImage(string $image);
	public function getImage();
}