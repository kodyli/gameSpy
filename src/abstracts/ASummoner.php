<?php	
namespace App\Src\Abstracts;


use App\Src\Contracts\ISummoner;
use App\Src\Contracts\ISummonerApi;

abstract class ASummoner implements ISummoner, ISummonerApi{
	protected $id;
	protected $name;

	public function __construct(){

	}

	public function setId(int $id){
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}
	public function setName(string $name){
		$this->name = $name;
	}
	public function getName(){
		return $this->name;
	}
	
	public static function getSummonerBy($name){
		return 'test1';
	}
}