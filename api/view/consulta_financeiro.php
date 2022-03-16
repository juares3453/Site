<?php

require '../controller/controller_valida_session.php';

include '../connection_open.php';
include '../dao/DAO_consulta_financeiro.php';
include '../modal/modal_consulta_financeiro.php';
include '../controller/controller_consulta_financeiro.php';

include '../dao/DAO_agendamento.php';
include '../modal/modal_agendamento.php';
include '../controller/controller_agendamento.php';

include '../fatura/controller/controller.php';
include '../fatura/dao/dao.php';
include '../fatura/modal/modal.php';

include '../controller/controller_valida_login.php';

$usuario_login = session::get_var('usuario');
$usuario_inscricao = session::get_var('cnpj');
$id_cnpj = session::get_var('id_cnpj');
$dtUltimoAcesso = session::get_var('data_logado');

$class = new ConsultaFinanceiroController($conn);

$classAgendamento = new AgendamentoController($conn);

$classValida = new ValidaController($conn);

$classFatura = new Controller($conn);

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
	$dias = $_POST['dias'];
	$stFat = $_POST['stFat'];
} else {
	$dias = 30;
	$stFat = 5;
}

$NrNFSe = 0;

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
	<link href="assets/custom/css/consulta_financeiro.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="assets/foundation-icons/foundation-icons.css" />

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
				<h6><b>::.Consulta Faturas</b></h6>
				<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12" id="form">
					<form method="POST" action="consulta_financeiro" id="formulario">
						<div id="borda">
							<label>Listar os últimos:  
								<input type="number" name="dias" id="dias" max="150" min="30" value="<?php echo $dias; ?>" required>
							</label>  
							<label>Situação da Fatura:  
								<select name="stFat" required>
									<option value="5" <?= $stFat == '5' ? 'selected' : ''; ?>>Todas Situações</option>
									<option value="0" <?= $stFat == '0' ? 'selected' : ''; ?>>À Vencer</option>
									<option value="1" <?= $stFat == '1' ? 'selected' : ''; ?>>Vencidas</option>
									<option value="2" <?= $stFat == '2' ? 'selected' : ''; ?>>Pagas</option>
								</select>
							</label>
							<label>  
								<input type="submit" value="Pesquisar">
							</label>
						</div>
					</form>

					<br>

					<div class="container-fluid" id="tabela">
						<div class="row">
							<table id="DataTable">
								<thead>
									<tr>
										<th>Fatura</th>
										<th>NFSe</th>
										<th>Vencimento</th>
										<th>Valor Original</th>
										<th>Saldo</th>
										<th>Detalhe</th>
										<th>NFSe</th>
										<th>Boleto</th>
									</tr>
								</thead>
								<tbody>
									<?php

									foreach($classAgendamento->ListaCnpjID($id_cnpj,$usuario_inscricao) as $dadosCNPJ){

										$cont = 0;

										foreach($class->ListaFaturas($dias,$stFat,$dadosCNPJ->getCdRemetente()) as $dados){

											$cont++;

											$VlFrete = 0;

											foreach($classFatura->ListaDetalheFatura($dados->getInProprioTerceiros() ,$dados->getNrFatura(), $dados->getCdFilial(), $dados->getCdParcela(), $dadosCNPJ->getCdRemetente()) as $dadosFatura) {
												$VlFrete += $dadosFatura->getVlFrete();
											}

											?>
											<tr <?php echo $class->ValidaVencimento($dados->getDtVencimento(),$dados->getVlSaldo()); ?>>
												<td><?php echo $dados->getNrFatura(); ?></td>
												<td>
													<?php

													foreach($class->ListaNFSe($dadosCNPJ->getCdRemetente(), $dados->getNrFatura(), $dados->getCdFilial()) as $dadosNFSe){
														echo $NrNFSe = $dadosNFSe->getNrFatura();
													}

													?>
												</td>
												<td><?php echo date('d/m/Y', strtotime($dados->getDtVencimento())); ?></td>
												<td class="direita"><?php echo 'R$ '.number_format($dados->getVlLiquidoOriginal(), 2, ',', '.'); ?></td>
												<td class="direita"><?php echo 'R$ '.number_format($dados->getVlSaldo(), 2, ',', '.'); ?></td>
												<?php echo $class->GeraDetalheFatura($dados->getInProprioTerceiros(), $dados->getNrFatura(), $dados->getCdPortador(), $dados->getCdFilial(), $dadosCNPJ->getCdRemetente(), $dados->getCdParcela(),$cont, $VlFrete, $dados->getDtVencimento()); ?>
												<?php echo $class->GeraNFSe($dadosCNPJ->getCdRemetente(), $dados->getNrFatura(), $dados->getCdFilial()); ?>
												<?php echo $class->GeraBoleto($dados->getNrFatura(),$dados->getCdFilial());?>

											</tr>
											<?php

										}

									}

									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include 'modal_mensagem.php'; ?>

	<script src="assets/custom/js/jquery-3.2.1.min.js"></script>
	<script src="assets/custom/js/bootstrap-4.0.0.js"></script>

	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.foundation.min.js"></script>

	<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.16/sorting/date-eu.js"></script>

	<script type="text/javascript">

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
				"order": [[ 2, "asc" ]],
				columnDefs: [
				{ type: 'date-eu', targets: 2 }
				]
			});
		});

		$("#modalMsg").on("hidden.bs.modal", function () {
			window.location = "agendamento_entregas";
		});

		<?php

		foreach($classAgendamento->ListaCnpjID($id_cnpj,$usuario_inscricao) as $dadosCNPJ){

			$cont = 0;

			foreach($class->ListaFaturas($dias,$stFat,$dadosCNPJ->getCdRemetente()) as $dados){

				$cont++;

				$VlFrete = 0;

				foreach($classFatura->ListaDetalheFatura($dados->getInProprioTerceiros() ,$dados->getNrFatura(), $dados->getCdFilial(), $dados->getCdParcela(), $dadosCNPJ->getCdRemetente()) as $dadosFatura) {
					$VlFrete += $dadosFatura->getVlFrete();
				}

				if($VlFrete != 0){

					?>

					var formDetalheFatura<?php echo $cont; ?> = document.getElementById("FormDetalheFatura<?php echo $cont; ?>");

					document.getElementById("EnviaDetalheFatura<?php echo $cont; ?>").addEventListener("click", function () {
						formDetalheFatura<?php echo $cont; ?>.submit();
					});

					<?php

				}

			}

		}

		?>

	</script>

</body>
</html>