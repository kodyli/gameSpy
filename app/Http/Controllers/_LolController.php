<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Services\LolService;
use App\Http\Requests\SearchRequest;

class _LolController extends Controller {
    protected $lolService;
	public function __construct(LolService $lolService){
		$this->lolService=$lolService;
	}

    public function index(){
        return view('index');
    }

    public function getParticipantInfo(SearchRequest $searchRequest){
        $game = $this->lolService->getGameInfo($searchRequest);
        return view('game')->with(['game'=>$game]);
    }

    public function champion(){
        $champion=$this->lolService->getChampion(110);
        return view('champion')->with(['champion'=>$champion]);
    }

    public function debug(SearchRequest $searchRequest){
    	$game = $this->lolService->getGameInfo($searchRequest);
    	return view('debug')->with(['game'=>$game]);
    }

    public function clearData(){
        Cache::flush();
    }
}