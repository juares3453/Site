<?php

require_once '../controller/controller_valida_session.php';

include_once '../connection_open.php';

include_once '../controller/controller_valida_login.php';

$usuario_login = session::get_var('usuario');
$usuario_inscricao = session::get_var('cnpj');

$classValida = new ValidaController($conn);

$classValida->ValidaDadosLogin($usuario_login,$usuario_inscricao);

foreach ($classValida->ValidaDadosLogin($usuario_login,$usuario_inscricao) as $dados){
	$DtUltimaVisita = $dados->getDtUltimaVisita();
}

//Verificar se o cliente possui a flag marcada que exige alterar senha no primeiro login
foreach ($classValida->ValidaExigeAlteraSenha($usuario_login,$usuario_inscricao) as $dados){
	$exigeAlteraSenha = $dados->getInPermAltContatoCliente();
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Portal Rasador</title>

	<link rel="icon" type="image/ico" href="assets/img/rasa-ico.ico">

	<!-- Bootstrap -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/custom/css/alterar_senha.css" rel="stylesheet" type="text/css">

</head>
<body>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2 col-sm-2 col-lg-2">
				<img src="assets/img/logo-footer_old.png" class="img-fluid" alt="Placeholder image">
			</div>
			<div class="col-md-10 col-sm-10 col-lg-10">
				<div class="container-fluid" id="cabecalho">
					<strong>Bem vindo ao portal</strong>
					<br>
					Usuário: <b><?php echo $usuario_login; ?></b>
					<br>
					Última Visita: <b><?php echo date('d/m/Y H:i', strtotime($DtUltimaVisita)); ?></b>
					<br>
					<a href="alterar_senha"><u>Alterar Senha</u></a>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">

			<?php include 'menu/menu.php'; ?>

			<div class="col-md-10 col-sm-10 col-lg-10 col-xl-10">
				<?php

				if($exigeAlteraSenha == 1){

					?>

					<h6><b style="color: red;">::.Favor alterar sua senha de acesso!</b></h6>

					<?php

				} else {

					?>
					<h6><b>::.Alterar Senha</b></h6>

					<?php

				}

				?>

				<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12" id="form">
					<form action="" method="POST" accept-charset="utf-8" id="formulario">
						<div id="borda">
							<input type="password" name="SenhaAtual" id="SenhaAtual" placeholder="Senha Atual" required>  
							<input type="password" name="NovaSenha" id="NovaSenha" placeholder="Nova Senha" required>  
							<input type="password" name="ConfirmaSenha" id="ConfirmaSenha" placeholder="Confirma Nova Senha" required>
							<label>  
								<input type="submit" value="Alterar">
							</label>
						</div>
					</form>
				</div>

			</div>

		</div>
	</div>

	<?php include 'modal_mensagem.php'; ?>

	<script src="assets/custom/js/jquery-3.2.1.min.js"></script>
	<script src="assets/custom/js/bootstrap-4.0.0.js"></script>

	<!-- jQuery Validator -->
	<script src="assets/js/jquery-CPF-CNPJ/jquery.cpfcnpj.js"></script>
	<script src="assets/js/jquery-CPF-CNPJ/jquery.mask.js"></script>

	<script type="text/javascript">

		$('#formulario').submit(function(){
			var dados = $('#formulario').serialize();

			$.ajax({
				type : 'POST',
				dataType: 'JSON',
				url  : 'precontroller/precontroller_alterar_senha',
				data: dados,
				success :  function(data){

					if (data.valida == "false") {

						alert(data.msg);

						$(data.campoAtual).removeClass(data.class1);
						$(data.campoAtual).addClass(data.class2);

						$(data.campoNova).removeClass(data.class2);
						$(data.campoNova).addClass(data.class1);

						$(data.campoConfirma).removeClass(data.class2);
						$(data.campoConfirma).addClass(data.class1);

					} else {

						alert(data.msg);

						$("#SenhaAtual").val("");
						$("#NovaSenha").val("");
						$("#ConfirmaSenha").val("");

						document.location.href = 'inicio';

					}

				}

			});

			return false;

		});

		$("#modalMsg").on("hidden.bs.modal", function () {
			window.location = "agendamento_entregas";
		});

	</script>

</body>
</html>
