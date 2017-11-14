<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Services\LolService;
use App\Http\Requests\SearchRequest;
use App\Src\Kody\Lol\Champion;
class LolController extends Controller {
    protected $lolService;
    protected $app;
	public function __construct(LolService $lolService, Application $app){
		$this->lolService=$lolService;
        $this->app = $app;
	}

    public function index(){
        return view('index');
    }

    public function getGameInfo(SearchRequest $searchRequest){
        if($this->app->environment('local')){
            $summonerName = $searchRequest->input('summonerName');
            $region = $searchRequest->input('region');
            $local =$searchRequest->input('local');
            $key = uniqid("{$summonerName}_{$region}_{$local}");
            if(!Cache::has($key)){
                $game = $this->lolService->getGameInfo($searchRequest);
                Cache::put($key,$game,200);
            } 
            return view('game')->with(['game'=>Cache::get($key)]);
        }else{
            $game = $this->lolService->getGameInfo($searchRequest);
            return view('game')->with(['game'=>$game]);
        }
    }

    public function debug(SearchRequest $searchRequest){
        $summonerName = $searchRequest->input('summonerName'); 
        if(!Cache::has($summonerName)){
            $game = $this->lolService->getGameInfo($searchRequest);
            Cache::put($summonerName,$game,200);
        }
        return view('debug')->with(['game'=>Cache::get($summonerName)]);
       /* $game = $this->lolService->getGameInfo($searchRequest);
        return view('debug')->with(['game'=>$game]);*/
    }


    public function clearData(){
        Cache::flush();
    }

    public function champion($id){
        $champion = new Champion();
        $champion->whereRegion('na1')
                    ->whereChampionId($id)
                    ->withTag('all')
                    ->send();
        return view('champion')->with(['champion'=>$champion,'borderColor'=>'borderColorD9534F']);
        //return view('champion');
    }
}