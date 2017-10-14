<div class="panel panel-default" data-toggle="modal" data-target="#{{$champion->getKey()}}">
  <div class="panel-body">
    <div>
      <div class="championImg {{$borderColor}}" style="background-image: url({{$champion->getImage()}});">
       {{-- <p class="championLevel {{$borderColor}}">6</p> --}}
      </div>
      <div class="championDesc">
        <h4>{{$champion->getName()}}</h4>
      </div>
    </div>
  </div>
  <div class="k-panel-body">
    @foreach ($champion->getAbilities() as $ability)
    <img class="championAbility {{$ability->getDemageType()}}" src="{{$ability->getImage()}}" title="{{$ability->getName()}}">
    @endforeach
  </div>
</div>
<div id="{{$champion->getKey()}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="{{$champion->getKey()}}ModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" style="font-size: 40px;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div>
          <div class="championImg {{$borderColor}}" style="background-image: url({{$champion->getImage()}});">
            {{-- <p class="championLevel {{$borderColor}}">6</p> --}}
          </div>
          <div class="championDesc">
            <h3 class="modal-title" id="{{$champion->getKey()}}ModalLabel">{{$champion->getName()}}</h3>
          </div>
        </div>
      </div>
      @foreach ($champion->getAbilities() as $ability)
      <div class="modal-body">
       <h4>{{$ability->getName()}}</h4>
       <img class="championAbility {{$ability->getDemageType()}}" src="{{$ability->getImage()}}" title="{{$ability->getName()}}">
       <p>{!!$ability->getToolTip()!!}</p>
       <!-- <img style="width: 100%;" src="https://lolstatic-a.akamaihd.net/champion-abilities/images/0266_01.jpg" tabindex="-1"> -->
     </div>
     @endforeach
     <div class="modal-footer">
      <button type="button" class="close" style="font-size: 40px;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
  </div>
</div>
</div>