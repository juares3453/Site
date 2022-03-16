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

		?>

		<!DOCTYPE html>
		<html lang="pt">
		<head>
			<meta charset="utf-8">

			<title>Portal Rasador</title>
			<link rel="icon" type="image/ico" href="assets/img/rasa-ico.ico">

			<link href="assets/foundation-5/css/foundation.min.css" rel="stylesheet" type="text/css">
			<link href="assets/css/index.css" rel="stylesheet" type="text/css">

			<script src='https://www.google.com/recaptcha/api.js'></script>
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
					<p class="subTitulo"><b>Solicitação de novo usuário !</b></p>
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
					<form method="post" action="precontroller/precontroller_novo_usuario">
						<input type="text" name="cnpj" id="cnpj" required placeholder="CNPJ / CPF">
						<input type="text" name="nome" required placeholder="Nome">
						<input type="email" name="email" required placeholder="Email">

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
						<div class="g-recaptcha" data-sitekey="6LdPWHgaAAAAAGix6qfVwcvlyyyyjeH40kVOA8NE"></div>
						<br>
						<input type="submit" class="tiny button" value="Solicitar"/>
						<button class="tiny secondary button" onclick="window.location.href='index';">Voltar</button>
					</form>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					&nbsp;
				</div>
			</div>

			<script src="assets/custom/js/jquery-3.2.1.min.js"></script>
			<!-- jQuery Validator -->
			<script src="assets/js/jquery-CPF-CNPJ/jquery.cpfcnpj.js"></script>
			<script src="assets/js/jquery-CPF-CNPJ/jquery.mask.js"></script>
			<script>

				$(document).ready(function (){
					$('#cnpj').cpfcnpj({
						mask: true,
						validate: 'cpfcnpj',
						event: 'focusout',
						handler: '#cnpj',
						ifValid: function (input) { },
						ifInvalid: function (input) { alert('CNPJ/CPF inválido'); $('#cnpj').val(""); }
					});
				});

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