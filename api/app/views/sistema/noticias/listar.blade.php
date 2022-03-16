@extends('sistema.template')
@section('conteudo-sistema')
	<h1>Notícias</h1>
	<div class="col-md-10 col-md-offset-1">
		<div class="row">
			<a href="{{URL::route('add.not')}}" class="btn btn-primary">Adicionar Notícia</a>
	        <div class="col-md-6" class="busca-not">
	            <form action="#" method="get">
	                <div class="input-group">
	                    <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
	                    <input class="form-control" id="system-search" name="q" placeholder="Buscando por:" required>
	                    <span class="input-group-btn">
	                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
	                    </span>
	                </div>
	            </form>
	        </div>
			<div class="col-md-12">
	    	 	<table class="table table-list-search">
		            <thead>
		                <tr>
		                    <th width="50%">Título</th>
		                    <th width="20%">Data</th>
		                    <th width="5%">Ativo</th>
		                    <th width="5%">Editar</th>
		                    <th width="5%">Deletar</th>
		                </tr>
		            </thead>
		            <tbody>
		            	@foreach($noticias as $n)
			                <tr>
			                    <td>{{$n->titulo}}</td>
			                    <td>{{$n->data}}</td>
			                    <td>
			                    	@if($n->ativo == 1)
			                    		<span class="glyphicon glyphicon-ok success"></span>
			                    	@else
			                    		<span class="glyphicon glyphicon-remove danger"></span>
			                    	@endif
			                    </td>
			                    <td><a href="{{URL::route('edi.not', $n->id)}}"><span class="glyphicon glyphicon-pencil"></span></a></td>
			                    <td><a href="{{URL::route('del.not', $n->id)}}"><span class="glyphicon glyphicon-remove danger"></span></a></td>
			                </tr>
			            @endforeach
		            </tbody>
		        </table>   
			</div>
		</div>
	</div>
@stop