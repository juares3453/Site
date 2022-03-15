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
	<link href="assets/custom/css/inicio.css" rel="stylesheet" type="text/css">

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
				<h6><b><br></b></h6>
				<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12" id="form">
					<div class="mensagem">
						<b>Bem vindo ao novo portal da Transportes Rasador LTDA</b><br>

						Para navegar selecione a opção desejada no menu ao lado.
					</div>
				</div>
			</div>

		</div>
	</div>

	<?php

	foreach($classMenu->ConsultaLogsPortal($usuario_login,$usuario_inscricao) as $dados){
		if($dados->getInAceiteTermo() != 1){

			include 'modal_mensagem_termo.php';

		} else {

			//Verificar se o cliente possui a flag marcada que exige alterar senha no primeiro login
			foreach ($classValida->ValidaExigeAlteraSenha($usuario_login,$usuario_inscricao) as $dados){
				$exigeAlteraSenha = $dados->getInPermAltContatoCliente();
			}

			//Se tiver marcado = 1 direciona para a pagina de alteração de senha
			if($exigeAlteraSenha == 1){
				header('Location: alterar_senha');
			}
		}
	}

	?>

	<?php include 'modal_mensagem.php'; ?>

	<script src="assets/custom/js/jquery-3.2.1.min.js"></script>
	<script src="assets/custom/js/bootstrap-4.0.0.js"></script>

	<script type="text/javascript">

		$("#modalMsg").on("hidden.bs.modal", function () {
			window.location = "agendamento_entregas";
		});

		$('#modalTermo').modal('show');

	</script>

</body>
</html>
