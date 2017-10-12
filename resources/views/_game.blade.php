<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta name='description' content=''>
	<meta name='keywords' content='lol'>
	<meta name='author' content='Yansan Li'>
	<title>Game Spy</title>
	<script type='text/javascript' src='/js/app.js'></script>
	<link rel='stylesheet' type='text/css' href='/css/app.css'>
</head>
<body>
	
	<div style="background-image: url(http://ddragon.leagueoflegends.com/cdn/6.8.1/img/map/map{{$game->getMap()}}.png);background-repeat: no-repeat;background-attachment: fixed; background-color: #0e0e0e;background-size:cover; background-position: center; height: 300px;width: 100%;">
	</div>

	<div class="row">
		@include('./layouts/enemies', ['enemies'=>$game->getEnemies()])
		@include('./layouts/allies', ['allies'=>$game->getAllies()])
	</div>
</body>
</html>