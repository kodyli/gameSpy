<?php
namespace App\Src\Kody\Lol;

use App\Src\Kody\Model;

abstract class LolModel extends Model {
	protected $domain ='https://{region}.api.riotgames.com';
	protected $apiKey='RGAPI-86ce1f5f-aac8-4eb0-a579-550377e41b6a';
	
	public function __construct(){
		//partent::__construct();
	}

	public function whereRegion(string $region){
		return $this->addUrlParam('region',$region);
	}
}