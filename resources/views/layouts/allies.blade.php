@extends('./layouts/team')

@section('title')
	Allies
@overwrite
@section('css')
	panel-primary
@overwrite
@section('participants')
    @foreach ($allies as $ally)
		@component('./layouts/champion',['champion'=>$ally->getChampion(),'borderColor'=>'#3097D1'])@endcomponent
	@endforeach
@overwrite