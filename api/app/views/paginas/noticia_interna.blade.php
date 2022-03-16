<!doctype html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="distribution" content="Global" />
	<meta name="geo.region" content="Brasil" />
	<meta name="Transportes Rasador" content="Transportes - Transportes para RS, SC, PR, SP - Depósito Verticalizado - Cargas">
	<meta name="keywords" content="Transportes - Transportes para RS, SC, PR, SP - Depósito Verticalizado - Cargas, depósito, cargas pesadas, tecnologia de leitura, Rasador, bento gonçalves, Transporte de mercadoria">
	<meta name="description" content="O trabalho desenvolvido com seriedade e a oferta de soluções e serviços de qualidade e segurança fizeram com que a TRANSPORTES RASADOR conquistasse a credibilidade, confiança, e respeito dos clientes e ganhasse visibilidade no mercado." />
	<meta name="author" content="Fatto - Agência Digital - Desenvolvimento Web - Criação de Sites - www.agenciafatto.com.br">
	<meta name="title" content="Rasador - Transportes - Transportes para RS, SC, PR, SP - Depósito Verticalizado - Cargas" >
	<link href='https://fonts.googleapis.com/css?family=Lato:400,300,400italic,700,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="/public/assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="/public/assets/css/main.css" />
	<title>Rasador - Transportes - Transportes para RS, SC, PR, SP - Depósito Verticalizado - Cargas</title>
</head>

<body>
	<a href="#conteudo" id="link-scroll-inside" class="hidden">
		<div class="scroll"></div>
	</a>
	<div id="header">
		<div class="top-header">
			<div class="container">
				<div class="col-md-4 col-sm-6 logo">
					<a href="/" title="Transportes Rasador">
						<img src="/public/assets/img/logo.png" alt="Transportes Rasador" class="img-responsive" />
					</a>
				</div>
				<div class="col-md-8 col-sm-12">
					<header class="navbar bs-docs-nav" role="banner">
						<div class="container-fluid">
							<div class="navbar-header">
								<button class="navbar-toggle" data-target=".bs-navbar-collapse" data-toggle="collapse" type="button">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
								<ul class="nav navbar-nav menu-header">
									<li>
										<a href="{{URL::route('emp')}}" class="active" title="Rasador - Empresa">Empresa</a>
									</li>
									<li>
										<a href="{{URL::route('est')}}" title="Rasador - Estrutura">Estrutura</a>
									</li>
									<li>
										<a href="{{URL::route('are.atu')}}" title="Rasador - Áreas de Atuação">Áreas de Atuação</a>
									</li>
									<li>
										<a href="{{URL::route('con')}}" title="Rasador - Contato">Contato</a>
									</li>
								</ul>
							</nav>
						</div>
					</header>
				</div>
			</div>
		</div>
	</div>
	<div id="tarja"></div>
	<div id="conteudo">
		<div class="container">
			<div class="titulo">
				<h1>{{$noticia->titulo}}</h1>

				<?php

				$imagem = nl2br($noticia->texto);

				if(empty($imagem)) { ?>
				<div class="col-md-8 col-md-offset-2 img-noticia">
					<img src="public/assets/img/noticias/{{$noticia->imagem}}" alt="{{$noticia->titulo}} - Rasador Transportes" class="img-responsive" />
				</div>
				<?php } ?>

			</div>
			<div class="col-md-12">
				<div class="col-md-10 col-md-offset-1">
					<?php  $texto = nl2br($noticia->texto); ?>
					<p>{{$texto}}</p>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<div class="container">
			<div class="col-md-12">
				<h1>Fale Conosco</h1>
				<img src="/public/assets/img/borda-titulo-footer.png" />
				<h2 class="footer">Matriz Bento Gonçalves</h2>
				<p>(54) 2102.7700</p>
				<p>Rua Laudelino M. Alexandre, 90 - Bairro Juventude</p>
				<p>Bento Gonçalves - RS CEP: 95700-000</p>
			</div>
			<div class="col-md-8 menu-footer">
				<ul>
					<li>
						<a href="{{URL::route('emp')}}" class="active" title="GIZ SOL - Gizes">Empresa</a>
					</li>
					<li>
						<a href="{{URL::route('est')}}" title="GIZ SOL - A empresa">Estrutura</a>
					</li>
					<li>
						<a href="{{URL::route('are.atu')}}" title="GIZ SOL - Produtos">Áreas de Atuação</a>
					</li>
					<li>
						<a href="{{URL::route('con')}}" title="GIZ SOL - Catálogo Virtual">Contato</a>
					</li>
				</ul>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12 logo-footer">
				<img src="/public/assets/img/logo-footer.png" alt="Rasador Trasnportes" class="img-responsive" />
			</div>
			<div class="col-md-12 col-xs-12">
				<p class="direitos">Todos os Direitos Reservados - Rasador &copy; 2020</p>
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="/public/assets/js/jquery.js"></script>
	<script type="text/javascript" src="/public/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/public/assets/js/respond.min.js"></script>
	<script type="text/javascript" src="/public/assets/js/jquery.form.js"></script>
	<script type="text/javascript" src="/public/assets/js/jquery.transform.min.js"></script>
	<script type="text/javascript" src="/public/assets/js/backstratch.js"></script>
	<script type="text/javascript" src="/public/assets/js/main.js"></script>
	<script type="text/javascript">
		$(function(){
			var alvo = $('a#link-scroll-inside').attr('href').split('#').pop();
			$('html, body').animate({scrollTop : ($('#' + alvo).offset().top) - 80}, 1500);
			return false;
		});
	</script>
</body>
</html>