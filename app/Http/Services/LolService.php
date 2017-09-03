<?php
namespace App\Http\Services;

use App\Models\Apis\Lol\Statics\ChampionApi;

class LolService extends Service{
	public function __construct(){}

	public function getActiveGame(){
		//ChampionApi::find()->withChampionId(86)->get();
		return ChampionApi::find()->withChampionId(86)->get();
	}
}