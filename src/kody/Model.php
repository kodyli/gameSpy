<?php
namespace App\Src\Kody;

use Exception;

abstract class Model{
	protected $domain;
	protected $url;
	protected $apiKey;
	protected $urlParams=[];
	protected $httpParams=[];

	public function __construct(){}

	public function addUrlParam(string $key, $value){
		$this->urlParams[$key]=$value;
		return $this;
	}

	public function addHttpParams(string $key, $value){
		$this->httpParams[$key]=$value;
		return $this;
	}

	public function getUrlParams(){
		return $this->urlParams;
	}

	public function getHttpParams(){
		return $this->httpParams;
	}

	public function getUrl(){
		return $this->url;
	}

	public function getDomain(){
		return $this->domain;
	}

	
	public function getApiKey(){
		return $this->apiKey;
	}

	
	public function send(){
		try{
			$response = Http::to($this->getLink())
						->withHeader('X-Riot-Token: '.$this->getApiKey())
						->withData($this->getHttpParams())
						->asJson(true)
						->returnResponseObject()
						->get();
			if($response->status != 200){
				$msg = "{$response->status}: ";
				switch ($response->status) {
					case 400:
						$msg = $msg."Bad request";
						break;
					case 401:
						$msg = $msg."Unauthorized";
						break;
					case 403:
						$msg = $msg."Forbidden";
						break;
					case 404:
						$msg = $msg."Data not found";
						break;
					case 405:
						$msg = $msg."Method not allowed";
						break;
					case 415:
						$msg = $msg."Unsupported media type";
						break;
					case 429:
						$msg = $msg."	Rate limit exceeded";
						break;
					case 500:
						$msg = $msg."Internal server error";
						break;
					case 502:
						$msg = $msg."Bad gateway";
						break;
					case 503:
						$msg = $msg."Service unavailable";
						break;
					case 504:
						$msg = $msg."Gateway timeout";
						break;
					default:
						break;
				}
				throw new Exception($msg, 1);
			}else{
				if($this->validateResponse($response->content)){
					$this->setValues($response->content);
				}else{
					throw new Exception("Validation Error in ".get_class($this), 1);
				}
			}
		}catch (Exception $e){
			throw $e;
		}
	}
	protected abstract function validateResponse(array $response);
	protected abstract function setValues(array $response);


	public function getLink(){
		$url = $this->getDomain().$this->getUrl();
		return static::parseLink($url,$this->getUrlParams());
	}

	/*protected function parseLink(string $url){
		$regexRegion ='/({)([a-zA-Z]+)(})/';
		$callbackRegion = function($matches){
			$key = $matches[2];
			return $this->getUrlParams()[$key];
		};
		return preg_replace_callback($regexRegion,$callbackRegion,$url);

		return $this->parseLinkWithParams($url,$this->getUrlParams());
	}*/

	public static function parseLink(string $url, array $urlParams){
		$regexRegion ='/({)([a-zA-Z]+)(})/';
		$callbackRegion = function($matches) use($urlParams){
			$key = $matches[2];
			return $urlParams[$key];
		};
		return preg_replace_callback($regexRegion,$callbackRegion,$url);
	}
}