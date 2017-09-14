<?php
namespace App\Models\Apis\Lol;

use App\Models\Apis\Api;

class LolApi extends Api{

	const API_KEY ='RGAPI-101915d7-9f62-4aee-b009-ca81e69c8c5d';

	public function __construct(){
		parent::__construct();
		$this->setKey(self::API_KEY);
	}
}