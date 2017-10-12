@extends('./layouts/team')

@section('title')
	Enemies
@overwrite

@section('css')
	panel-danger
@overwrite

@section('participants')
    @foreach ($enemies as $enemy)
		@component('./layouts/champion',['champion'=>$enemy->getChampion(),'borderColor'=>'borderColorD9534F'])@endcomponent
	@endforeach
@overwrite