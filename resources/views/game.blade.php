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
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108360018-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', 'UA-108360018-1');
	</script>
</head>
<body>
	<nav class="navbar navbar-default container">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>

	      <ul class="nav navbar-nav">
	        <li><a class="navbar-brand" href="http://theSixth.xyz">6<small>th</small></a></li>
	        {{--<li><button type="button" class="btn btn-default navbar-btn">Sign in</button></li>--}}
	      </ul>
	    </div>
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    		<ul class="nav navbar-nav navbar-right">
	        	<li><a href="http://theSixth.xyz">Home</a></li>
	      	</ul>
	    </div>
	  </div>
	</nav>
	<section class='container'>
			<div style="background-image: url({{$game->getMap()->getImage()}});background-repeat: no-repeat;background-attachment: fixed; background-color: #0e0e0e;background-size:cover; background-position: center; height: 300px;width: 100%;">
		</div>
		<div class='row'>
			<div class='col-lg-4 col-md-4 col-sm-12'>
			@include('./layouts/static', ['enemies'=>$game->getRedTeam(),'allies'=>$game->getBlueTeam()])
			</div>
			<div class='col-lg-4 col-md-4 col-sm-12'>
				@include('./layouts/enemies', ['enemies'=>$game->getRedTeam()])
			</div>
			<div class='col-lg-4 col-md-4 col-sm-12'>
				@include('./layouts/allies', ['allies'=>$game->getBlueTeam()])
			</div>
		</div>
	</section>
</body>
</html>
