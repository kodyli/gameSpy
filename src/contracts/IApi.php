<?php	
namespace App\Src\Contracts;

interface IApi{
	/**
	*Api key
	*@var string $key api key.
	*/
	public function setKey($key);
	public function getKey();


	/**
	*Api url
	*@var string $url api url.
	*/
	public function setUrl($url);
	public function getUrl();
}