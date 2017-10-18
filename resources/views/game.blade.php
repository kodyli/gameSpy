<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta name='description' content='enemy champions information and abilities'>
	<meta name='keywords' content='lol'>
	<meta name='author' content='Kody Li'>
	<title>Game Spy</title>
	<script type='text/javascript' src='/js/app.js'></script>
	<link rel='stylesheet' type='text/css' href='/css/app.css'>
</head>
<body>
	<div style="background-image: url({{$game->getMap()->getImage()}});background-repeat: no-repeat;background-attachment: fixed; background-color: #0e0e0e;background-size:cover; background-position: center; height: 300px;width: 100%;">
	</div>
	
	<div class="row">
		@include('./layouts/enemies', ['enemies'=>$game->getRedTeam()])
		@include('./layouts/allies', ['allies'=>$game->getBlueTeam()])
	</div>


</body>
</html>