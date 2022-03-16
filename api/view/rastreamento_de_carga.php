<?php

require '../controller/controller_valida_session.php';

include '../connection_open.php';
include '../controller/controller_rastreamento.php';
include '../dao/DAO_rastreamento.php';
include '../modal/modal_rastreamento.php';
include '../controller/controller_valida_login.php';

$usuario_login = session::get_var('usuario');
$usuario_inscricao = session::get_var('cnpj');
$id_cnpj = session::get_var('id_cnpj');

$class = new RastreamentoController($conn);

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

//Chama classe da modal
$obj = new RastreamentoModal();

$obj->setUsuarioCdInscricao($usuario_inscricao);

//Dados do POST
if(isset($_POST['DtInicial']) && isset($_POST['DtFinal'])){
	$obj->setDtInicial($_POST['DtInicial']);
	$obj->setDtFinal($_POST['DtFinal']);
} else {
	$obj->setDtInicial(date('Y-m-d', strtotime("- 30 days")));
	$obj->setDtFinal(date('Y-m-d'));
}

if(isset($_POST['NrNFe'])) {
	$obj->setNrNFe($_POST['NrNFe']);
} else {
	$obj->setNrNFe('');
}

if(isset($_POST['stNfe'])) {
	$obj->setStNFe($_POST['stNfe']);
} else {
	$obj->setStNFe('1');
}

if(isset($_POST['nrCTe']) && !empty($_POST['nrCTe'])) {
	$obj->setCTe($_POST['nrCTe']);
} else {
	$obj->setCTe('0');
}

if(isset($_POST['stCTe'])) {
	$obj->setStCte($_POST['stCTe']);
} else {
	$obj->setStCte('1');
}

if(isset($_POST['rem']) && !empty($_POST['rem'])) {
	$obj->setCdRemetente($_POST['rem']);
} else {
	$obj->setCdRemetente('0');
}

if(isset($_POST['dest']) && !empty($_POST['dest'])) {
	$obj->setCdDestinatario($_POST['dest']);
} else {
	$obj->setCdDestinatario('0');
}

//ID do usuário
$obj->setID($id_cnpj);

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
	<link href="assets/custom/css/rastreamento_de_carga.css" rel="stylesheet" type="text/css">

