@extends('sistema.template')
@section('conteudo-sistema')
	<h1>Editar Notícia</h1>
	<div class="col-md-10 col-md-offset-1">
		<div class="col-md-8">
		    <div class="form-area">  
		        {{ Form::model($noticia, array('route' => array('atu.not', $noticia->id), 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true )) }}
		        	<br style="clear:both">
	                <h3 style="margin-bottom: 25px; text-align: center;">Formulário da Notícia</h3>
					<div class="form-group">
						{{ Form::text('titulo', null, array('class' => 'form-control')) }}
					</div>
					<div class="form-group">
						{{ Form::text('data', null, array('class' => 'form-control')) }}
					</div>
					<div class="form-group">
						Imagem: <input type="file" name="imagem">
					</div>
					<div class="form-group">
						{{ Form::textarea('texto', null, array('class' => 'form-control', 'placeholder' => 'Texto')) }}	            
					</div>
					<div class="form-group">
						{{ Form::select('ativo', array('1' => 'Ativo', '2' => 'Desativo'), null, array('class' => 'form-control')) 
		                }}
	            
					</div>
					<div class="form-group">
		       			<input type="submit" id="submit" name="submit" class="btn btn-primary pull-right" />
		       		</div>     
		        </form>
		    </div>
		</div>
	</div>
@stop