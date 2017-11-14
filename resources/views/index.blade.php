<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta name='description' content='enemy champions information and abilities'>
	<meta name='keywords' content='lol, lol enemy champions'>
	<meta name='author' content='Kody Li'>
	<title>The Sixth</title>
	<script type='text/javascript' src='/js/app.js'></script>
	<link rel='stylesheet' type='text/css' href='/css/app.css'>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108360018-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', 'UA-108360018-1');
	</script>
</head>
<body class='container'>
	
	<div class='row'>
		<h2>The Sixth</h2>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--help you find out the information of your enemy champions after the game starts in <span style='color:#E18200;'>LoL</span>.</p>
	</div>
	<div class='row'>
		<form class='form-inline center-vertically col-md-offset-3 col-sm-8' method='GET' action='/getGameInfo'>
			<div class="form-group">
				<input name='summonerName' required type='text' class='form-control' id='summonerName' size ='40' placeholder='Your Summoner Name'>
				<div class="input-group">
					<span class="input-group-addon">@</span>
					<select name='region' id='region' class='form-control'>
						<option value='br1'>Brazil</option>
						<option value='eun1'>EU Nordic &amp; East</option>
						<option value='euw1'>Europe West</option>
						<option value='la1'>Latin America (North)</option>
						<option value='la2'>Latin America (South)</option>
						<option value='na1' selected>North America</option>
						<option value='oc1'>Oceania</option>
						<option value='ru'>Russia</option>
						<option value='tr1'>Turkey</option>
						<option value='kr'>Republic of Korea</option>
						<option value='jp1'>Japan</option>
					</select>
				</div>
				<select name='local' class='form-control'>
					<option value='cs_CZ'>čeština</option>
					<option value='de_DE'>Deutsch</option>
					<option value='el_GR'>ελληνικά</option>
					<option value='en_AU'>Australia</option>
					<option value='en_GB'>United Kingdom</option>
					<option value='en_PH'>Philippines</option>
					<option value='en_SG'>Singapore</option>
					<option value='en_US' selected>United States</option>
					<option value='es_AR'>العربية</option>
	                <option value='es_ES'>español</option>
					<option value='es_MX'>MÉJICO</option>
	              	<option value='fr_FR'>français</option>
	              	<option value='hu_HU'>magyar</option>
	              	<option value='id_ID'>Bahasa Indonesia</option>
	              	<option value='it_IT'>Italiano</option>
	              	<option value='ja_JP'>日本語</option>
	              	<option value='ko_KR'>조선말</option>
	              	<option value='ms_MY'>Malay</option>
	              	<option value='pl_PL'>język polski</option>
	              	<option value='pt_BR'>português</option>
	              	<option value='ro_RO'>română</option>
	              	<option value='ru_RU'>русский язык</option>
	              	<option value='th_TH'>ภาษาไทย</option>
	              	<option value='tr_TR'>Türkçe</option>
	              	<option value='vn_VN'>Tiếng Việt</option>
	              	<option value='zh_CN'>简体字</option>
	              	<option value='zh_TW'>繁體字</option>
				</select>
			</div>
			<button id='submitBtn' type='submit' class='btn btn-default'>Go!</button>
			{{csrf_field() }}
		</form>
	</div>
</body>
</html>
