<?php

require '../controller/controller_valida_session.php';

include '../connection_open.php';

include '../controller/controller_valida_login.php';

include '../modal/modal_arquivo.php';
include '../controller/controller_arquivo.php';
include '../dao/DAO_arquivo.php';

include '../dao/DAO_agendamento.php';
include '../modal/modal_agendamento.php';
include '../controller/controller_agendamento.php';

$usuario_login = session::get_var('usuario');
$usuario_inscricao = session::get_var('cnpj');
$id_cnpj = session::get_var('id_cnpj');

$classArquivo = new ArquivoController($conn);

$classValida = new ValidaController($conn);

$classAgendamento = new AgendamentoController($conn);

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

$count = 0;

if(isset($_POST['radio'])) {
	$radio = $_POST['radio'];
} else {
	$radio = '1';
}

if(isset($_POST['formCheck'])) {
	$formCheck = $_POST['formCheck'];
} else {
	$formCheck = '0';
}

if(isset($_POST['NrFatura'])){
	$NrFatura = $_POST['NrFatura'];
} else {
	$NrFatura = '0';
}

if(isset($_POST['NrCTe'])){
	$NrCTe = $_POST['NrCTe'];
} else {
	$NrCTe = '0';
}

if(isset($_POST['DtCTeIni'])){
	$DtCTeIni = $_POST['DtCTeIni'];
} else {
	$DtCTeIni = date('Y-m-d', strtotime('-365 days'));
}

if(isset($_POST['DtCTeFim'])){
	$DtCTeFim = $_POST['DtCTeFim'];
} else {
	$DtCTeFim = date('Y-m-d');
}

