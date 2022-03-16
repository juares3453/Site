<?php

require_once 'controller/controller_valida_session.php';

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
					<p class="subTitulo"><b>Acesso restrito !</b></p>
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
					<form method="post" action="precontroller_login">

						<input type="number" name="cnpj" id="cnpj" required placeholder="CNPJ / CPF">
						<input type="text" name="user" required placeholder="Usuário">
						<input type="password" name="pass" required placeholder="Senha">

						<?php

						if(isset($_POST['code']) && !empty($_POST['code'])){

							include 'controller/controller_index.php';

							$class = new IndexController();

							if($_POST['code'] == '55'){

								echo $class->RetornoMensagem($_POST['code'],$_POST['valor']);

							} else {

								$_POST['valor'] = 0;
								echo $class->RetornoMensagem($_POST['code'],$_POST['valor']);

							}

						}

						?>

						<a href="novo_usuario"><u>Novo usuário ? Solicite acesso</u></a>
						<br><br>
						<input type="submit" class="tiny button" value="Entrar"/>
						<button class="tiny secondary button" onclick="window.location.href='recuperar_senha';">Recuperar Senha</button>
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