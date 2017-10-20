<?php
namespace App\Src\Kody\Lol;

use App\Src\Kody\Model;

abstract class LolModel extends Model {
	protected $domain ='https://{region}.api.riotgames.com';
	protected $apiKey='RGAPI-6a977c8b-e9c6-416f-bda5-03962d85e118';
	
	public function __construct(){
		//partent::__construct();
	}

	public function whereRegion(string $region){
		return $this->addUrlParam('region',$region);
	}
}