if(isset($_POST['NrNotaFiscal'])){
	$NrNotaFiscal = $_POST['NrNotaFiscal'];
} else {
	$NrNotaFiscal = '0';
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
	<link href="assets/custom/css/arquivo_xml_pdf.css" rel="stylesheet" type="text/css">
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
				<h6><b><br></b></h6>
				<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12" id="form">
					<form method="POST" action="arquivo_xml_pdf" id="formulario">
						<div id="borda">
							<input type="hidden" name="formCheck" value="x">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="radio" id="radioNrFatura1" value="1" <?= $radio == '1' ? 'checked' : ''; ?>>
								<label class="form-check-label" for="radioNrFatura1">Nr. Fatura                <input type="number" name="NrFatura" id="NrFatura" value="<?= $NrFatura != '0' ? $NrFatura : ''; ?>" disabled></label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="radio" id="radioNrCTe1" value="2" <?= $radio == '2' ? 'checked' : ''; ?>>
								<label class="form-check-label" for="radioNrCTe1">Nr. Conhecimento <input type="number" name="NrCTe" id="NrCTe" value="<?= $NrCTe != '0' ? $NrCTe : ''; ?>" disabled></label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="radio" id="radioDtCTe1" value="3" <?= $radio == '3' ? 'checked' : ''; ?>>
								<label class="form-check-label" for="radioDtCTe1">Dt. Conhecimento <input type="date" name="DtCTeIni" id="DtCTeIni" value="<?php echo date('Y-m-d', strtotime('-10 days')); ?>" disabled> até <input type="date" name="DtCTeFim" id="DtCTeFim" value="<?php echo date('Y-m-d'); ?>" disabled></label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="radio" id="radioNrNotaFiscal1" value="4" <?= $radio == '4' ? 'checked' : ''; ?>>
								<label class="form-check-label" for="radioNrNotaFiscal1">Nr. Nota Fiscal        <input type="number" name="NrNotaFiscal" id="NrNotaFiscal" value="" disabled></label>
								<label>      <input type="submit" value="Pesquisar"></label>
							</div>
						</div>
					</form>
				</div>

				<?php

				foreach($classAgendamento->ListaCnpjID($id_cnpj,$usuario_inscricao) as $dadosCNPJ){
					foreach($classArquivo->ListaArquivos($DtCTeIni,$DtCTeFim,$NrFatura,$NrCTe,$NrNotaFiscal,$dadosCNPJ->getCdRemetente()) as $dados) {
						$retorno = 1;
					}
				}

				if(isset($retorno)) {

					if($formCheck == 'x') {

						?>

						<form action="precontroller_xml_pdf" method="POST">
							<div class="container-fluid">
								<div class="row" id="tabela">
									<table id="DataTable">
										<thead>
											<tr>
												<th>Remetente</th>
												<th>Destinatário</th>
												<th>Conhecimento</th>
												<th>DtEmissao</th>
												<th class="thper"><input type="checkbox" id="checkTodosXml"></th>
												<th class="thpes">  XML</th>
												<th class="thper"><input type="checkbox" id="checkTodosPdf"></th>
												<th class="thpes">  PDF</th>
											</tr>
										</thead>
										<tbody>
											<?php

											$i = 0;

											foreach($classAgendamento->ListaCnpjID($id_cnpj,$usuario_inscricao) as $dadosCNPJ){

												foreach($classArquivo->ListaArquivos($DtCTeIni,$DtCTeFim,$NrFatura,$NrCTe,$NrNotaFiscal,$dadosCNPJ->getCdRemetente()) as $dados) {

													$i++;

													?>

													<tr>
														<td><?php echo $dados->getRemetente(); ?></td>
														<td><?php echo $dados->getDestinatario(); ?></td>
														<td><?php echo $dados->getConhecimento(); ?></td>
														<td><?php echo $dados->getDtEmissao(); ?></td>
														<input type="hidden" name="registros[<?php echo $i; ?>][NomeArquivo]" value="<?php echo $dados->getConhecimento(); ?>">
														<td colspan="2"><input type="checkbox" name="registros[<?php echo $i; ?>][xml]" id="checkXml<?php echo $i;?>" value="<?php echo $dados->getXML(); ?>"></td>
														<td colspan="2"><input type="checkbox" name="registros[<?php echo $i; ?>][pdf]" id="checkPdf<?php echo $i;?>" value="<?php echo $dados->getPDF(); ?>"></td>
													</tr>

													<?php

												}

											}

											$count = $i;

											?>

										</tbody>
									</table>
								</div>
							</div>
							<br>
							<input type="submit" class="btEnvia" id="btEnvia" value="Download Arquivo">
						</form>

						<?php
					}

					?>

				</div>


				<?php

			} else {

				echo '<br>';
				echo "Nenhum resultado para consulta realizada...";

			}

			?>

		</div>
	</div>

	<?php include 'modal_mensagem.php'; ?>

	<script src="assets/custom/js/jquery-3.2.1.min.js"></script>
	<script src="assets/custom/js/bootstrap-4.0.0.js"></script>

	<script type="text/javascript">

		<?php

		if($radio == '1'){

			?>
			$("#NrFatura").prop("disabled", false);
			$("#NrFatura").prop("required", true);
			<?php

		} else if ($radio == '2'){

			?>
			$("#NrCTe").prop("disabled", false);
			$("#NrCTe").prop("required", true);
			<?php

		} else if ($radio == '3'){

			?>
			$("#DtCTeIni").prop("disabled", false);
			$("#DtCTeFim").prop("disabled", false);
			$("#DtCTeIni").prop("required", true);
			$("#DtCTeFim").prop("required", true);
			<?php

		} else if ($radio == '4'){

			?>
			$("#NrNotaFiscal").prop("disabled", false);
			$("#NrNotaFiscal").prop("required", true);
			<?php

		}

		?>

		$(document).ready(function(){
			$('input[type="radio"]').click(function(){
				if ($('#radioNrFatura1').prop("checked") == true){
					$("#NrFatura").prop("disabled", false);
					$("#NrFatura").prop("required", true);
					$("#NrCTe").prop("disabled", true);
					$("#DtCTeIni").prop("disabled", true);
					$("#DtCTeFim").prop("disabled", true);
					$("#NrNotaFiscal").prop("disabled", true);
				} else if($('#radioNrCTe1').prop("checked") == true){
					$("#NrFatura").prop("disabled", true);
					$("#NrCTe").prop("disabled", false);
					$("#NrCTe").prop("required", true);
					$("#DtCTeIni").prop("disabled", true);
					$("#DtCTeFim").prop("disabled", true);
					$("#NrNotaFiscal").prop("disabled", true);
				} else if($('#radioDtCTe1').prop("checked") == true){
					$("#NrFatura").prop("disabled", true);
					$("#NrCTe").prop("disabled", true);
					$("#DtCTeIni").prop("disabled", false);
					$("#DtCTeFim").prop("disabled", false);
					$("#DtCTeIni").prop("required", true);
					$("#DtCTeFim").prop("required", true);
					$("#NrNotaFiscal").prop("disabled", true);
				} else if($('#radioNrNotaFiscal1').prop("checked") == true){
					$("#NrFatura").prop("disabled", true);
					$("#NrCTe").prop("disabled", true);
					$("#DtCTeIni").prop("disabled", true);
					$("#DtCTeFim").prop("disabled", true);
					$("#NrNotaFiscal").prop("disabled", false);
					$("#NrNotaFiscal").prop("required", true);
				}
			});
		});


		<?php for($x = 1; $x <= $count; $x++){ ?>

		//Check todos box
		var checkTodosXml = $("#checkTodosXml");
		checkTodosXml.click(function () {
			if ( $(this).is(':checked') ){
				$('<?php echo '#checkXml'.$x; ?>').prop("checked", true);
			}else{
				$('<?php echo '#checkXml'.$x; ?>').prop("checked", false);
			}
		});

		var checkTodosPdf = $("#checkTodosPdf");
		checkTodosPdf.click(function () {
			if ( $(this).is(':checked') ){
				$('<?php echo '#checkPdf'.$x; ?>').prop("checked", true);
			}else{
				$('<?php echo '#checkPdf'.$x; ?>').prop("checked", false);
			}
		});

	<?php } ?>

		//capturando evento de click em todos os checkboxs
		$('input[type="checkbox"]').on('click', function(){
			//capturando a quantidade de checkboxs checados
			let quantCheck = $('input[type="checkbox"]:checked').length;
			/*verificando se o número de itens checados é diferente
			de zero para então mostrar o botão*/
			if(quantCheck != 0) {
				$('#btEnvia').css('display', 'block')
			}
			else {
				$('#btEnvia').css('display', 'none')
			}
		});


		$("#modalMsg").on("hidden.bs.modal", function () {
			window.location = "agendamento_entregas";
		});


	</script>

</body>
</html>