<?php
namespace App\Src\Kody\Lol;

use App\Src\Kody\Model;

abstract class LolModel extends Model {
	protected $domain ='https://{region}.api.riotgames.com';
	protected $apiKey='RGAPI-735b625f-8f62-49d6-939d-4ac9bb51158b';
	
	public function __construct(){
		//partent::__construct();
	}

	public function whereRegion(string $region){
		return $this->addUrlParam('region',$region);
	}
}