<?php
namespace App\Src\Kody\Lol;

use Illuminate\Support\Facades\DB;
use App\Src\Kody\Contracts\IChampion;

class Champion extends LolModel implements IChampion{
	protected $url ='/lol/static-data/v3/champions/{id}';
	protected $id;
	protected $enemyTips;
	protected $name;
	protected $title;
	protected $image;
	protected $passive;
	protected $allyTips;
	protected $key;
	protected $spells;
	protected $abilities=array();

	public function __construct(){}
	
	public function getAbilities(){
		if(count($this->abilities)==0){
			$abilities = array();
			$abilities[0] = $this->getPassive();
			for ($x = 1; $x <= 4; $x++){
			    $abilities[$x] = $this->getSpells()[$x-1];
			}
			$this->setAbilities($abilities);
		}
		return $this->abilities;
	}
	public function setAbilities($abilities){
	    $this->abilities = $abilities;
	    return $this;
	}
	public function whereChampionId(int $championId){
		$this->addUrlParam('id',$championId);
		return $this;
	}
	
	public function withTag($tag){
		return $this -> addHttpParams('tags',$tag);
	}

	public function getId(){
	    return $this->id;
	}
	public function setId($id){
	    $this->id = $id;
	    return $this;
	}
	public function getSpells(){
	    return $this->spells;
	}
	public function setSpells($spells){
	    $this->spells = $spells;
	    return $this;
	}

	public function getKey(){
	    return $this->key;
	}
	public function setKey($key){
	    $this->key = $key;
	    return $this;
	}
	
	public function getAllyTips(){
	    return $this->allyTips;
	}
	public function setAllyTips($allyTips){
	    $this->allyTips = $allyTips;
	    return $this;
	}
	
	public function getPassive(){
	    return $this->passive;
	}
	public function setPassive($passive){
	    $this->passive = $passive;
	    return $this;
	}
	
	public function getImage(){
	    return $this->image;
	}
	public function setImage($image){
	    $this->image = $this->getImageBaseUrl().$image;
	    return $this;
	}

	public function getTitle(){
	    return $this->title;
	}
	public function setTitle($title){
	    $this->title = $title;
	    return $this;
	}
	
	public function getName(){
	    return $this->name;
	}
	public function setName($name){
	    $this->name = $name;
	    return $this;
	}

	public function getEnemyTips(){
	    return $this->enemyTips;
	}
	public function setEnemyTips($enemyTips){
	    $this->enemyTips = $enemyTips;
	    return $this;
	}
	public function send(){
		$championId = $this->getUrlParams()['id'];
		$tempChampions = DB::select('select content from temp_champions where id = ?', [$championId]);
		if(count($tempChampions)<=0){
			parent::send();
		}else{
			$championDto = json_decode($tempChampions[0]->content,true);
			if($this->validateResponse($championDto)){
				$this->setValues($championDto);
			}
		}
	}
	protected function validateResponse(array $response){
		return true;
	}

	protected function setValues(array $response){
		$this->setId($response['id']);
		$this->setKey($response['key']);
		$this->setName($response['name']);
		$this->setTitle($response['title']);
		$this->setImage($response['image']);
		$this->setSpells($this->createSpells($response['spells']));
		$this->setPassive($this->createPassive($response['passive']));
	}
	protected function getImageBaseUrl(){
		return '';
		//return 'https://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/';
	}
	private function createSpells(array $championSpellDtos){
		$spells =array();
		foreach ($championSpellDtos as $championSpellDto) {
			$spell = $this->createSpell($championSpellDto);
			array_push($spells, $spell);
		}
		return $spells;
	}

	private function createSpell(array $championSpellDto){
		$spell = new Spell();
		$spell->fillData($championSpellDto);
		return $spell;
	}
	private function createPassive(array $passiveDto){
		$passive = new Passive();
		$passive -> fillData($passiveDto);
		return $passive;
	}
}