<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\LolService;

class LolController extends Controller {
    protected $lolService;
	public function __construct(LolService $lolService){
		$this->lolService=$lolService;
	}

    public function index(){
    	$champion=$this->lolService->getActiveGame();
    	return view('lol')->with(['champion'=>$champion]);
    }

    public function debug(){
    	$champion=$this->lolService->getActiveGame();
    	return view('debug')->with(['champion'=>$champion]);
    }
}