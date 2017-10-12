<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;

class FillItemsDataTest extends TestCase
{
    public function testInsert(){
        $res = Curl::to('https://na1.api.riotgames.com/lol/static-data/v3/items?locale=en_US&tags=all&api_key=RGAPI-aa66a5be-b01a-4e25-a534-e494dc0ecb0a')
			->asJson(true)
			->get();
		$resData = $res['data'];
		foreach ($resData as $key => $temp_item){
			$id = intval($temp_item['id']);
			$content = json_encode($temp_item);
			DB::insert('insert into temp_items (id, content) values (?, ?)', [$id, $content]);
			$temp_champions = DB::select('select * from temp_items where id = ?', [$id]);
			$this->assertEquals($id,$temp_champions[0]->id);
			$this->assertEquals($content,$temp_champions[0]->content);
		}
		
    }
}
