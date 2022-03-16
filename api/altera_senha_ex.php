<?php

function get_browser_name($user_agent){

	if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
	elseif (strpos($user_agent, 'Edge')) return 'Edge';
	elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
	elseif (strpos($user_agent, 'Safari')) return 'Safari';
	elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
	elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';

	return 'Other';
}

if(get_browser_name($_SERVER['HTTP_USER_AGENT']) != 'Internet Explorer'){
	if(get_browser_name($_SERVER['HTTP_USER_AGENT']) != 'Other'){

		if(isset($_POST['code'])){

			?>

			<!DOCTYPE html>
			<html lang="pt">
			<head>
				<meta charset="utf-8">

				<title>Portal Rasador</title>
				<link rel="icon" type="image/ico" href="assets/img/rasa-ico.ico">

				<link href="assets/foundation-5/css/foundation.min.css" rel="stylesheet" type="text/css">
				<link href="assets/css/index.css" rel="stylesheet" type="text/css">

			</head>
			<body>
				<br>

				<div class="row">
					<div class="large-4 medium-4 small-4 columns">
						&nbsp;
					</div>
					<div class="large-4 medium-4 small-4 columns">
						<img src="assets/img/logo-footer_old.png" alt="Logo Footer" id="fade">
					</div>
					<div class="large-4 medium-4 small-4 columns">
						&nbsp;
					</div>
				</div>

				<div class="row">
					<div class="large-4 medium-4 small-4 columns">
						&nbsp;
					</div>
					<div class="large-4 medium-4 small-4 columns">
						<p class="titulo"><b>BEM VINDO AO PORTAL</b></p>
						<p class="subTitulo"><b>Alteração de Senha</b></p>
					</div>
					<div class="large-4 medium-4 small-4 columns">
						&nbsp;
					</div>
				</div>

				<div class="row">
					<div class="large-3 medium-3 small-3 columns">
						&nbsp;
					</div>
					<div class="large-6 medium-6 small-6 columns">
						<form method="post" action="precontroller/precontroller_altera_senha_ex">
							<h5 style="text-align: center; color: green;"><b>* Senha alterada com sucesso.</b></h5>
							<br>
							<h5 style="text-align: center;"><a class="tiny secondary button" href="index" ;">Voltar</a></h5>
						</form>
					</div>
					<div class="large-3 medium-3 small-3 columns">
						&nbsp;
					</div>
				</div>

				<script src="assets/custom/js/jquery-3.2.1.min.js"></script>

				<script>

					$(document).ready(function(){
						$("#fade").fadeIn(2000);
					});

				</script>
			</body>
			</html>

			<?php
		//Sem hash não entra - direciona para o inicio
		} else if(!isset($_GET['hash'])){

			header('location: index');
			exit();

		} else {

			include 'connection_open.php';
			include 'dao/DAO_login.php';
			include 'modal/modal_login.php';
			include 'controller/controller_login.php';

			$class = new LoginController($conn);

			foreach($class->ValidaHashSenha($_GET['hash']) as $dados){
				$cnpj = $dados->getCdInscricao();
			}

			?>

			<!DOCTYPE html>
			<html lang="pt">
			<head>
				<meta charset="utf-8">

				<title>Portal Rasador</title>
				<link rel="icon" type="image/ico" href="assets/img/rasa-ico.ico">

				<link href="assets/foundation-5/css/foundation.min.css" rel="stylesheet" type="text/css">
				<link href="assets/css/index.css" rel="stylesheet" type="text/css">

			</head>
			<body>
				<br>

				<div class="row">
					<div class="large-4 medium-4 small-4 columns">
						&nbsp;
					</div>
					<div class="large-4 medium-4 small-4 columns">
						<img src="assets/img/logo-footer_old.png" alt="Logo Footer" id="fade">
					</div>
					<div class="large-4 medium-4 small-4 columns">
						&nbsp;
					</div>
				</div>

				<div class="row">
					<div class="large-4 medium-4 small-4 columns">
						&nbsp;
					</div>
					<div class="large-4 medium-4 small-4 columns">
						<p class="titulo"><b>BEM VINDO AO PORTAL</b></p>
						<p class="subTitulo"><b>Alteração de Senha</b></p>
					</div>
					<div class="large-4 medium-4 small-4 columns">
						&nbsp;
					</div>
				</div>

				<div class="row">
					<div class="large-3 medium-3 small-3 columns">
						&nbsp;
					</div>
					<div class="large-6 medium-6 small-6 columns">
						<form method="post" action="precontroller/precontroller_altera_senha_ex">

							<?php

							if(isset($cnpj)){

								?>
								<input type="hidden" name="cnpj" required value="<?php echo $cnpj; ?>">
								<select name="usuario" required>
									<option selected disabled>Selecione um usuário para alterar a senha</option>
									<?php foreach($class->ListaSenhaUsuario($cnpj) as $dados){?>
									<option><?php echo $dados->getDsLogin(); ?></option>
									<?php } ?>
								</select>
								<br>
								<input type="password" name="senha" id="senha" required placeholder="Informe uma nova senha">
								<br>
								<input type="submit" class="tiny button" value="Alterar Senha"/>
								<button class="tiny secondary button" onclick="window.location.href='index';">Voltar</button>

								<?php

							} else {

								?>

								<h5 style="text-align: center;"><b>* Link expirado, favor solicitar uma nova recuperação de senha.</b></h5>
								<br>
								<h5 style="text-align: center;"><a class="tiny secondary button" href="index" ;">Voltar</a></h5>

								<?php

							}

							?>

						</form>
					</div>
					<div class="large-3 medium-3 small-3 columns">
						&nbsp;
					</div>
				</div>

				<script src="assets/custom/js/jquery-3.2.1.min.js"></script>

				<script>

					$(document).ready(function(){
						$("#fade").fadeIn(2000);
					});

				</script>
			</body>
			</html>

			<?php
		}

	} else {
		echo '<fieldset>';
		echo '<br>';
		echo ' Este navegador não está homologado para uso do Portal Rasador.
		<p>Por gentiliza acesse com qualquer outro navegador.</p>';
		echo '</fieldset>';
	}

} else {
	echo '<fieldset>';
	echo '<br>';
	echo ' O navegador <b>Internet Explorer</b> não está homologado para uso do Portal Rasador.
	<p>Por gentiliza acesse com qualquer outro navegador.</p>';
	echo '</fieldset>';
}


?>