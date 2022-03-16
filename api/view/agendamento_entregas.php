<?php

require '../controller/controller_valida_session.php';

include '../connection_open.php';
include '../dao/DAO_agendamento.php';
include '../modal/modal_agendamento.php';
include '../controller/controller_agendamento.php';

include '../controller/controller_valida_login.php';

$usuario_login = session::get_var('usuario');
$usuario_inscricao = session::get_var('cnpj');
$id_cnpj = session::get_var('id_cnpj');

$class = new AgendamentoController($conn);

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
	<link href="assets/custom/css/agendamento_entregas.css" rel="stylesheet" type="text/css">

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

			<div class="col-md-12 col-sm-12 col-lg-10 col-xl-10" id="conteudoNoScript">
				<noscript>
					<br>
					Para completa funcionalidade deste site é necessário habilitar o JavaScript.<br>
					<b>
						Clique aqui para ver as <a href="https://www.enable-javascript.com/pt/" target="blank">
						instruções de como habilitar o JavaScript no seu navegador.</a>
					</b>
				</noscript>
			</div>

			<div class="col-md-12 col-sm-12 col-lg-10 col-xl-10" id="conteudoAgendamento">
				<h6><b>::.Agendamento de Entregas</b></h6>
				<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12" id="form">
					<form method="POST" action="precontroller_valida_agendamento" id="formulario" name="formulario" enctype="multipart/form-data">
						<div id="borda">
							<legend><b>Dados do Destinatário da Entrega</b></legend>

							<input type="hidden" name="usuario_cnpj" value="<?php echo session::get_var('cnpj');?>" required>

							<input type="hidden" name="usuario_login" value="<?php echo session::get_var('usuario');?>" required>

							<label>CPF/CNPJ<br>
								<input type="text" name="cnpj" id="cnpj" required>
							</label>

							<label>Nome<br>
								<input type="text" name="nome" id="nome" maxlength="99" required>
							</label>

							<label>CEP<br>
								<input type="text" name="cep" id="cep" required>
							</label>

							<label>Cidade<br>
								<input type="text" name="cidade" id="cidade" class="readonly" maxlength="29" required>
							</label>

							<label>UF<br>
								<input type="text" name="uf" id="uf" maxlength="2" class="readonly" required>
							</label>

							<label>Bairro<br>
								<input type="text" name="bairro" id="bairro" maxlength="29" required>
							</label>

							<label>Endereço<br>
								<input type="text" name="endereco" id="endereco" maxlength="49" required>
							</label>

							<label>N°<br>
								<input type="number" name="numero" id="numero" required>
							</label>

							<label>Telefone<br>
								<input type="text" pattern=".{13,}" name="telefone" id="telefone" title="Informe um número válido com pelo menos 8 dígitos + DD" required>
							</label>

							<label>Complemento<br>
								<input type="text" name="complemento" id="complemento" maxlength="39">
							</label>

							<label>Data de Entrega<br>
								<input type="date" name="data" id="data" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+60 days')); ?>"  required>
							</label>

							<label>Observação<br>
								<input type="text" name="obs" id="obs">
							</label>

							<label>Arquivos .XML<br>
								<input type="file" name="arquivoXML[]" id="arquivoXml" multiple required="true" accept=".xml">
							</label>

							<label>Arquivos .PDF<br>
								<input type="file" name="arquivoPDF[]" id="arquivoPdf" multiple accept=".pdf">  
							</label>

							<label class="checklabel">
								<input type="checkbox" name="validaXML" id="validaXML" checked="checked" /> Possuí XML ?  
							</label>

							<label class="checklabel">
								<input type="checkbox" name="novoLocal" id="novoLocal"/> Novo local de entrega
							</label>

							<br>

							<div id="novoLocalEntrega">

								<label>CEP<br>
									<input type="text" name="cepNovo" id="cepNovo" disabled>
								</label>

								<label>Cidade<br>
									<input type="text" name="cidadeNovo" id="cidadeNovo" class="readonly" maxlength="29" disabled>
								</label>

								<label>UF<br>
									<input type="text" name="ufNovo" id="ufNovo" maxlength="2" class="readonly" disabled>
								</label>

								<label>Bairro<br>
									<input type="text" name="bairroNovo" id="bairroNovo" maxlength="29" disabled>
								</label>

								<label>Endereço<br>
									<input type="text" name="enderecoNovo" id="enderecoNovo" maxlength="49" disabled>
								</label>

								<label>N°<br>
									<input type="number" name="numeroNovo" id="numeroNovo" disabled>
								</label>

							</div>

						</div>

						<div class="row">
							<div class="col-sm">
								<h5><b>Notas Fiscais para Entrega</b></h5>
							</div>
							<div class="col-sm-1">
								<a href="precontroller_gera_excel_agendamento"><img src="assets/img/icon-excel-48px.png" id="img-excel"></a>
							</div>
						</div>

						<div class="container-fluid">
							<div class="row" id="tabela">
								<table id="DataTable">
									<thead>
										<tr>
											<th> <input type="checkbox" id="checkTodos"> </th>
											<th>Remetente</th>
											<th>Destinatário</th>
											<th>Série</th>
											<th>Nota Fiscal</th>
											<th>Dt. Emissão</th>
											<?php if($CdPerfil != '105'){?>
												<th>Valor</th>
											<?php } ?>
											<th>Peso</th>
											<th>Qt. Volume</th>
											<th>Nr. Pedido</th>
											<th>Ordem de Compra</th>
											<th>Tolerância até</th>
											<th>Armazenamento</th>
											<th>ChaveNFe</th>
										</tr>
									</thead>
									<tbody>
										<?php

										$reg = 0;

										$totalizadorNotas = 0;

										$totalizadorPeso = 0;

										foreach($class->ListaCnpjID($id_cnpj,$usuario_inscricao) as $dadosCNPJ){

											$i = 0;

											$reg++;

											foreach($class->ListaNotasAgendamento($dadosCNPJ->getCdRemetente()) as $dados){ 

												$i++;

												?>

												<tr <?php echo $class->ValidaDataLimite($dados->getDtTolerancia()); ?>>
													<input type="hidden"  name="registros[<?php echo $i.$reg; ?>][CdRemetente]" value="<?php echo $dados->getCdRemetente(); ?>">
													<input type="hidden"  name="registros[<?php echo $i.$reg; ?>][CdDestinatario]" value="<?php echo $dados->getCdDestinatario(); ?>">
													<td class="borderleft"><div class="options"><input type="checkbox" name="registros[<?php echo $i.$reg; ?>][valida]" class="check" value="1" id="<?php echo 'check'.$i.$reg;; ?>"/></div></td>
													<td><input type="text" readonly class="rem" name="registros[<?php echo $i.$reg; ?>][DsRemetente]" value="<?php echo $dados->getDsRemetente(); ?>" /></td>
													<td><input type="text" readonly class="dest" name="registros[<?php echo $i.$reg;; ?>][DsDestinatario]" value="<?php echo $dados->getDsDestinatario(); ?>" /></td>
													<td><input type="text" readonly class="serie" name="registros[<?php echo $i.$reg;; ?>][NrSerie]" value="<?php echo $dados->getNrSerie(); ?>" /></td>
													<td><input type="text" readonly class="nf" name="registros[<?php echo $i.$reg;; ?>][NrNotaFiscal]" value="<?php echo $dados->getNrNotaFiscal(); ?>" /></td>
													<td><input type="text" readonly class="dtemissao" name="registros[<?php echo $i.$reg;; ?>][DtEmissao]" value="<?php echo $dados->getDtEmissao(); ?>" /></td>
													<?php if($CdPerfil != '105'){?>
														<td><input type="text" readonly class="vl" name="registros[<?php echo $i.$reg;; ?>][VlNotaFiscal]" value="<?php echo ''.$dados->getVlNotaFiscal(); ?>" /></td>
													<?php }else { ?>
														<td style="display: none!important;"><input type="hidden" readonly class="vl" name="registros[<?php echo $i.$reg;; ?>][VlNotaFiscal]" value="<?php echo ''.$dados->getVlNotaFiscal(); ?>" /></td>
													<?php } ?>
													<td><input type="text" readonly class="qtpeso" name="registros[<?php echo $i.$reg;; ?>][QtPeso]" value="<?php echo $dados->getQtPeso(); ?>" /></td>
													<td><input type="text" readonly class="qtvolume" name="registros[<?php echo $i.$reg;; ?>][QtVolume]" value="<?php echo $dados->getQtVolume(); ?>" /></td>
													<td><input type="text" readonly class="nrpedido" name="registros[<?php echo $i.$reg;; ?>][NrPedido]" value="<?php echo $dados->getNrPedido(); ?>" /></td>
													<td><?php echo $dados->getDsMarca(); ?></td>
													<td><input type="text" readonly class="dttolerencia" name="registros[<?php echo $i.$reg;; ?>][DtTolerancia]" value="<?php echo date('d/m/Y', strtotime($dados->getDtTolerancia())); ?>" /></td>
													<td><input type="text" readonly class="arm" name="registros[<?php echo $i.$reg;; ?>][Armazenamento]" value="<?php echo $dados->getArmazenamento().' dias'; ?>" /></td>
													<td><input type="text" class="chaveNFe" name="registros[<?php echo $i.$reg;; ?>][chaveNFe]" id="<?php echo 'chave'.$i.$reg;; ?>" value="" pattern="[0-9]{44}$" title="Insira um número de chave com no minimo 44 digítos. (Somente números)"/></td>
												</tr>

												<?php

												$totalizadorPeso += $dados->getQtPeso();
											}

											$totalizadorNotas += $i;
										}

										?>
									</tbody>
								</table>
								<?php echo 'Total de Notas Fiscais: '.$totalizadorNotas; ?>
								<?php echo '    Peso total das Notas Fiscais: '.$totalizadorPeso.' kg'; ?>

							</div>
						</div>
						<input type="submit" class="btEnvia" id="btEnvia" value="Solicitar Entrega">
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php

	//Modal sucess formulario
	if (isset($_POST['msg']) && $_POST['msg'] == 'sucess') {

		?>

		<div class="modal fade" id="modalSucess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						Agendamento realizado com sucesso !
					</div>
				</div>
			</div>
		</div>

		<?php

		unset($_POST['msg']);
		echo "<meta HTTP-EQUIV='refresh' CONTENT='3;URL=agendamento_entregas'>";

	//Modal error formulario
	} else if (isset($_POST['msg']) && $_POST['msg'] == 'error') {

		?>

		<div class="modal fade" id="modalSucess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<b>Atenção: </b>Verifique se os dados do formulário foram preenchidos corretamente.
					</div>
				</div>
			</div>
		</div>

		<?php

		unset($_POST['msg']);
		echo "<meta HTTP-EQUIV='refresh' CONTENT='3;URL=agendamento_entregas'>";

	//Modal error data formulario
	} else if (isset($_POST['msg']) && $_POST['msg'] == 'error_data') {

		?>

		<div class="modal fade" id="modalSucess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<b>Atenção: </b>Verifique a data preenchida no formulário, data inválida.
					</div>
				</div>
			</div>
		</div>

		<?php

		unset($_POST['msg']);
		echo "<meta HTTP-EQUIV='refresh' CONTENT='3;URL=agendamento_entregas'>";

	} else if (isset($_POST['msg']) && $_POST['msg'] == 'data_nao_util') {

		?>

		<div class="modal fade" id="modalSucess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<b>Atenção: </b><?php echo $_POST['info']; ?>
					</div>
				</div>
			</div>
		</div>

		<?php

		unset($_POST['msg']);
		echo "<meta HTTP-EQUIV='refresh' CONTENT='3;URL=agendamento_entregas'>";

	} else if (isset($_POST['msg']) && $_POST['msg'] == 'erro_xml') {

		?>

		<div class="modal fade" id="modalSucess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<b>Atenção: </b>XML não enviado, favor verificar se selecionado antes de fazer o agendamento !
					</div>
				</div>
			</div>
		</div>

		<?php

		unset($_POST['msg']);
		echo "<meta HTTP-EQUIV='refresh' CONTENT='3;URL=agendamento_entregas'>";
	}

	?>

	<?php include 'modal_mensagem.php'; ?>

	<script src="assets/custom/js/jquery-3.2.1.min.js"></script>
	<script src="assets/custom/js/bootstrap-4.0.0.js"></script>

	<!-- jQuery Validator -->
	<script src="assets/js/jquery-CPF-CNPJ/jquery.cpfcnpj.js"></script>
	<script src="assets/js/jquery-CPF-CNPJ/jquery.mask.js"></script>

	<script src="assets/custom/js/agendamento_entregas.js"></script>

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
				"ordering": false,
				"info":     false,
				"dom": 'none'
			});
		});

		<?php

		if(substr($usuario_inscricao,0,8) != '01438784'){ ?>

			$('#validaXML').attr('checked',false);
			$('#validaXML').attr('disabled',true);

		<?php } else { ?>

			$('#validaXML').attr('disabled',true);

			$('#cnpj').change(function(){

				String.prototype.replaceAll = String.prototype.replaceAll || function(needle, replacement) {
					return this.split(needle).join(replacement);
				};

				var cnpj = formulario.cnpj.value;

				var cnpj = cnpj.replaceAll("-","");
				var cnpj = cnpj.replaceAll("/","");
				var cnpj = cnpj.replaceAll(".","");

				if(cnpj != <?php echo $usuario_inscricao; ?>){

					$('#validaXML').attr('checked',true);
					$('#validaXML').attr('disabled',true);
					$('#arquivoXml').attr('disabled',false);

					<?php

					$reg = 0;

					foreach($class->ListaCnpjID($id_cnpj,$usuario_inscricao) as $dadosCNPJ){

						$a = 0;

						$reg++;

						foreach($class->ListaRegistros($dadosCNPJ->getCdRemetente()) as $dados){

							$a++;

							?>

							$('<?php echo '#chave'.$a.$reg; ?>').attr("readOnly", false);

							<?php

						}
					}

					?>

				} else {

					$('#validaXML').attr('checked',false);
					$('#validaXML').attr('disabled',true);
					$('#arquivoXml').attr('disabled',true);

					<?php

					$reg = 0;

					foreach($class->ListaCnpjID($id_cnpj,$usuario_inscricao) as $dadosCNPJ){

						$a = 0;

						$reg++;

						foreach($class->ListaRegistros($dadosCNPJ->getCdRemetente()) as $dados){

							$x++;

							?>

							$('<?php echo '#chave'.$x.$reg; ?>').attr("readOnly", true);

							<?php

						}
					}

					?>
				}

			});

			<?php

		}

		?>

		<?php

		$reg = 0;

		foreach($class->ListaCnpjID($id_cnpj,$usuario_inscricao) as $dadosCNPJ){

			$i = 0;

			$reg++;

			foreach($class->ListaRegistros($dadosCNPJ->getCdRemetente()) as $dados){

				$i++;

				?>

				$('<?php echo '#chave'.$i.$reg; ?>').keypress(function(e) {
					if(e.which == 13) {
						e.preventDefault();
					}
				});

				var validaXml = $("#validaXML");

				validaXml.click(function(){
					if (!$(this).is(':checked')){
						$('<?php echo '#chave'.$i.$reg; ?>').prop("readOnly", true);
						$('<?php echo '#chave'.$i.$reg; ?>').prop("required", false);
						$('<?php echo '#chave'.$i.$reg; ?>').val("");
					} else if ($(this).is(':checked')){
						$('<?php echo '#chave'.$i.$reg; ?>').prop("readOnly", false);
						$('<?php echo '#chave'.$i.$reg; ?>').prop("required", true);
					}
				});

				validaXml.each(function(){
					if (!$(this).is(':checked')){
						$('<?php echo '#chave'.$i.$reg; ?>').prop("readOnly", true);
						$('<?php echo '#chave'.$i.$reg; ?>').prop("required", false);
						$('<?php echo '#chave'.$i.$reg; ?>').val("");
					} else if ($(this).is(':checked')){
						$('<?php echo '#chave'.$i.$reg; ?>').prop("readOnly", false);
						$('<?php echo '#chave'.$i.$reg; ?>').prop("required", true);
					}
				});

				$('<?php echo '#check'.$i.$reg;?>').each(function(){
					if($('<?php echo '#check'.$i.$reg;?>').is(':checked')){
						if ($("#validaXML").is(':checked')){
							$('<?php echo '#chave'.$i.$reg; ?>').prop("required", true);
						} else {
							$('<?php echo '#chave'.$i.$reg; ?>').prop("required", false);
						}
					} else {
						$('<?php echo '#chave'.$i.$reg; ?>').prop("required", false);
					}
				});

				$('<?php echo '#check'.$i.$reg;?>').click(function(){
					if($('<?php echo '#check'.$i.$reg;?>').is(':checked')){
						if ($("#validaXML").is(':checked')){
							$('<?php echo '#chave'.$i.$reg; ?>').prop("required", true);
						} else {
							$('<?php echo '#chave'.$i.$reg; ?>').prop("required", false);
						}
					} else {
						$('<?php echo '#chave'.$i.$reg; ?>').prop("required", false);
					}
				});

				<?php
			}

		}

		?>

		var validaXML = $("#validaXML");
		validaXML.click(function(){
			if ($(this).is(':checked')){
				$('#arquivoXml').prop("required", true);
				$("#arquivoXml").prop('disabled', false);
			} else {
				$("#arquivoXml").prop('disabled', true);
				$('#arquivoXml').prop("required", false);
			}
		});

		validaXML.each(function(){
			if ($(this).is(':checked')){
				$('#arquivoXml').prop("required", true);
				$("#arquivoXml").prop('disabled', false);
			} else {
				$("#arquivoXml").prop('disabled', true);
				$('#arquivoXml').prop("required", false);
			}
		});

		$("#modalMsg").on("hidden.bs.modal", function () {
			window.location = "agendamento_entregas";
		});

		$(window).on('load', function() {
			$('#conteudoAgendamento').css('display', 'block');
			$('#conteudoNoScript').css('display', 'none');
		})

	</script>
</body>
</html>