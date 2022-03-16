@extends('template')
@section('conteudo')
	<div class="container">
		<div class="titulo">
			<h2>Veja as nossas</h2>
			<h1>Notícias</h1>
			<img src="public/assets/img/borda-titulo.png" />
		</div>
		
			@foreach($noticias as $n)
				<div class="noticia col-md-4">
					<div class=" not">
						<h2 class="titulo-noticia">{{Str::limit($n->titulo, 40)}}</h2>
						<p>{{Str::limit($n->texto, 130)}}</p>
						<a href="{{URL::route('not.int', $n->slug)}}" class="link">Leia mais</a>
						<img src="public/assets/img/fundo-noticia.png" class="img-responsive fundo-noticia" />
					</div>
				</div>
			@endforeach
		</div>
	</div>
@stop