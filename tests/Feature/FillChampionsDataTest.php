<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;

class FillChampionsDataTest extends TestCase{
 
    public function testInsert(){
    	//$locals = array('en_US','zh_CN');
    	//$locals = array('cs_CZ','de_DE');
    	//$locals = array('el_GR','en_AU');
    	//$locals = array('en_GB','en_PH');
    	//$locals = array('en_SG','es_AR');
    	//$locals = array('es_ES','es_MX');
    	$locals = array('fr_FR','hu_HU');
    	//$locals = array('id_ID','it_IT');
    	//$locals = array('ja_JP','ko_KR');
    	//$locals = array('ms_MY','pl_PL');
    	//$locals = array('pt_BR','ro_RO');
    	//$locals = array('ru_RU','tr_TR');
    	//$locals = array('vn_VN','zh_TW');

    	$api_key=config('lol.api_key');
    	foreach ($locals as $local) {
    		$res = Curl::to("https://na1.api.riotgames.com/lol/static-data/v3/champions?locale={$local}&tags=allytips&tags=enemytips&tags=image&tags=info&tags=passive&tags=spells&tags=stats&dataById=false&api_key={$api_key}")
			->asJson(true)
			->get();
			$resData = $res['data'];
			foreach ($resData as $key => $temp_champion){
				$id = intval($temp_champion['id']);
				$content = json_encode($this->filter($temp_champion,$local));
				DB::insert('insert into temp_champions (id, content, local) values (?, ?, ?)', [$id, $content, $local]);
				$temp_champions = DB::select('select * from temp_champions where id = ? and local =?', [$id, $local]);
				$this->assertEquals($id,$temp_champions[0]->id);
				$this->assertEquals($content,$temp_champions[0]->content);
				$this->assertEquals($local,$temp_champions[0]->local);
			}
    	}	
    }

    private function filter(array $temp_champion, string $local='en_US'){
    	$values = array();
    	foreach ($temp_champion as $key => $value){
			switch ($key) {
				case 'id':
					$values[$key] = $value;
					break;
				case 'name':
					switch ($local) {
						case 'zh_CN':
							$values['title'] = $value;
							break;
						default:
							$values[$key] = $value;
							break;
					}
					break;
				case 'title':switch ($local) {
						case 'zh_CN':
							$values['name'] = $value;
							break;
						default:
							$values[$key] = $value;
							break;
					}
					break;
				case 'key':
					$values[$key] = $value;
					break;
	    		case 'image':
	    			$values[$key] = $this->filterImage($value);
	    			break;
    			case 'spells':
    				$values[$key] = $this->filterSpells($value);
	    			break;
	    		case 'passive':
	    			$values[$key] = $this->filterPassive($value);
	    			break;
	    		case 'info':
	    			foreach ($value as $infoKey => $infoValue) {
	    				$values[$infoKey] = $infoValue;
	    			}
	    			break;
	    		case 'stats':
	    			foreach ($value as $statsKey => $statsValue) {
	    				$values[$statsKey] = $statsValue;
	    			}
	    			break;
	    		case 'allytips':
	    			$allytips='';
	    			foreach ($value as $allytip) {
	    				$allytips = $allytips.$allytip;
	    			}
	    			$values[$key] = $allytips;
	    			break;
	    		case 'enemytips':
	    			$enemytips='';
	    			foreach ($value as $enemytip) {
	    				$enemytips = $enemytips.$enemytip;
	    			}
	    			$values[$key] = $enemytips;
	    			break;
	    		default:
	    			break;
	    	}
    	}
    	return $values;
    }
    private function filterSpells(array $spells){
		$newSpells = array();
		foreach ($spells as $spell) {
			array_push($newSpells, $this->filterSpell($spell));
		}
		return $newSpells;
    }
	private function filterSpell(array $spell){
		$newSpell = array();
		foreach ($spell as $key => $value) {
			switch ($key) {
				case 'name':
					$newSpell[$key]=$value;
					break;
				case 'key':
					$newSpell[$key]=$value;
					break;					
				case 'sanitizedDescription':
					$newSpell['description']=$this->addClasses($value);
					break;
				case 'sanitizedTooltip':
					$newSpell['tooltip'] =$this->addClasses($this->parseToolTip($value,$spell['effectBurn']));
					break;
				case 'image':
					$newSpell[$key] =$this->filterImage($value);
					break;
				default:
					break;
			}
		}
		return $newSpell;
	}

    private function filterPassive(array $passive){
    	$newPassive = array();
    	foreach ($passive as $key => $value) {
    		switch ($key) {
    			case 'name':
    				$newPassive[$key] = $value;
    				break;
    			case 'image':
    				$newPassive[$key] = $this->filterImage($value);
    				break;
    			/*case 'description':
    				break;*/
    			case 'sanitizedDescription':
    				$newPassive['description'] =$this->addClasses($value);
    				break;
    			default:
    				break;
    		}
    	}
    	return $newPassive;
    }

    private function filterImage(array $image){
    	return $image['full'];
    }
    private function addClasses(string $toolTip){
		
		$pattern1 ='|(physical\s+damage)|i';
		$callBack1 = function($matches){
			return '<span class=\'physicalDamage\'>'.$matches[1].'</span>';
		};
		$newToolTip = preg_replace_callback($pattern1,$callBack1,$toolTip);
		
		$pattern2 ='|(magic\s+damage)|i';
		$callBack2 = function($matches){
			return '<span class=\'magicDamage\'>'.$matches[1].'</span>';
		};
		$newToolTip = preg_replace_callback($pattern2,$callBack2,$newToolTip);

		$pattern3 ='|(true\s+damage)|i';
		$callBack3 = function($matches){
			return '<span class=\'trueDamage\'>'.$matches[1].'</span>';
		};
		$newToolTip = preg_replace_callback($pattern3,$callBack3,$newToolTip);

		return $newToolTip;
	}
	private function parseToolTip(string $toolTip, array $effectBurn){
		$newToolTip = $toolTip;
		if(count($effectBurn)>0){
			$pattern ='|({{\s+)([a-z]+)([1-9]+)(\s+}})|';
			//{{ e2 }}, matches[1]='{{ ';matches[2]='e';matches[3]='1';matches[4]=' }}';
			$callBack = function($matches) use($effectBurn){
				$text ="";
				switch ($matches[2]) {
					case 'e':
						$index = intval($matches[3]);
						$text=$effectBurn[$index];
						break;
					default:
						# code...
						break;
				}
				return $text;
			};
			$newToolTip = preg_replace_callback($pattern,$callBack,$toolTip);
		}
		return $newToolTip;
	}
}
