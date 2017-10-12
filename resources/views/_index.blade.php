<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta name='description' content='>
	<meta name='keywords' content='>
	<meta name='author' content='>
	<title>Game Spy</title>
	<script type='text/javascript' src='/js/app.js'></script>
	<link rel='stylesheet' type='text/css' href='/css/app.css'>
</head>
<body class='container'>
	<form class='form-horizontal center-vertically' method='GET' action='/getParticipantInfo'>
		<div class='form-group'>
			<label for='region' class='col-sm-2 control-label'>Region</label>
			<div class='col-sm-10'>
				<select name='region' id='region' class='form-control'>
					<option value='BR1'>Brazil</option>
					<option value='EUN1'>EU Nordic &amp; East</option>
					<option value='LA1'>Latin America (North)</option>
					<option value='LA2'>Latin America (South)</option>
					<option value='NA1'>North America</option>
					<option value='OC1'>Oceania</option>
					<option value='RU'>Russia</option>
					<option value='TR1'>Turkey</option>
				</select>
			</div>
		</div>
		<div class='form-group'>
			<label for='summonerName' class='col-sm-2 control-label'>Summoner Name</label>
			<div class='col-sm-10'>
				<input name='summonerName' required type='text' class='form-control' id='summonerName' placeholder='Summoner Name'>
			</div>
		</div>
		<!-- <div class='form-group'>
			<label for='local' class='col-sm-2 control-label'>Language</label>
			<div class='col-sm-10'>
				<select name='local' id='local' class='form-control'>
					<option value='en_US' selected>en_US</option>
					<option value='zh_CN'>zh_CN</option>
				</select>
			</div>
		</div> -->
		<div class='form-group'>
			<div class='col-sm-offset-2 col-sm-10'>
				<button id='submitBtn' type='submit' class='btn btn-default'>Submit</button>
			</div>
		</div>
	</form>
</body>
</html>