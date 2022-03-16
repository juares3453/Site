@extends('sistema.template')
@section('conteudo-sistema')
	<div class="row col-md-8">
        {{ Form::model($user, array('route' => array('upd.use', $user->id), 'method' => 'PUT', 'id' => 'form-usuarios', 'class' => 'form-horizontal', 'files' => true )) }}
            <fieldset>
                <legend>Informações Principais</legend>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nome</label>
                    <div class="col-sm-9">
                        {{ Form::text('nome', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        {{ Form::text('email', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Senha</label>
                    <div class="col-sm-9">
                        {{ Form::password('password', array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="submit" class="btn btn-primary col-md-4" style="float: right" value="Atualizar" />
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
@stop