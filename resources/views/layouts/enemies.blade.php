@extends('./layouts/team')

@section('title')
	Enemies
@overwrite

@section('css')
	panel-danger
@overwrite

@section('participants')
    @foreach ($enemies as $enemy)
		@component('./layouts/champion',['champion'=>$enemy->getChampion(),'borderColor'=>'#EBCCD2'])@endcomponent
	@endforeach
@overwrite