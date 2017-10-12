<?php
namespace App\Models\Apis\Lol;

use App\Models\Apis\Api;

class LolApi extends Api{

	const API_KEY ='RGAPI-6ad9b486-46f9-48e0-a0cb-4c3296a39d3e';

	public function __construct(){
		parent::__construct();
		$this->setKey(self::API_KEY);
	}
}