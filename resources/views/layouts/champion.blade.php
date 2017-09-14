<div class="list-group-item">
	<div class="row">

		<div class="championImg" style="background-image: url(https://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/{{$champion->image['full']}});border-color: {{$borderColor}};" title="{{$champion->name}}">
			<p class="championLevel" style=" border-color: {{$borderColor}}; " title="Champion Level">20</p>
		</div>

		<div class="championDesc">
			<h4>{{$champion->getName()}}</h4>
			<p>...</p>
		</div>		
	</div>
	<div>
	  @foreach ($champion->getAbilities() as $ability)
	      <img class="championAbility" src="{{$ability->getImageUrl()}}" alt="{{$ability->getName()}}" title="{{$ability->getName()}}">
	      <p>{{$ability->getDamageType()}}</p>
	  @endforeach  
	</div>
</div>