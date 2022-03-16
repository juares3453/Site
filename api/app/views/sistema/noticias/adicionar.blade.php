@extends('sistema.template')
@section('conteudo-sistema')
	<h1>Adicionar Notícia</h1>
	<div class="col-md-10 col-md-offset-1">
		<div class="col-md-8">
		    <div class="form-area">  
		        <form role="form" method="post" action="{{URL::route('ins.not')}}" enctype="multipart/form-data">
		        	<br style="clear:both">
	                <h3 style="margin-bottom: 25px; text-align: center;">Formulário da Notícia</h3>
					<div class="form-group">
						<input type="text" class="form-control" name="titulo" placeholder="Título" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="data" placeholder="Data" required>
					</div>
					<div class="form-group">
						Imagem: <input type="file" name="imagem">
					</div>
					<div class="form-group">
						<textarea class="form-control" placeholder="Texto" name="texto" rows="7"></textarea>		            
					</div>
	                <div class="form-group">
		       			<input type="submit" id="submit" name="submit" class="btn btn-primary pull-right" />
		       		</div>     
		        </form>
		    </div>
		</div>
	</div>
@stop