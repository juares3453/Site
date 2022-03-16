@extends('template')
@section('conteudo')
	<div class="container">
		<div class="titulo">
			<h1>{{$noticia->titulo}}</h1>
			<div class="col-md-8 col-md-offset-2 img-noticia">
				<img src="public/assets/img/noticias/{{$noticia->imagem}}" alt="{{$noticia->titulo}} - Rasador Transportes" class="img-responsive" />
			</div>
		</div>
		<div class="col-md-12">	
			<div class="col-md-10 col-md-offset-1">
				<?php  $texto = nl2br($noticia->texto); ?>
				<p>{{$texto}}</p>
			</div>
		</div>
	</div>
@stop