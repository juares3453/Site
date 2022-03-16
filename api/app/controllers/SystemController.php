<?php

class SystemController extends BaseController {

	public function sistema()
	{
		return View::make('sistema.index');
	}

// Notícias
	public function listarNoticias()
	{
		$noticias = DB::table('noticias')->get();
		return View::make('sistema.noticias.listar')->with('noticias', $noticias);
	}

	public function adicionarNoticia()
	{
		return View::make('sistema.noticias.adicionar');
	}

	public function inserirNoticia()
	{
		$noticia = new Noticia;
		$noticia->titulo = Input::get('titulo');
		$slug = Input::get('titulo');
		$noticia->slug = Str::slug($slug);
		$noticia->data = Input::get('data');
		$noticia->texto = Input::get('texto');
		$noticia->ativo = 1;

		$newName = str_random(12);
		if(Input::file('imagem')){
			$extension = Input::file('imagem')->getClientOriginalExtension();
			$fileName = "". str_random(4) ."_". Str::slug($slug) .".". $extension ."";
			$noticia->imagem = $fileName;
		 	$dir = 'assets/img/noticias';
        	$destination_imagem_principal = $dir;
			Input::file('imagem')->move($destination_imagem_principal, $fileName);
		}
		$noticia->save();
		$noticias = DB::table('noticias')->get();
		return View::make('sistema.noticias.listar')->with('noticias', $noticias);
	}

	public function editarNoticia($id)
	{
		$noticia = DB::table('noticias')->where('id', $id)->first();
		return View::make('sistema.noticias.editar')->with('noticia', $noticia);
	}

	public function atualizarNoticia($id)
	{
		$noticia = Noticia::find($id);
		$noticia->titulo = Input::get('titulo');
		$slug = Input::get('titulo');
		$noticia->slug = Str::slug($slug);
		$noticia->data = Input::get('data');
		$noticia->texto = Input::get('texto');
		$noticia->ativo = Input::get('ativo');
		
		$newName = str_random(12);
		if(Input::file('imagem')){
			$extension = Input::file('imagem')->getClientOriginalExtension();
			$fileName = "". str_random(4) ."_". Str::slug($slug) .".". $extension ."";
			$noticia->imagem = $fileName;
		 	$dir = 'assets/img/noticias';
        	$destination_imagem_principal = $dir;
			Input::file('imagem')->move($destination_imagem_principal, $fileName);
		}
		$noticia->save();
		$noticias = DB::table('noticias')->get();
		return View::make('sistema.noticias.listar')->with('noticias', $noticias);
	}

	public function deletarNoticia($id)
	{
		$noticia = Noticia::find($id);
		$noticia->delete();
		$noticias = DB::table('noticias')->get();
		return View::make('sistema.noticias.listar')->with('noticias', $noticias);
	}


// Usuário
	public function adminUser($id)
	{
		$user = DB::table('users')->where('id', $id)->first();
		return View::make('sistema.usuarios.editar')->with('user', $user);
	}

	public function updateUser($id)
	{
		$user_atualizar = User::find($id);
		$user_atualizar->nome = Input::get('nome');
		$user_atualizar->email = Input::get('email');
		$user_atualizar->password = Hash::make( Input::get('password') );
		$user_atualizar->save();
		return View::make('sistema.index');
	}

// Logout
	public function adminLogout()
	{
		Auth::logout();
		return Redirect::to('login');
	}

}