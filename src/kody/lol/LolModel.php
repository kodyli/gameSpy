<?php
namespace App\Src\Kody\Lol;

use App\Src\Kody\Model;

abstract class LolModel extends Model {
	protected $domain ='https://{region}.api.riotgames.com';
	protected $apiKey;
	
	public function __construct(){
		parent::__construct();
		$this->apiKey = config('lol.api_key');
	}

	public function whereRegion(string $region){
		return $this->addUrlParam('region',$region);
	}
}
