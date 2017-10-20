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
        $res = Curl::to('https://na1.api.riotgames.com/lol/static-data/v3/champions?locale=en_US&tags=allytips&tags=enemytips&tags=image&tags=keys&tags=passive&tags=spells&dataById=true&api_key=RGAPI-6a977c8b-e9c6-416f-bda5-03962d85e118')
			->asJson(true)
			->get();
		$resData = $res['data'];
		foreach ($resData as $key => $temp_champion){
			$id = intval($temp_champion['id']);
			$content = json_encode($this->filter($temp_champion));
			DB::insert('insert into temp_champions (id, content) values (?, ?)', [$id, $content]);
			$temp_champions = DB::select('select * from temp_champions where id = ?', [$id]);
			$this->assertEquals($id,$temp_champions[0]->id);
			$this->assertEquals($content,$temp_champions[0]->content);
		}
		
    }

    private function filter(array $temp_champion){
    	$values = array();
    	foreach ($temp_champion as $key => $value){
			switch ($key) {
	    		case 'image':
	    			$values[$key] = $this->filterImage($value);
	    			break;
    			case 'spells':
    				$values[$key] = $this->filterSpells($value);
	    			break;
	    		case 'passive':
	    			$values[$key] = $this->filterPassive($value);
	    			break;
	    		default:
	    			$values[$key] = $value;
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
				case 'description':
					break;
				case 'sanitizedDescription':
					$newSpell['description']=$this->addClasses($value);
					break;
				case 'tooltip':
					/*$newSpell[$key] = preg_replace('/<br><br>/', '<br>',  $this->parseToolTip($value,$spell['effectBurn']));*/
					break;
				case 'sanitizedTooltip':
					$newSpell['tooltip'] =$this->addClasses($this->parseToolTip($value,$spell['effectBurn']));
					break;
				case 'leveltip':
					break;
				case 'image':
					$newSpell[$key] =$this->filterImage($value);
					break;
				case 'resource':
					break;
				case 'maxrank':
					break;
				case 'cost':
					break;
				case 'costType':
					break;
				case 'costBurn':
					break;
				case 'cooldown':
					break;
				case 'cooldownBurn':
					break;
				case 'effect':
					break;
				case 'effectBurn':
					break;
				case 'vars':
					break;
				case 'range':
					break;
				default:
					$newSpell[$key]=$value;
					break;
			}
		}
		return $newSpell;
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

    private function filterPassive(array $passive){
    	$newPassive = array();
    	foreach ($passive as $key => $value) {
    		switch ($key) {
    			case 'image':
    				$newPassive[$key] = $this->filterImage($value);
    				break;
    			case 'description':
    				break;
    			case 'sanitizedDescription':
    				$newPassive['description'] =$this->addClasses($value);
    				break;
    			default:
    				$newPassive[$key] = $value;
    				break;
    		}
    	}
    	return $newPassive;
    }

    private function filterImage(array $image){
    	return $image['full'];
    }
}
