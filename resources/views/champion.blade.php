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
      @include('./layouts/champion', ['champion'=>$champion,'teamType'=>'E'])
    </div> 
  </div>
</body>
</html>