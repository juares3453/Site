<?php

Route::get('/', array('as' => 'index', 'uses' => 'IndexController@index'));
Route::get('empresa', array('as' => 'emp', 'uses' => 'IndexController@empresa'));
Route::get('estrutura', array('as' => 'est', 'uses' => 'IndexController@estrutura'));
Route::get('noticias', array('as' => 'not', 'uses' => 'IndexController@noticias'));
Route::get('servicos', array('as' => 'ser', 'uses' => 'IndexController@servicos'));
Route::get('tecnologia', array('as' => 'tec', 'uses' => 'IndexController@tecnologia'));
Route::get('areas-atuacao', array('as' => 'are.atu', 'uses' => 'IndexController@areasAtuacao'));
Route::get('noticia/{slug}', array('as' => 'not.int', 'uses' => 'IndexController@noticiaInterna'));
Route::get('contato', array('as' => 'con', 'uses' => 'IndexController@contato'));
Route::post('/envio-de-formulario-contato', array('as' => 'con.env', 'uses' => 'IndexController@contatoEnvio'));
Route::post('envio-trabalhe-conosco', array('as' => 'env.wor', 'uses' => 'IndexController@workEnvio'));
Route::get('login', array('as' => 'log', 'uses' => 'IndexController@login'));


// Login Admin
Route::post('sistema-admin', array('as' => 'sistema-admin', 'before' => 'csrf', function() {
    sleep(2);
    $regras = array("email" => "required|email", "password" => "required");
    $validacao = Validator::make(Input::all(), $regras);

    if ($validacao->fails()) {
        return Redirect::to('login')->withErrors($validacao);
    }

    // Loga o usuário
    if (Auth::attempt( array('email' => Input::get('email'), 'password' => Input::get('password')) ) ) {
        return Redirect::to('sistema/admin');
    }
    else {
        return Redirect::to('login')->withErrors('Usuário ou Senha Inválido');
    }
}));

// Sistema
Route::group(array('before' => 'auth'), function(){
    Route::get('sistema/admin', array('as' => 'sis', 'uses' => 'SystemController@sistema'));
    Route::get('logout', array('as' => 'logout', 'uses' => 'SystemController@adminLogout'));

    // Notícias
    Route::get('listar-noticias', array('as' => 'lis.not', 'uses' => 'SystemController@listarNoticias'));
    Route::get('adicionar-noticia', array('as' => 'add.not', 'uses' => 'SystemController@adicionarNoticia'));
    Route::post('inserir-noticia', array('as' => 'ins.not', 'uses' => 'SystemController@inserirNoticia'));
    Route::get('editar-noticia/{id}', array('as' => 'edi.not', 'uses' => 'SystemController@editarNoticia'));
    Route::any('atualizar-noticia/{id}', array('as' => 'atu.not', 'uses' => 'SystemController@atualizarNoticia'));
    Route::get('deletar-noticia/{id}', array('as' => 'del.not', 'uses' => 'SystemController@deletarNoticia'));

    // Usuários
    Route::get('administrar-usuario/{id}', array('as' => 'adm.usu', 'uses' => 'SystemController@adminUser'));
    Route::any('update-user/{id}', array('as' => 'upd.use', 'uses' => 'SystemController@updateUser'));
});
