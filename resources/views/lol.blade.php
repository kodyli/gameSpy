<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <title>Game Spy</title>
  <script type='text/javascript' src='/js/app.js'></script>
  <link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>

  <h1>{{$champion->name}}<h1>
  <img src="https://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/{{$champion->image['full']}}" alt="{{$champion->name}}" title="{{$champion->name}}">


  <h3>Info</h3>
  <ul>
      @foreach ($champion->info as $key=> $value)
        <li>{{$key}}: {{$value}}</li>
      @endforeach
  </ul>


  <h3>Abilities</h3>
  <ul>
  @foreach ($champion->getAbilities() as $ability)
    <li>
      <h4><img src="{{$ability->getImageUrl()}}" alt="{{$ability->getName()}}" title="{{$ability->getName()}}"></h4>
      <p>{!! $ability->getDesc() !!}</p>
      <p>{!! $ability->getTooltip() !!}</p>
    </li>
  @endforeach
  </ul>


  <h3>Stats</h3>
  <ul>
      @foreach ($champion->stats as $key=> $stat)
        <li>{{$key}}: {{$stat}}</li>
      @endforeach


  <h3>Enemy Tips:</h3>
  <ol>
      @foreach ($champion->enemytips as $enemytip)
        <li>{{$enemytip}}</li>
      @endforeach
  </ol>


  <h3>Ally Tips:</h3>
  <ol>
      @foreach ($champion->allytips as $allytip)
        <li>{{$allytip}}</li>
      @endforeach
  </ol>
  
</body>
</html>