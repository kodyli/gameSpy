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

  <div class="panel panel-danger">
    <div class="panel-heading">
      <h3 class="panel-title">Enemies</h3>
    </div>
    
    <div class="panel-body">
      @for ($i = 0; $i < 5; $i++)
      <div class="panel panel-default" data-toggle="modal" data-target="#AatroxAatrox{{ $i }}">
        <div class="panel-body">
          <div>
            <div class="championImg borderColorD9534F" style="background-image: url(http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/Aatrox.png);">
              <p class="championLevel borderColorD9534F">6</p>
            </div>
            <div class="championDesc">
              <h4>Aatrox {{ $i }}</h4>
            </div>
          </div>
        </div>
        <div class="k-panel-body">
          <img class='championAbility' src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell/AatroxQ.png" title="Aatrox Q">
          <img class='championAbility physicalDamage' src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell/AatroxW.png">
          <img class='championAbility magicDamage' src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell/AatroxE.png">
          <img class='championAbility trueDamage' src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell/AatroxR.png">
          <img class='championAbility' src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell/AatroxQ.png">
        </div>
      </div>
      <div id="AatroxAatrox{{ $i }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AatroxQSmallModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" style="font-size: 40px;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title" id="AatroxQModalLabel">Aatrox {{ $i }}</h3>
            </div>
            <div class="modal-body">
            
              <img class='championAbility' src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell/AatroxQ.png" title="Aatrox Q">

              <p style="font-size: 18px;"><span style="font-weight:700;">Test: </span>Also you have placement top in the html and also in the javascript. You only need to declare in one place.</p>
              <!-- <img style="width: 100%;" src="https://lolstatic-a.akamaihd.net/champion-abilities/images/0266_01.jpg" tabindex="-1"> -->
            </div>
            <div class="modal-body">
            <h4>Test</h4>
              <img class='championAbility' src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell/AatroxW.png" title="Aatrox W">
              <p>Also you have placement top in the html and also in the javascript. You only need to declare in one place.</p>
              <!-- <img style="width: 100%;" src="https://lolstatic-a.akamaihd.net/champion-abilities/images/0266_01.jpg" tabindex="-1"> -->
            </div>
            <div class="modal-body">
            <h4>Test</h4>
              <img class='championAbility' src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell/AatroxW.png" title="Aatrox W">
              <p>Also you have placement top in the html and also in the javascript. You only need to declare in one place.</p>
              <!-- <img style="width: 100%;" src="https://lolstatic-a.akamaihd.net/champion-abilities/images/0266_01.jpg" tabindex="-1"> -->
            </div>
            <div class="modal-body">
              <img class='championAbility' src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell/AatroxW.png" title="Aatrox W">
              <p>Also you have placement top in the html and also in the javascript. You only need to declare in one place.</p>
              <!-- <img style="width: 100%;" src="https://lolstatic-a.akamaihd.net/champion-abilities/images/0266_01.jpg" tabindex="-1"> -->
            </div>
            <div class="modal-body">
            <h4>Test</h4>
              <img class='championAbility' src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell/AatroxW.png" title="Aatrox W">
              <p>Also you have placement top in the html and also in the javascript. You only need to declare in one place.</p>
              <!-- <img style="width: 100%;" src="https://lolstatic-a.akamaihd.net/champion-abilities/images/0266_01.jpg" tabindex="-1"> -->
            </div>
            <div class="modal-body">
            <h4>Test</h4>
              <img class='championAbility' src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell/AatroxW.png" title="Aatrox W">
              <p>Also you have placement top in the html and also in the javascript. You only need to declare in one place.</p>
              <!-- <img style="width: 100%;" src="https://lolstatic-a.akamaihd.net/champion-abilities/images/0266_01.jpg" tabindex="-1"> -->
            </div>
            <div class="modal-body">
              <img class='championAbility' src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell/AatroxW.png" title="Aatrox W">
              <p>Also you have placement top in the html and also in the javascript. You only need to declare in one place.</p>
              <!-- <img style="width: 100%;" src="https://lolstatic-a.akamaihd.net/champion-abilities/images/0266_01.jpg" tabindex="-1"> -->
            </div>
            <div class="modal-body">
              <img class='championAbility' src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell/AatroxW.png" title="Aatrox W">
              <p>Also you have placement top in the html and also in the javascript. You only need to declare in one place.</p>
              <!-- <img style="width: 100%;" src="https://lolstatic-a.akamaihd.net/champion-abilities/images/0266_01.jpg" tabindex="-1"> -->
            </div>
            <div class="modal-body">
              <img class='championAbility' src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/spell/AatroxW.png" title="Aatrox W">
              <p>Also you have placement top in the html and also in the javascript. You only need to declare in one place.</p>
              <!-- <img style="width: 100%;" src="https://lolstatic-a.akamaihd.net/champion-abilities/images/0266_01.jpg" tabindex="-1"> -->
            </div>
            <div class="modal-footer">
              <button type="button" class="close" style="font-size: 40px;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
          </div>
        </div>
      </div>
      @endfor
    </div>
    
  </div>
</body>
</html>