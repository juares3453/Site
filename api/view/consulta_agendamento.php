<?php

require '../controller/controller_valida_session.php';

include '../connection_open.php';
include '../dao/DAO_consulta_agendamento.php';
include '../modal/modal_consulta_agendamento.php';
include '../controller/controller_consulta_agendamento.php';

include '../dao/DAO_agendamento.php';
include '../modal/modal_agendamento.php';
include '../controller/controller_agendamento.php';

include '../controller/controller_valida_login.php';

$usuario_login = session::get_var('usuario');
$usuario_inscricao = session::get_var('cnpj');
$id_cnpj = session::get_var('id_cnpj');

$class = new ConsultaAgendamentoController($conn);

$classAgendamento = new AgendamentoController($conn);

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
	$dtInicial = $_POST['dtIni'];
	$dtFinal = $_POST['dtFim'];
} else {
	$dtInicial = date('Y-m-d', strtotime('-30 days'));
	$dtFinal = date('Y-m-d', strtotime('+10 days'));
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
	<link href="assets/custom/css/consulta_agendamento.css" rel="stylesheet" type="text/css">

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
				<h6><b>::.Consulta Agendamento de Entregas</b></h6>
				<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12" id="form">
					<form method="POST" action="consulta_agendamento" id="formulario">
						<div id="borda">
							<label>Agendamento:    De    
								<input type="date" name="dtIni" id="dtIni" value="<?php echo $dtInicial; ?>" required>
							</label>

							<label>    Até    
								<input type="date" name="dtFim" id="dtFim"  value="<?php echo $dtFinal; ?>" required>
							</label>

							<label>  
								<input type="submit" value="Pesquisar">
							</label>
						</div>
					</form>

					<br>

					<?php

					foreach($classAgendamento->ListaCnpjID($id_cnpj,$usuario_inscricao) as $dadosCNPJ){
						foreach($class->ListaAgendamentos($dadosCNPJ->getCdRemetente(),$dtInicial,$dtFinal) as $dados){
							$retorno = 1;
						}
					}

					if(isset($retorno)){

						?>

						<div class="container-fluid">
							<div class="row" id="tabela">
								<table id="DataTable">
									<thead>
										<tr>
											<th>NFe Industria</th>
											<th>Nota Fiscal</th>
											<th>Ordem de Compra</th>
											<th>Data Entrega</th>
											<th>Data Agendada</th>
											<th>Destinatário</th>
											<th>CNPJ</th>
											<th>Endereço</th>
											<th>Complemento</th>
											<th>Bairro</th>
											<th>Cidade</th>
											<th>UF</th>
											<th>Cep</th>
											<th>Telefone</th>
											<th>Observação</th>
										</tr>
									</thead>
									<tbody>
										<?php

										foreach($classAgendamento->ListaCnpjID($id_cnpj,$usuario_inscricao) as $dadosCNPJ){

											foreach($class->ListaAgendamentos($dadosCNPJ->getCdRemetente(),$dtInicial,$dtFinal) as $dados){

												?>
												<tr>
													<td><?php echo $dados->getNrNotaFiscalAgend(); ?></td>
													<td><?php echo $dados->getNrNotaFiscal(); ?></td>
													<td><?php echo $dados->getDsMarca(); ?></td>
													<td><?php echo date('d/m/Y', strtotime($dados->getDtEntregaAgendada())); ?></td>
													<td><?php echo date('d/m/Y', strtotime($dados->getDtAgendamento())); ?></td>
													<td><?php echo $dados->getDsDestinatario(); ?></td>
													<td><?php echo $dados->getCdDestinatario(); ?></td>
													<td><?php echo $dados->getDsLocalEntrega(); ?></td>
													<td><?php echo $dados->getDsComplemento(); ?></td>
													<td><?php echo $dados->getDsBairro(); ?></td>
													<td><?php echo $dados->getDsLocal(); ?></td>
													<td><?php echo $dados->getDsUF(); ?></td>
													<td><?php echo $dados->getNrCepEntrega(); ?></td>
													<td><?php echo $dados->getNrTelefone(); ?></td>
													<td><?php echo $dados->getDsObservacao(); ?></td>
												</tr>
												<?php
											}

										}

										?>
									</tbody>
								</table>
							</div>
						</div>

						<?php

					} else {

						echo "Nenhuma nota fiscal agendada para este período...";

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
				{ type: 'date-eu', targets: 3 },
				{ type: 'date-eu', targets: 4 }
				]
			});
		});

		$("#modalMsg").on("hidden.bs.modal", function () {
			window.location = "agendamento_entregas";
		});

	</script>

</body>
</html>