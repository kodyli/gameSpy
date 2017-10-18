<?php
namespace App\Src\Kody\Lol;

use App\Src\Kody\Model;

abstract class LolModel extends Model {
	protected $domain ='https://{region}.api.riotgames.com';
	protected $apiKey='RGAPI-82beffb8-7ffd-4288-94c3-fccd7e53ef96';
	
	public function __construct(){
		//partent::__construct();
	}

	public function whereRegion(string $region){
		return $this->addUrlParam('region',$region);
	}
}