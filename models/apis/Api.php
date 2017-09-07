<?php
namespace App\Models\Apis;

use App\Src\Contracts\IApi;
use Ixudra\Curl\Facades\Curl;

class Api implements IApi{

	protected $apiKey;
	protected $url;

	public function __construct(){}

	public function setKey($key){
		$this->apiKey = $key;
	}
	public function getKey(){
		return $this->apiKey;
	}

	public function setUrl($url){
		$this->url=$url;
	}
	public function getUrl(){
		return $this->url;
	}
	
}