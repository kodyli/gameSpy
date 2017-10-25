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
        $res = Curl::to('https://na1.api.riotgames.com/lol/static-data/v3/champions?locale=en_US&tags=allytips&tags=enemytips&tags=image&tags=info&tags=passive&tags=spells&tags=stats&dataById=false&api_key=RGAPI-3d71cb83-8172-4c9f-9be4-a525fe042384')
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
				case 'id':
					$values[$key] = $value;
					break;
				case 'name':
					$values[$key] = $value;
					break;
				case 'title':
					$values[$key] = $value;
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
