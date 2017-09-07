<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\LolService;
use App\Http\Requests\SearchRequest;

class LolController extends Controller {
    protected $lolService;
	public function __construct(LolService $lolService){
		$this->lolService=$lolService;
	}

    public function index(){
        return view('index');
    }

    public function getParticipantInfo(SearchRequest $searchRequest){
        $participant = $this->lolService->getParticipantInfo($searchRequest);
        return view('game')->with(['participant'=>$participant]);
    }

    public function champion(){
        $champion=$this->lolService->getChampion(110);
        return view('champion')->with(['champion'=>$champion]);
    }

    public function debug(){
    	$champion=$this->lolService->getActiveGame();
    	return view('debug')->with(['champion'=>$champion]);
    }
}