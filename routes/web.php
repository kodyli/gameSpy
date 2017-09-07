<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'LolController@index');
Route::get('/getParticipantInfo', 'LolController@getParticipantInfo');
Route::get('/champion', 'LolController@champion');
Route::get('/debug', 'LolController@debug');
/*
Route::get('/', function () {
    return view('lol');
});*/
