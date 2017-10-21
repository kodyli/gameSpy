<?php
namespace App\Src\Kody\Lol;

use App\Src\Kody\Model;

abstract class LolModel extends Model {
	protected $domain ='https://{region}.api.riotgames.com';
	protected $apiKey='RGAPI-a7ae6748-98dc-4318-9db1-a71cf9f46678';
	
	public function __construct(){
		//partent::__construct();
	}

	public function whereRegion(string $region){
		return $this->addUrlParam('region',$region);
	}
}
