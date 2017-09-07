<?php
namespace App\Models\Apis\Lol;

use App\Models\Apis\Api;

class LolApi extends Api{

	const API_KEY ='RGAPI-53beb2e4-6a0a-4f4d-9aea-160b70760865';

	public function __construct(){
		parent::__construct();
		$this->setKey(self::API_KEY);
	}
}