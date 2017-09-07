<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
/**
* Search Form
*/
class SearchRequest extends FormRequest{
	public function rules(){
        return [
            'region' => 'required',
            'summonerName' => 'required'
        ];
    }

    public function authorize(){
        return true;
    }
}