@extends('template')
@section('conteudo')
	<div class="container">
		<h2>Login</h2>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
	    		<div class="panel panel-default">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">Por favor, informe seus dados:</h3>
				 	</div>
				  	<div class="panel-body">
				    	<form method="post" action="{{URL::route('sistema-admin')}}" role="form">
		                    <fieldset>
					    	  	<div class="form-group">
					    		    <input class="form-control" placeholder="E-mail" name="email" type="text">
					    		</div>
					    		<div class="form-group">
					    			<input class="form-control" placeholder="Senha" name="password" type="password" >
					    		</div>
					    		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
					    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
					    	</fieldset>
				      	</form>
				    </div>
				</div>
			</div>
		</div>
	</div>
@stop