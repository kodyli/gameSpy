<?php
namespace App\Models\Apis\Lol;

use App\Models\Apis\Api;

class LolApi extends Api{

	const API_KEY ='RGAPI-1d9ce360-6d26-4487-9e55-52d42b72118a';

	public function __construct(){
		parent::__construct();
		$this->setKey(self::API_KEY);
	}
}