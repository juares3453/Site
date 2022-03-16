<!doctype html>
<html lang="pt">
	<head>
	    <meta charset="UTF-8">
	    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,400italic,700,900' rel='stylesheet' type='text/css'>
	    <link rel="stylesheet" type="text/css" href="/public/assets/css/bootstrap.min.css" />
	    <link rel="stylesheet" type="text/css" href="/public/assets/css/main-system.css" />
	    <title>Rasador - Transportes</title>
	</head>

	<body>
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">Rasador Sistema</a>
		    </div>
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    	  <ul class="nav navbar-nav navbar-left">
		        <li><a href="{{URL::route('lis.not')}}">Notícias</a></li>
		      </ul>

		      <ul class="nav navbar-nav navbar-right">
		      	<li><a href="{{URL::route('adm.usu', 1)}}">Administrar</a></li>
		        <li><a href="{{URL::route('logout')}}">Logout</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>
		<div class="container">
			@section('conteudo-sistema')

			@show
		</div>
		<script type="text/javascript" src="/public/assets/js/jquery.js"></script>
		<script type="text/javascript" src="/public/assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/public/assets/js/respond.min.js"></script>
		<script type="text/javascript" src="/public/assets/js/main-system.js"></script>
	</body>
</html>
