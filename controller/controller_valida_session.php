<?php

require_once 'controller_session.php';

$explode = explode("/", $_SERVER['PHP_SELF']);

if(in_array('index.php', $explode)){
	session::fechar();
}

if(!in_array('index.php', $explode) && !in_array('../precontroller/precontroller_login.php', $explode)){

	//Valida se está logado
	$login = session::verifica_sessao();

	if(!$login){

		session::fechar();
		//header("location: index");
		exit();

	}

	//Se o usuário ficar inativo por 60 min a sessão expira
	if (!empty(session::get_var('last_activity')) && (time() - session::get_var('last_activity') > 3600)) {

		session::fechar();

		?>

		<form action="index" method="POST" accept-charset="utf-8" name="session_expirada">
			<input type="hidden" name="code" value="33">
		</form>

		<script language="JavaScript">document.session_expirada.submit();</script>

		<?php

		exit();

	} else {

		//Atualiza o time da session
		session::set_var('last_activity', time());

	}

	//Ajusta a datetime da session
	$dataSession = new DateTime(session::get_var('data_logado'));
	$dataSession = $dataSession->format('Y-m-d H:i:s');
	$dataAtual = date('Y-m-d H:i:s', strtotime('-24 hour'));

	//Fecha a sessao depois de um dia
	if(strtotime($dataSession) == strtotime($dataAtual)){

		session::fechar();

		?>

		<form action="index" method="POST" accept-charset="utf-8" name="session_expirada">
			<input type="hidden" name="code" value="33">
		</form>

		<script language="JavaScript">document.session_expirada.submit();</script>

		<?php

		exit();
	}

}  else {

	$login = session::verifica_sessao();

	//Valida se o usuário já está logado
	$usuario_login = session::get_var('usuario');

	if(!empty($usuario_login)){

		header('Location: inicio');

	}

}

?>