<?php 

header('Content-Type: text/html; charset=utf-8');

require '../controller/controller_valida_session.php'; 

include '../connection_open.php';

include '../dao/DAO_login.php';
include '../modal/modal_login.php';
include '../controller/controller_login.php';


if (isset($_POST) && !empty($_POST)){

	$dados = array();

	$usuario_login = session::get_var('usuario');
	$usuario_inscricao = session::get_var('cnpj');

	$senhaAtual = $_POST['SenhaAtual'];
	$NovaSenha = $_POST['NovaSenha'];
	$ConfirmaSenha = $_POST['ConfirmaSenha'];

	$class = new LoginController($conn);

	foreach($class->ConsultaDadosLoginPortal($usuario_login,$usuario_inscricao) as $dados){

		if($senhaAtual == $dados->getDsSenha()){

			if($NovaSenha == $ConfirmaSenha){

				$obj = new LoginModal();
				$obj->setDsLogin($usuario_login);
				$obj->setCdInscricao($usuario_inscricao);
				$obj->setDsSenha($NovaSenha);

				//Chama update Altera Senha
				$class->AlteraSenha($obj);

				$info['msg'] = "Senha Alterada com sucesso !";
				$info['valida'] = "true";

				echo json_encode($info);

			} else {

				$info['campoAtual'] = "#SenhaAtual";
				$info['campoNova'] = "#NovaSenha";
				$info['campoConfirma'] = "#ConfirmaSenha";
				//Deixar em branco a borda da senha Atual
				$info['class1'] = 'color';
				$info['class2'] = '';

				$info['valida'] = "false";
				$info['msg'] = "Confirmação da Senha inválida";

				echo json_encode($info);

			}

		} else {

			$info['campoAtual'] = "#SenhaAtual";
			$info['campoNova'] = "#NovaSenha";
			$info['campoConfirma'] = "#ConfirmaSenha";

			//Deixar em branco a borda do resto
			$info['class1'] = '';
			$info['class2'] = 'color';

			$info['valida'] = "false";
			$info['msg'] = "Senha Atual inválida";

			echo json_encode($info);

		}
	}
}
