<article class='panel panel-default' data-toggle='modal' data-target="#{{$champion->getKey()}}">
  <header class='media panel-body'>
    <section class='media-left media-middle'>
        <div class="championImg {{$borderColor}}" style="background-image: url(/img/{{$champion->getKey()}}/{{$champion->getImage()}});">
          {{--<p class="championLevel {{$borderColor}}">6</p>--}}
        </div>
    </section>
    <article class='media-body' style='padding-left: 15px;'>
      <h4>{{$champion->getName()}}</h4>
      <section class='row'>
        <p class='col-lg-4 col-md-4 col-sm-12'>
          <a href='#'><acronym title='Defense'>De</acronym>: <span class='badge'>{{$champion->getDefense()}}</span></a>
        </p>
        <p class='col-lg-3 col-md-3 col-sm-12'>
          <a href='#'><acronym title='Attack Demage'>AD</acronym>: <span class='badge physicalDamage'>{{$champion->getAttack()}}</span></a>
        </p>
        <p class='col-lg-3 col-md-3 col-sm-12'>
          <a href='#'><acronym title='Ability Power'>AP</acronym>: <span class='badge magicDamage'>{{$champion->getMagic()}}</span></a>
        </p>
      </section>
    </article>
  </header>
  <section class='k-panel-body'>
    @if ($teamType =='E')
      <p><acronym title='Enemy Tips' style='color:#3097D1;'>Tips</acronym>: {{$champion->getEnemyTips()}}</p>
    @else
      <p><acronym title='Ally Tips' style='color:#3097D1;'>Tips</acronym>: {{$champion->getAllyTips()}}</p>
    @endif
  </section>
  <footer class='k-panel-body'>
    @foreach ($champion->getAbilities() as $ability)
    <img class="championAbility {{$ability->getDemageType()}}" src="/img/{{$champion->getKey()}}/{{$ability->getImage()}}" title="{{$ability->getName()}}">
    @endforeach
  </footer>
</article>

<article id="{{$champion->getKey()}}" class='modal fade' tabindex='-1' role='dialog' aria-labelledby="{{$champion->getKey()}}ModalLabel">
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' style='font-size: 40px;' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <div>
          <div class="championImg {{$borderColor}}" style="background-image: url(/img/{{$champion->getKey()}}/{{$champion->getImage()}});">
            {{-- <p class="championLevel {{$borderColor}}">6</p> --}}
          </div>
          <div class='championDesc'>
            <h3 class='modal-title' id="{{$champion->getKey()}}ModalLabel">{{$champion->getName()}}</h3>
          </div>
        </div>
      </div>
      @foreach ($champion->getAbilities() as $ability)
      <div class='modal-body'>
       <h4>{{$ability->getName()}}</h4>
       <img class="championAbility {{$ability->getDemageType()}}" src="/img/{{$champion->getKey()}}/{{$ability->getImage()}}" title="{{$ability->getName()}}">
       <p>{!!$ability->getToolTip()!!}</p>
     </div>
     @endforeach
     <div class='modal-footer'>
        <button type='button' class='close' style='font-size: 40px;' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      </div>
    </div>
  </div>
</article>
