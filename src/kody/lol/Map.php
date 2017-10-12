<?php
namespace App\Src\Kody\Lol;

use App\Src\Kody\Contracts\IMap;

class Map extends LolModel implements IMap {

	protected $name;
	protected $image;

	public function __construct(){
		//parent::__construct();
	}
	public function setName(string $name){
		$this->name = $name;
		return $this;
	}
	public function getName(){
		return $this->name;
	}
	public function setImage(string $image){
		$this->image = $this->getImageBaseUrl().$image;
		return $this;
	}
	public function getImage(){
		return $this->image;
	}
	protected function validateResponse(array $response){
		return true;
	}
	protected function setValues(array $response){}
	protected function getImageBaseUrl(){
		return 'http://ddragon.leagueoflegends.com/cdn/6.8.1/img/map/';
	}
	public static function find(int $id){
		return (new static)->setName('The Crystal Scar')->setImage("map{$id}.png");
	}
}