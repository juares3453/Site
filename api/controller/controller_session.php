<?php

class session{

	public static function iniciar(){

		self::fechar();
		session_name('PortalSession');
		session_start();
		self::set_var('last_activity', time());
		return session_id();

	}

	public static function set_var($i,$v=NULL){

		$_SESSION[$i] = $v;

	}

	public static function show_vars(){

		echo '<pre>';
		print_r($_SESSION);
		echo '</pre>';

	}

	public static function get_id(){

		return session_id();

	}

	public static function get_var($var){

		if(isset($_SESSION[$var])){
			return $_SESSION[$var];
		}

	}

	public static function verifica_sessao(){
		//session_set_cookie_params(3600);
		session_name('PortalSession');
		session_start();

		$logado = false;

		// if(!empty($_SESSION['id_usuario']) && !empty($_SESSION['hash_id'])) {
		// 	if(md5(gethostbyaddr($_SERVER['REMOTE_ADDR'])) != @$_SESSION['hash_id']){

		// 		self::fechar();

		// 	} else {

		// 		$logado = true;

		// 	}
		// }


		if(!empty($_SESSION['id_usuario'])) {
		
				$logado = true;

			}
		


		return $logado;

	}

	public static function fechar(){

		session_regenerate_id();
		session_name('PortalSession');
		session_unset();
		session_destroy();

	}

}

?>