</head>
<body>
	<!-- body code goes here -->

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
				<h6><b>::.Rastreamento de Cargas</b></h6>
				<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12" id="form">
					<form method="POST" action="rastreamento_de_carga" id="formulario">
						<div id="borda">
							<label>Data de Emissão Inicial<br>
								<input type="date" name="DtInicial" min="<?php echo date('Y-m-d', strtotime('-60 days')); ?>" value="<?php echo $obj->getDtInicial(); ?>">
							</label>

							<label>Data de Emissão Final<br>
								<input type="date" name="DtFinal" value="<?php echo $obj->getDtFinal(); ?>">
							</label>

							<label>Nr. Nota Fiscal<br>
								<input type="number" name="NrNFe" value="<?php echo $obj->getNrNFe(); ?>">
							</label>

							<label>Situação Nota Fiscal<br>
								<select name="stNfe">
									<option value="1" <?= $obj->getStNFe() == '1' ? 'selected' : ''; ?>>Todos</option>
									<option value="2" <?= $obj->getStNFe() == '2' ? 'selected' : ''; ?>>Recebidas</option>
									<option value="3" <?= $obj->getStNFe() == '3' ? 'selected' : ''; ?>>Emitidas</option>
									<option value="4" <?= $obj->getStNFe() == '4' ? 'selected' : ''; ?>>Pagas</option>
								</select>
							</label><br>

							<label>Nr. Conhecimento<br>
								<input type="number" name="nrCTe" value="<?php if($obj->getCTe() == '0'){ echo ''; } else { echo $obj->getCTe(); }; ?>">
							</label>

							<label>Situação Conhecimento<br>
								<select name="stCTe">
									<option value="1" <?= $obj->getStCte() == '1' ? 'selected' : ''; ?>>Todos</option>
									<option value="2" <?= $obj->getStCte() == '2' ? 'selected' : ''; ?>>Entregue</option>
									<option value="3" <?= $obj->getStCte() == '3' ? 'selected' : ''; ?>>Não Entregue</option>
								</select>
							</label>

							<label>Remetente<br>
								<input type="number" name="rem" value="<?php if($obj->getCdRemetente() == '0'){ echo ''; } else { echo $obj->getCdRemetente(); }; ?>">
							</label>

							<label>Destinatário<br>
								<input type="number" name="dest" value="<?php if($obj->getCdDestinatario() == '0'){ echo ''; } else { echo $obj->getCdDestinatario(); }; ?>">
							</label>

							<label>  
								<input type="submit" value="Pesquisar">
							</label>

						</div>
					</form>

					<?php

					foreach($class->ListaRastreamentos($obj) as $dados) {
						$retorno = 1;
					}

					if(isset($retorno)) {

						?>

						<br>
						<div class="container-fluid">
							<div class="row" id="tabela">
								<table id="DataTable">
									<thead>
										<tr>
											<th>CNPJ Remetente</th>
											<th>Remetente</th>
											<th>Cidade do remetente</th>
											<th>Nota Fiscal</th>
											<th>Conhecimento</th>
											<th>Pedido</th>
											<th>OC</th>
											<th>CNPJ do Destinatário</th>
											<th>Destinatário</th>
											<th>Cidade do Destinatário</th>
											<th>Data Emissão</th>
											<th>Previsão Entrega</th>
											<th>Data Entrega</th>
											<?php if($CdPerfil != '105'){?>
												<th>Valor</th>
											<?php } ?>
											<th>Vl.Frete</th>
											<th>Peso</th>
											<th>Volumes</th>
											<th>Situação</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($class->ListaRastreamentos($obj) as $dados) { ?>
											<tr>
												<td><?php echo $dados->getCdRemetente(); ?></td>
												<td><?php echo $dados->getRemetente(); ?></td>
												<td><?php echo $dados->getCidadeRem(); ?></td>
												<td><?php echo $dados->getNotaFiscal(); ?></td>
												<td><?php echo $dados->getCTe(); ?></td>
												<td><?php echo $dados->getPedido(); ?></td>
												<td><?php echo $dados->getOC(); ?></td>
												<td><?php echo $dados->getCdDestinatario(); ?></td>
												<td><?php echo $dados->getDestinatario(); ?></td>
												<td><?php echo $dados->getCidadeDest(); ?></td>
												<td><?php echo $dados->getDtEmissao(); ?></td>
												<td><?php echo $dados->getDtPrevEntrega(); ?></td>
												<td><?php echo $class->OcultaData($dados->getDtEntrega()); ?></td>
												<?php if($CdPerfil != '105'){?>
													<td class="direita"><?php echo number_format($dados->getVlrNota(), 2, ',', '.'); ?></td>
												<?php } ?>
												<td class="direita"><?php echo number_format($dados->getFrete(), 2, ',', '.'); ?></td>
												<td class="direita"><?php echo number_format($dados->getPesoNota(), 2, ',', '.'); ?></td>
												<td><?php echo $dados->getVolumeNota(); ?></td>
												<td <?php if($dados->getDsSituacaoCarga() == 'MERCADORIA ENTREGUE'){
													echo 'class=green';
												} ?>> <?php echo $dados->getDsSituacaoCarga(); ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>

						<?php

					} else {

						echo '<br>';
						echo "Nenhum resultado para consulta realizada...";

					}

					?>
				</div>
			</div>
		</div>
	</div>

	<?php include 'modal_mensagem.php'; ?>

	<script src="assets/custom/js/jquery-3.2.1.min.js"></script>
	<script src="assets/custom/js/bootstrap-4.0.0.js"></script>

	<!-- Script para datable -->
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.foundation.min.js"></script>
	<!--Script para ordenar a data-->
	<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.16/sorting/date-eu.js"></script>

	<script type="text/javascript">

		//Data Table
		$(document).ready(function() {
			$('#DataTable').DataTable({
				"language": {
					"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json",
					"decimal": ",",
					"thousands": "."
				},
				"paging":   false,
				"ordering": true,
				"info":     false,
				"dom": 'none',
				columnDefs: [
				{ type: 'date-eu', targets: 10 },
				{ type: 'date-eu', targets: 11 }
				]
			});
		});

		$("#modalMsg").on("hidden.bs.modal", function () {
			window.location = "agendamento_entregas";
		});

	</script>

</body>
</html>