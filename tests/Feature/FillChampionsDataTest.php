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
        $res = Curl::to('https://na1.api.riotgames.com/lol/static-data/v3/champions?locale=en_US&tags=allytips&tags=enemytips&tags=image&tags=keys&tags=passive&tags=spells&dataById=true&api_key=RGAPI-735b625f-8f62-49d6-939d-4ac9bb51158b')
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
	    			$values[$key] = $value['full'];
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
		/*foreach ($value as $spell){
			foreach ($spell as $sKey => $sValue){
				switch ($sKey) {
					case 'value':
						# code...
						break;
					default:
						# code...
						break;
				}

			}
		}*/

		return $spells;
    }

    private function filterPassive(array $passive){
    	return $passive;
    }
}
