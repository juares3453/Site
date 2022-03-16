<?php

class IndexController extends BaseController {

	public function index()
	{
		$noticias = DB::table('noticias')->where('ativo', 1)->orderby('id', 'desc')->paginate(1);
		return View::make('index')->with('noticias', $noticias);
	}

	public function empresa()
	{
		return View::make('paginas.empresa');
	}

	public function estrutura()
	{
		return View::make('paginas.estrutura');
	}

	public function areasAtuacao()
	{
		return View::make('paginas.areas_atuacao');
	}

	public function servicos()
	{
		return View::make('paginas.servicos');
	}

	public function tecnologia()
	{
		return View::make('paginas.tecnologia');
	}


	public function noticias()
	{
		$noticias = DB::table('noticias')->where('ativo', 1)->orderby('id', 'desc')->get();
		return View::make('paginas.noticias')->with('noticias', $noticias);
	}

	public function noticiaInterna($slug)
	{
		$noticia = DB::table('noticias')->where('slug', $slug)->first();
		return View::make('paginas.noticia_interna')->with('noticia', $noticia);
	}

	public function contato()
	{
		$sucesso = false;
		return View::make('paginas.contato')->with('sucesso', $sucesso);

	}

	public function contatoEnvio()
	{

		$data = array(
			'nome'=> Input::get("nome"),
		    'telefone'=> Input::get("telefone"),
		    'email'=> Input::get("email"),
		    'cidade'=> Input::get("cidade"),
		    'mensagem'=> Input::get("mensagem")
		);

		Mail::send('emails.contato', $data, function($message)
		{
			$message->from('mensageiro@agenciafatto.com.br', 'Rasador Transportes');
			$message->replyTo(Input::get("email"), Input::get("nome"));
			$message->to(Input::get("area"), 'Rasador Transportes')->subject('Contato - Site - Rasador Transportes');
		});
		sleep(2);
		return "Email enviado com sucesso!";
	}

	public function workEnvio()
	{
		$destinationPath = 'assets/curriculos';
		$name = Input::file('curriculo')->getClientOriginalName();
        $fileName =  Input::get("nome") .'_'. Input::get("sobrenome") . '_' . $name;
        Input::file('curriculo')->move($destinationPath, $fileName);

		$data = array(
			'nome'=> Input::get("nome"),
			'sobrenome'=> Input::get("sobrenome"),
		    'telefone'=> Input::get("telefone"),
		    'email'=> Input::get("email"),
		    'cidade'=> Input::get("cidade"),
		    'sexo'=> Input::get("sexo"),
		    'cargo'=> Input::get("cargo"),
		    'mensagem'=> Input::get("mensagem")
		);

		Mail::send('emails.trabalhe', $data, function($message) use($fileName)
		{
			$message->from('mensageiro@agenciafatto.com.br', 'Rasador Transportes');
			$message->replyTo(Input::get("email"), Input::get("nome"));
			$message->to('rh@rasador.com.br', 'Rasador Transportes')->subject('Trabalhe - Conosco - Rasador Transportes');
			$message->attach('assets/curriculos/'.$fileName);
		});

		$sucesso = true;

		return View::make('paginas.contato')->with('sucesso', $sucesso);
	}

	public function login()
	{
		return View::make('paginas.login');
	}

}