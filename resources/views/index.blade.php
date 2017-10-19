<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta name='description' content='enemy champions information and abilities'>
	<meta name='keywords' content='lol, lol enemy champions'>
	<meta name='author' content='Kody Li'>
	<title>The Sixth</title>
	<script type='text/javascript' src='/js/app.js'></script>
	<link rel='stylesheet' type='text/css' href='/css/app.css'>
</head>
<body class='container'>
	
	<div class='row'>
		<h2>The Sixth</h2>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--help you find out the information of your enemy champions after the game starts in <span style='color:#E18200;'>LoL</span>.</p>
	</div>
	<div class='row'>
		<form class='form-inline center-vertically col-md-offset-3 col-sm-8' method='POST' action='/getGameInfo'>
		<div class="form-group">
			<input name='summonerName' required type='text' class='form-control' id='summonerName' size ='40' placeholder='Your Summoner Name'>
			<div class="input-group">
				<span class="input-group-addon">@</span>
				<select name='region' id='region' class='form-control'>
					{{--<option value='br1'>Brazil</option>
					<option value='eun1'>EU Nordic &amp; East</option>
					<option value='la1'>Latin America (North)</option>
					<option value='la2'>Latin America (South)</option>--}}
					<option value='na1'>North America</option>
					{{--<option value='oc1'>Oceania</option>
					<option value='ru'>Russia</option>
					<option value='tr1'>Turkey</option>--}}
				</select>
			</div>
		</div>
		<button id='submitBtn' type='submit' class='btn btn-default'>Go!</button>
		{{csrf_field() }}
		<!-- <div class='form-group'>
			<label for='local' class='col-sm-2 control-label'>Language</label>
			<div class='col-sm-10'>
				<select name='local' id='local' class='form-control'>
					<option value='en_US' selected>en_US</option>
					<option value='zh_CN'>zh_CN</option>
				</select>
			</div>
		</div> -->

	</form>
	</div>	
</body>
</html>