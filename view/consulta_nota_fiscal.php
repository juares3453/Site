<?php

require '../controller/controller_valida_session.php';

include '../connection_open.php';

include '../controller/controller_valida_login.php';

include '../modal/modal_consulta_localizacao.php';
include '../controller/controller_consulta_localizacao.php';
include '../dao/DAO_consulta_localizacao.php';

$usuario_login = session::get_var('usuario');
$usuario_inscricao = session::get_var('cnpj');

$class = new ConsultaLocalizacaoController($conn);

$classValida = new ValidaController($conn);

$classValida->ValidaDadosLogin($usuario_login,$usuario_inscricao);

foreach ($classValida->ValidaDadosLogin($usuario_login,$usuario_inscricao) as $dados){
	$DtUltimaVisita = $dados->getDtUltimaVisita();
}

//Verificar se o cliente possui a flag marcada que exige alterar senha no primeiro login
foreach ($classValida->ValidaExigeAlteraSenha($usuario_login,$usuario_inscricao) as $dados){
	$exigeAlteraSenha = $dados->getInPermAltContatoCliente();
}

//Se tiver marcado = 1 direciona para a pagina de alteração de senha
if($exigeAlteraSenha == 1){
	header('Location: alterar_senha');
}

if(isset($_POST) && !empty($_POST)){
	$tpCnpj = $_POST['tpCnpj'];
	$cnpjForm = $_POST['cnpjForm'];
	$NotaFiscalForm = $_POST['NotaFiscalForm'];
	$xForm = $_POST['xForm'];
} else {
	$cnpjForm = '';
	$NotaFiscalForm = '';
	$tpCnpj = '0';
	$xForm = '';
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
	<link href="assets/custom/css/consulta_nota_fiscal.css" rel="stylesheet" type="text/css">

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

			<div class="col-md-12 col-sm-12 col-lg-10 col-xl-10">
				<h6><b>::.Consulta Localização Nota Fiscal</b></h6>

				<form action="consulta_nota_fiscal" method="POST" accept-charset="utf-8" id="formulario">
					<div class="col-md-5 col-sm-5 col-lg-5 col-xl-5" id="form">
						<input type="hidden" name="xForm" value="1">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="tpCnpj" id="exampleRadios1" value="0" <?php echo $tpCnpj == '0' ? 'checked' : '';?>>
							<label class="form-check-label" for="exampleRadios1">Remetente</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="tpCnpj" id="exampleRadios2" value="1" <?php echo $tpCnpj == '1' ? 'checked' : '';?>>
							<label class="form-check-label" for="exampleRadios2">Destinatário</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="tpCnpj" id="exampleRadios2" value="2" <?php echo $tpCnpj == '2' ? 'checked' : '';?>>
							<label class="form-check-label" for="exampleRadios2">Cliente</label>
						</div>
						<br>
						<label><b>CNPJ/CPF:  </b></label><input type="text" name="cnpjForm" id="Cnpj" value="<?php echo $cnpjForm; ?>" required><br>
						<label><b>Nota Fiscal:  </b></label><input type="number" name="NotaFiscalForm" id="NotaFiscal" value="<?php echo $NotaFiscalForm; ?>" required>
						<label><input type="submit" id="botao" value="Pesquisar"></label>
					</div>
				</form>

				<br>

				<?php

				$x = 0;

				foreach($class->ListaDadosNotaFiscal($tpCnpj,$NotaFiscalForm,$cnpjForm) as $dados) {
					$x = 1;
				}

				if($x == 1){

					?>

					<table>
						<thead>
							<tr>
								<th>Conhecimento</th>
								<th>Data Emissão</th>
								<th>Cliente</th>
								<th>Remetente</th>
								<th>Destinatário</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($class->ListaDadosNotaFiscal($tpCnpj,$NotaFiscalForm,$cnpjForm) as $dados) {?>
								<tr>
									<td><?php echo $dados->getCTe(); ?></td>
									<td><?php echo $dados->getDtEmissao(); ?></td>
									<td><?php echo $dados->getCliente(); ?></td>
									<td><?php echo $dados->getRemetente(); ?></td>
									<td><?php echo $dados->getDestinatario(); ?></td>
								</tr>
								<?php $CdRemetente = $dados->getCdRemetente(); } ?>
							</tbody>
						</table>

						<br>

						<?php

						foreach($class->ListaDadosNotaFiscal($tpCnpj,$NotaFiscalForm,$cnpjForm) as $dados) {

							?>

							<div class="row" id="subtitulo">
								<div class="col-md-7 col-sm-7 col-lg-7 col-xl-7">
									<h5><b>::.Detalhes do Conhecimento</b></h5>
								</div>
								<div class="col-md-5 col-sm-5 col-lg-5 col-xl-5" style="text-align: right;">
									<button type="input" data-toggle="modal" data-target=".tete" style="margin-top: 8px;">Histórico</button>
								</div>
							</div>
							<div class="row" id="detalhetexto">
								<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12" style="padding-left: 35px!important; font-size: 12px;">
									Conhecimento: <?php echo $dados->getCTe(); ?><br>
									Remetente: <?php echo $dados->getRemetente(); ?><br>
									Destinatário: <?php echo $dados->getDestinatario(); ?>
								</div>
							</div>

							<div class="row" id="icones">
								<?php if($class->OcultaData($dados->getDtEmissao()) != ''){ ?>
									<div class="col" style="font-size: 13px; text-align: center;">
										<b>Emissão CTRC.</b><br><br>
										<img src="assets/img/CM.png" width="27%"><br><br>
										<b>Data: <?php echo $class->OcultaData($dados->getDtEmissao()); ?></b><br>
										<b>Concluído</b>
									</div>
								<?php } ?>

								<?php if($class->OcultaData($dados->getDtSaidaOr()) != ''){ ?>
									<div class="col" style="font-size: 13px; text-align: center;">
										<b>Saída Filial Origem</b><br><br>
										<img src="assets/img/CM.png" width="27%"><br><br>
										<b>Data: <?php echo $class->OcultaData($dados->getDtSaidaOr()); ?></b><br>
										<b>Concluído</b>
									</div>
								<?php } else { ?>
									<div class="col" style="font-size: 13px; text-align: center;">
										<b>Saída Filial Origem</b><br><br>
										<img src="assets/img/CC.png" width="27%"><br><br>
										<b>Data: <?php echo $class->OcultaData($dados->getDtSaidaOr()); ?></b><br>
									</div>
								<?php } ?>

								<?php if($class->OcultaData($dados->getDtChegada()) != ''){ ?>
									<div class="col" style="font-size: 13px; text-align: center;">
										<b>Chegada Filial Destino</b><br><br>
										<img src="assets/img/CM.png" width="27%"><br><br>
										<b>Data: <?php echo $class->OcultaData($dados->getDtChegada()); ?></b><br>
										<b>Concluído</b>
									</div>
								<?php } else { ?>
									<div class="col" style="font-size: 13px; text-align: center;">
										<b>Chegada Filial Destino</b><br><br>
										<img src="assets/img/CC.png" width="27%"><br><br>
										<b>Data: <?php echo $class->OcultaData($dados->getDtChegada()); ?></b><br>
									</div>
								<?php } ?>

								<?php if($class->OcultaData($dados->getDtArmazenada()) != ''){ ?>
									<div class="col" style="font-size: 13px; text-align: center;">
										<b>Mercadoria Armazenada</b><br><br>
										<img src="assets/img/CM.png" width="27%"><br><br>
										<b>Data: <?php echo $dados->getDtArmazenada(); ?></b><br>
										<b>Concluído</b>
									</div>
								<?php } ?>

								<?php if($class->OcultaData($dados->getDtAgendamento()) != ''){ ?>
									<div class="col" style="font-size: 13px; text-align: center;">
										<b>Entrega Agendada</b><br><br>
										<img src="assets/img/CM.png" width="27%"><br><br>
										<b>Data: <?php echo $dados->getDtAgendamento(); ?></b><br>
										<b>Concluído</b>
									</div>
								<?php } ?>

								<?php if($class->OcultaData($dados->getDtSaidaEnt()) != ''){ ?>
									<div class="col" style="font-size: 13px; text-align: center;">
										<b>Saiu para a Entrega</b><br><br>
										<img src="assets/img/CM.png" width="27%"><br><br>
										<b>Data: <?php echo $class->OcultaData($dados->getDtSaidaEnt()); ?></b><br>
										<b>Concluído</b>
									</div>
								<?php } else { ?>
									<div class="col" style="font-size: 13px; text-align: center;">
										<b>Saiu para a Entrega</b><br><br>
										<img src="assets/img/CC.png" width="27%"><br><br>
										<b>Data: <?php echo $class->OcultaData($dados->getDtSaidaEnt()); ?></b><br>
									</div>
								<?php } ?>

								<?php if($class->OcultaData($dados->getDtEntrega()) != ''){ ?>
									<div class="col" style="font-size: 13px; text-align: center;">
										<b>Entregue</b><br><br>
										<img src="assets/img/CM.png" width="27%"><br><br>
										<b>Data: <?php echo $class->OcultaData($dados->getDtEntrega()); ?></b><br>
										<b>Concluído</b>
									</div>
								<?php } else { ?>
									<div class="col" style="font-size: 13px; text-align: center;">
										<b>Entregue</b><br><br>
										<img src="assets/img/CC.png" width="27%"><br><br>
										<b>Data: <?php echo $class->OcultaData($dados->getDtPrevEntrega()); ?></b><br>
										<b>Previsão de Entrega</b>
									</div>
								<?php } ?>

							</div>

							<?php
						}

					} else if ($x == 0 && $xForm == 1){
						echo '<div class="container-fluid">';
						echo 'Nenhum valor encontrado para está consulta...';
						echo '</div>';
					}

					?>

				</div>
			</div>
		</div>

		<br>

		<?php include 'modal_mensagem.php'; ?>

		<div class="modal fade tete" id="modalTeste" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<div class="container">
							<b>Histórico da Nota Fiscal</b>
						</div>
						<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table>
							<thead>
								<tr>
									<th>Descrição</th>
									<th>Data</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($class->ListaHistorico($CdRemetente,$NotaFiscalForm) as $dados) {?>
									<tr>
										<?php if($class->OcultaData($dados->getData()) != ''){ ?>
											<td><?php echo $dados->getHistorico(); ?></td>
											<td><?php echo $dados->getData(); ?></td>
										<?php } ?>
									</tr>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<script src="assets/custom/js/jquery-3.2.1.min.js"></script>
		<script src="assets/custom/js/bootstrap-4.0.0.js"></script>

		<!-- jQuery Validator -->
		<script src="assets/js/jquery-CPF-CNPJ/jquery.cpfcnpj.js"></script>
		<script src="assets/js/jquery-CPF-CNPJ/jquery.mask.js"></script>

		<script type="text/javascript">

			$("#modalMsg").on("hidden.bs.modal", function () {
				window.location = "agendamento_entregas";
			});

			$(document).ready(function (){
				$('#Cnpj').cpfcnpj({
					mask: false,
					validate: 'cpfcnpj',
					event: 'focusout',
					handler: '#Cnpj',
					ifValid: function (input) { },
					ifInvalid: function (input) { alert('CNPJ/CPF inválido'); $('#Cnpj').val(""); }
				});
			});

		</script>

	</body>
	</html>
