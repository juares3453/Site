<?php

require '../controller/controller_valida_session.php';

include '../assets/mpdf60/mpdf.php';

include '../connection_open_portal.php';
include '../connection_open_email.php';

include '../dao/DAO_login.php';
include '../modal/modal_login.php';
include '../controller/controller_login.php';

include '../dao/DAO_agendamento.php';
include '../modal/modal_agendamento.php';
include '../controller/controller_agendamento.php';

$dataAtual = date('Y-m-d');

//Valida se foi enviado dados do formulario e notas
if (isset($_POST) || !empty($_POST)){

	$class = new AgendamentoController($conn);

	//Gera Numero do lote que sera gerado
	foreach ($class->GeraNumeroLote() as $dados){

		$CdLote = $dados->getCdLote();

		if($CdLote == ''){
			$CdLote = 1;
		}
	}

	//Ajusta CPF e CNPJ
	$cnpjModif = str_replace(str_split('./-'), '', $_POST['cnpj']);
	$cnpj = strlen($cnpjModif);

	if($cnpj == 11){
		$cnpj = $cnpjModif;
	} else {
		$cnpj = $_POST['cnpj'];
		$cnpj = str_replace(str_split('./-'), '', $cnpj);
	}

	//Dados do formulario
	$nome = $_POST['nome'];

	if(isset($_POST['cepNovo'])){
		$cep = $_POST['cepNovo'];
	} else {
		$cep = $_POST['cep'];
	}

	if(isset($_POST['cidadeNovo'])){
		$cidade = $_POST['cidadeNovo'];
	} else {
		$cidade = $_POST['cidade'];
	}

	if(isset($_POST['ufNovo'])){
		$uf = $_POST['ufNovo'];
	} else {
		$uf = $_POST['uf'];
	}

	if(isset($_POST['bairroNovo'])){
		$bairro = $_POST['bairroNovo'];
	} else {
		$bairro = $_POST['bairro'];
	}

	if(isset($_POST['enderecoNovo'])){
		$endereco = $_POST['enderecoNovo'];
	} else {
		$endereco = $_POST['endereco'];
	}

	if(isset($_POST['numeroNovo'])){
		$numero = $_POST['numeroNovo'];
	} else {
		$numero = $_POST['numero'];
	}

	$telefone = $_POST['telefone'];
	$complemento = $_POST['complemento'];
	$data = $_POST['data'];

	$obs = $_POST['obs'];
	$usuario_login = $_POST['usuario_login'];
	$usuario_cnpj = $_POST['usuario_cnpj'];


	//Valida se data é útil

	if(isset($data) && isset($cep)){

		foreach($class->ValidaDataDeEntrega($data,$cep) as $dados){

			if($dados->getCdRetorno() == '0'){

				foreach($class->RetornaDataUtil($data,$cep) as $dados){

					$info = 'Data inválida, próxima data válida para agendamento '.date('d/m/Y', strtotime($dados->getDtUtil()));

					?>

					<form action="agendamento_entregas" method="POST" accept-charset="utf-8" name="agendamento">
						<input type="hidden" name="msg" value="data_nao_util">
						<input type="hidden" name="info" value="<?php echo $info; ?>">
					</form>

					<script language="JavaScript">document.agendamento.submit();</script>

					<?php

					exit();

				}

			}

		}

	} else {

		?>

		<form action="agendamento_entregas" method="POST" accept-charset="utf-8" name="agendamento">
			<input type="hidden" name="msg" value="error_data">
		</form>

		<script language="JavaScript">document.agendamento.submit();</script>

		<?php

		exit();

	}

	//Valida se a data agendada é válida

	$arrayData = explode('-', $data);

	if(count($arrayData) == 3){

		$ano = (int)$arrayData[0];
		$mes = (int)$arrayData[1];
		$dia = (int)$arrayData[2];

		$anoAtual = date('Y');

		if($ano < $anoAtual || $mes > 12 || $dia > 31){

			?>

			<form action="agendamento_entregas" method="POST" accept-charset="utf-8" name="agendamento">
				<input type="hidden" name="msg" value="error_data">
			</form>

			<script language="JavaScript">document.agendamento.submit();</script>

			<?php

			exit();
		}

	} else {

		?>

		<form action="agendamento_entregas" method="POST" accept-charset="utf-8" name="agendamento">
			<input type="hidden" name="msg" value="error_data">
		</form>

		<script language="JavaScript">document.agendamento.submit();</script>

		<?php

		exit();

	}

	//Valida se o XML foi enviado caso for Leroy

	if(substr($usuario_cnpj,0,7) == '01438784'){

		if (!isset($_FILES['arquivoXML']) || empty($_FILES['arquivoXML']['name'])){

			?>

			<form action="agendamento_entregas" method="POST" accept-charset="utf-8" name="agendamento">
				<input type="hidden" name="msg" value="erro_xml">
			</form>

			<script language="JavaScript">document.agendamento.submit();</script>

			<?php
		}

	}

	//Pega os dados das notas fiscais selecionadas no formulario
	$dados = array_filter($_POST['registros'], function ($it) {
		return isset($it['valida']) and $it['valida'] == '1';
	});

	//Contador da sequencia
	$CdSequencia = 0;

	foreach ($dados as $key => $value) {

		$CdSequencia++;

		$DsRemetente = $value['DsRemetente'];
		$CdRemetente = $value['CdRemetente'];
		$CdDestinatario = $value['CdDestinatario'];
		$DsDestinatario = $value['DsDestinatario'];
		$NrSerie = $value['NrSerie'];
		$NrNotaFiscal = $value['NrNotaFiscal'];
		$DtEmissao = $value['DtEmissao'];
		$VlNotaFiscal = str_replace('.', '',$value['VlNotaFiscal']);
		$VlNotaFiscal = str_replace(',', '.',$VlNotaFiscal);
		$QtPeso = str_replace(',', '',$value['QtPeso']);
		$QtVolume = $value['QtVolume'];
		$NrPedido = $value['NrPedido'];
		$DtTolerencia = $value['DtTolerancia'];
		$Armazenamento = $value['Armazenamento'];
		$chaveNFe = $value['chaveNFe'];

		$obj = new AgendamentoModal();

		$obj->setCdLote($CdLote);
		$obj->setCdSequencia($CdSequencia);
		$obj->setCdDestinatarioAgend($cnpj);
		$obj->setDsEntidadeAgend($nome);
		$obj->setNrCepEntregaAgend($cep);
		$obj->setDsCidadeAgend($cidade);
		$obj->setDsUFAgend($uf);
		$obj->setDsBairroAgend($bairro);
		$obj->setDsEnderecoAgend($endereco);
		$obj->setDsNumAgend($numero);
		$obj->setNrTelefoneAgend($telefone);
		$obj->setDsComplementoAgend($complemento,'.','');
		$obj->setDtEntregaProgramada($data);
		$obj->setDsComentarioAgend($obs);
		$obj->setNrSerieNFAgend($NrSerie);
		$obj->setNrNotaFiscalAgend($NrNotaFiscal);
		$obj->setCdRemetente($CdRemetente);
		$obj->setCdDestinatario($CdDestinatario);
		$obj->setVlMercadoria($VlNotaFiscal);
		$obj->setQtPesoCubado($QtPeso);
		$obj->setQtVolumes($QtVolume);
		$obj->setNrPedido($NrPedido);
		$obj->setNrChaveAcessoNFe($chaveNFe);
		$obj->setDtAgendamento(date('Y-m-d H:i:s'));
		$obj->setInProcessado('0');

		//Se tiver consignatario atribui na variavel destinatario, para ser o pagador do frete ao gerar a OE
		foreach($class->ValidaConsignatario($NrNotaFiscal,$NrSerie,$CdRemetente) as $dadosConsignatario){
			$CdConsignatario = $dadosConsignatario->getCdConsignatario();
		}

		if(empty($CdConsignatario) || $CdConsignatario == '' || !isset($CdConsignatario)){
			$obj->setCdInscricao($CdDestinatario);
		} else {
			$obj->setCdInscricao($CdConsignatario);
		}

		//Insere dados do agendamento no banco
		//Se retornar 1, retorna erro no SQL não conclui agendamento
		if($class->InsereDadosAgendamento($obj) != '1'){
			$insert = '';
		} else {
			$insert = '1';
		}

	}
}

//Executa o GeraLoteEDI quando não for leroy
if($insert != '1'){
	if(substr($usuario_cnpj,0,7) != '01438784'){

		include '../connection_open.php';

		$class = new AgendamentoController($conn);

		$class->GeraLoteEDI($CdLote);

		include '../connection_close.php';
	}
}

//Verifica se fez o insert
if(isset($insert) && $insert != '1'){

	//Valida arquivo XML
	if (isset($_FILES['arquivoXML']) || !empty($_FILES['arquivoXML']['name'])){

		$arquivos = $_FILES['arquivoXML'];

		//Conta numero de arquivos
		$total = count($arquivos['name']);

		//Instancia o caminho
		$diretorio = '../assets/XML-PDF/XML/'.$dataAtual;

		//Percorre informação dos arquivos
		for ($i = 0; $i < $total; $i++){

			//Ajusta CPF e CNPJ
			$cnpjModif = str_replace(str_split('./-'), '', $_POST['cnpj']);

			//Pega os dados das notas fiscais selecionadas
			$dados = array_filter($_POST['registros'], function ($it) {
				return isset($it['valida']) and $it['valida'] == '1';
			});

			foreach ($dados as $key => $value) {
				$NrNotaFiscal = $value['NrNotaFiscal'];
			}

			//Seta nome dos arquivos
			$nome_arquivo = substr($_POST['nome'],0,10).'_'.$NrNotaFiscal.'_'.$cnpjModif.'_'.$i.'.xml';

			//valida se tem o nome do arquivo
			if($arquivos['name'][$i] != ''){
				if($arquivos['type'][$i] == 'text/xml'){

					//Cria diretorio caso não tenha
					if (!file_exists($diretorio)){
						mkdir("$diretorio", 0700);
					}

					//Move o arquivo
					move_uploaded_file($arquivos['tmp_name'][$i], $diretorio . '/' . $nome_arquivo);

					//Envia email
					$mail->From = "portal@rasador.com.br";
					$mail->FromName = "Rasador NFe"; // Seu nome

					$mail->AddAddress('nfe@rasador.com.br');

					$mail->IsHTML(true);

					$mail->Subject = "Xml - ".date('d/m/Y H:i:s');
					$mail->Body = "Este é um e-mail automatico de envio de XML do Portal Rasador";

					$mail->AddAttachment("../assets/XML-PDF/XML/".$dataAtual."/".$nome_arquivo."", "$nome_arquivo");

					//Envia xml para o (nfe@rasador.com.br)
					$mail->Send();

					$mail->ClearAllRecipients();
					$mail->ClearAttachments();
				}
			}
		}
	}

	//Valida arquivo PDF
	if (isset($_FILES['arquivoPDF']) || !empty($_FILES['arquivoPDF']['name'])){

		$arquivos = $_FILES['arquivoPDF'];

		//Conta numero de arquivos
		$total = count($arquivos['name']);

		//Instancia o caminho
		$diretorio = '../assets/XML-PDF/PDF/'.$dataAtual;

		//Percorre informação dos arquivos
		for ($i = 0; $i < $total; $i++){

			//Ajusta CPF e CNPJ
			$cnpjModif = str_replace(str_split('./-'), '', $_POST['cnpj']);

			//Pega os dados das notas fiscais selecionadas
			$dados = array_filter($_POST['registros'], function ($it) {
				return isset($it['valida']) and $it['valida'] == '1';
			});

			foreach ($dados as $key => $value) {
				$NrNotaFiscal = $value['NrNotaFiscal'];
			}

			//Seta nome dos arquivos
			$nome_arquivo = substr($_POST['nome'],0,10).'_'.$NrNotaFiscal.'_'.$cnpjModif.'_'.$i.'.pdf';

			//valida se tem o nome do arquivo
			if($arquivos['name'][$i] != ''){
				if($arquivos['type'][$i] == 'application/pdf'){

					//Cria diretorio caso não tenha
					if (!file_exists($diretorio)){
						mkdir("$diretorio", 0700);
					}

					//Move o arquivo
					move_uploaded_file($arquivos['tmp_name'][$i], $diretorio . '/' . $nome_arquivo);
				}
			}
		}
	}

	include '../connection_close.php';

	//Gera o conteudo do arquivo PDF do agendamento
	$html[] = "

	<body>
	<h5>CHECK LIST ENTREGA PORTA A PORTA</h5>

	<div class='cabecalho'>
	<table>
	<tbody>
	<tr>
	<td colspan='2'>Nome: ".$nome."</td>
	<td>CPF/CNPJ: ".$cnpj."</td>
	</tr>
	<tr>
	<td>Endereço: ".$endereco."</td>
	<td>Bairro: ".$bairro."</td>
	<td>Nº: ".$numero."</td>
	</tr>
	<tr>
	<td>Cidade: ".$cidade."</td>
	<td>Cep: ".$cep."</td>
	<td>Estado: ".$uf."</td>
	</tr>
	<tr>
	<td colspan='2'>Complemento: ".$complemento."</td>
	<td>Telefone: ".$telefone."</td>
	</tr>
	<tr>
	<td>Data de Entrega: ".date('d/m/Y', strtotime($data))."</td>
	</tr>
	<tr>
	<td colspan='3'>Observações: ".$obs."</td>
	</tr>
	</tbody>
	</table>
	</div>
	<table>
	<thead>
	<tr>
	<th>Nota</th>
	<th>Remetente</th>
	<th>Destinatário</th>
	<th>Volumes</th>
	</tr>
	</thead>
	<tbody>";
	foreach ($dados as $key => $value) {
		$CdSequencia++;
		$totalQtVolume += $value['QtVolume'];
		$html[] = "
		<tr>
		<td>".$value['NrNotaFiscal']."</td>
		<td>".$value['DsRemetente']."</td>
		<td>".$value['DsDestinatario']."</td>
		<td>".$value['QtVolume']."</td>
		</tr>";
	}
	$html[] = "
	<tr>
	<td>Total: </td>
	<td></td>
	<td></td>
	<td>".$totalQtVolume."</td>
	</tr>
	</tbody>
	</table>

	<div class='conteudo'>
	<p><b>Prezado destinatário:</b></p>
	<p>         Primeiramente parabenizamos-lhe pela aquisição dos produtos que ora estamos lhe entregando.</p>
	<p>         Informamos que a conferência do estado físico da mercadoria e quantidade dos volumes recebidos é um direito vosso, exerça este direito no ato do recebimento da mercadoria.</p>
	<p>         Nossos colaboradores estão orientados a lhe auxiliarem nesta conferência, a qual se dá de forma simples, ou seja, cada volume embalado e etiquetado representa um item recebido, cuja soma deve igualar ao constante registrado no documento de entrega.</p>
	<p>         A realização do serviço de entrega depende do preenchimento obrigatório dos dados abaixo, o que pedimos a gentileza de responder nos respectivos campos, é fácil e tomará pouco tempo vosso, porém necessário.</p>
	<p>         Dúvidas quanto ao pedido da mercadoria, montagem, etc... favor contatar diretamente a loja que adquiriste o produto, pois nosso serviço restringe- se a entrega de mercadoria, o que agradecemos a compreensão.</p>
	<br>
	<p><b>IMPORTANTE:</b> nossos colaboradores/entregadores estão treinados e orientados para efetuar a entrega dos produtos conforme endereço registrado neste CONHECIMENTO DE TRANSPORTE, não estando autorizados para içar a mercadoria, deslocar, mexer, empurrar, erguer, baixar, desinstalar, desmontar e/ou montar qualquer bem e/ou obstáculo dentro e/ou fora da residência para possibilitar a entrega, devendo tal local estar livre para recebimento da mercadoria.</p>
	<br>
	<p>Data de Entrega: ".date('d/m/Y', strtotime($data))."                    N° CTE:</p>
	<p>Cliente: ".$nome."                                       N° Total Volume Entregue:</p>
	<br>
	<p>Solicitamos que no ato do recebimento das mercadorias do fornecedor ".$DsRemetente." da loja ".$DsDestinatario." foram conferidos os seguintes itens:</p>
	<p>1 - A quantidade de volumes recebidos pelo senhor(a) é de: _______________________________________________________</p>
	<p>2 - As embalagens estão em perfeitas condições e estado? (  ) Sim (  ) Não</p>
	<p>Em caso negativo, quais os problemas verificados? _________________________________________________________________</p>
	<p>3 - Foi constatada alguma avaria nas mercadorias? (  ) Sim (  ) Não</p>
	<p>Em caso positivo, quais os problemas e em que peças?___________________________________________________________</p>
	<p>4 - Vistoriou e recebeu vidros e portas em perfeitas condições? (  ) Sim (  ) Não</p>
	<p>Em caso negativo, quais os problemas verificados? ______________________________________________________________</p>
	<p>5 - Recebeu os acessórios e/ou puxadores e/ou ferragens?(  ) Sim (  ) Não</p>
	<p>6 - Favor avalie a qualidade do serviço e o atendimento/apresentação da nossa equipe de entrega:( )Ótimo  ( )Bom ( )Regular  ( )Ruim</p>
	<p>7 - O local da entrega está em obras? (  ) Sim  (  ) Não</p>
	<p>8 - Os produtos foram entregues devidamente e no local solicitado? (  ) Sim  (  ) Não</p>
	<p>Caso não, qual o local que os moveis foram colocados e porque? ___________________________________________________</p>
	<p>9 - Constatou alguma alteração do local ou fato relevante realizada pelo(s) nosso(s) colaborador(es) em razão da execução da entrega? (  )Sim  (  )Não, Se SIM qual ?_________________________________________________________________________</p>
	<p>10-Fique à vontade para críticas e ou sugestões relacionadas ao serviço realizado: _______________________________________</p>
	<p>Data:  ____ / _____ / _____   Nome e assinatura do recebedor: ________________________________________________________</p>
	</div>

	</body>

	";

	//Chama classe do MPDF do php
	$mpdf=new mPDF();
	$mpdf->SetDisplayMode('fullpage');
	$css = file_get_contents("../assets/custom/css/checklist.css");
	$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($html = implode("",$html));

	//Salva arquivo gerado (checklist)
	$mpdf->Output("../assets/agendamentos/AGENDAMENTO - ".$cnpj.".pdf");

	//Remetente do E-mail
	$mail->From = "portal@rasador.com.br";
	$mail->FromName = "Portal Rasador Agendamento";

	include '../connection_open.php';

	$classLogin = new LoginController($conn);

	foreach($classLogin->ConsultaDadosLoginPortal($usuario_login,$usuario_cnpj) as $dados){
		//E-mail da filial responsavel pelos PP
		$mail->AddAddress($dados->getEmailCL());

		//Cópias ocultas
		//$mail->addBCC('ti@rasador.com.br');
		//$mail->addBCC('ti2@rasador.com.br');
	}

	$mail->IsHTML(true);
	//Titulo do e-mail
	$mail->Subject = "Agendamento de Entrega - ".$DsRemetente;

	//Mensagme do body do email
	$mensagem[] = "

	Este é um e-mail automático gerado pelo agendamento das notas fiscais abaixo: <br>

	";

	//Pega os dados das notas fiscais selecionadas
	$dados = array_filter($_POST['registros'], function ($it) {
		return isset($it['valida']) and $it['valida'] == '1';
	});

	foreach ($dados as $key => $value) {
		$mensagem[] = " <br>NFe - <b>".$value['NrNotaFiscal']."</b><br>";
	}

	$mail->Body = implode("",$mensagem);

	//Anexa o PDF do checklist do agendamento
	$mail->AddAttachment("../assets/agendamentos/AGENDAMENTO - ".$cnpj.".pdf");

	//Anexa XML do agendamento no email
	if (isset($_FILES['arquivoXML']) && !empty($_FILES['arquivoXML']['name'])){

		$arquivos = $_FILES['arquivoXML'];

		//Conta numero de arquivos
		$total = count($arquivos['name']);

		//Instancia o caminho
		$diretorio = '../assets/XML-PDF/XML/'.$dataAtual;

		//Percorre informação dos arquivos
		for ($i = 0; $i < $total; $i++){

			//Ajusta CPF e CNPJ
			$cnpjModif = str_replace(str_split('./-'), '', $_POST['cnpj']);

			//Pega os dados das notas fiscais selecionadas
			$dados = array_filter($_POST['registros'], function ($it) {
				return isset($it['valida']) and $it['valida'] == '1';
			});

			foreach ($dados as $key => $value) {
				$NrNotaFiscal = $value['NrNotaFiscal'];
			}

			//Seta nome dos arquivos
			$nome_arquivo = substr($_POST['nome'],0,10).'_'.$NrNotaFiscal.'_'.$cnpjModif.'_'.$i.'.xml';

			//valida se tem o nome do arquivo
			if($arquivos['name'][$i] != ''){
				if($arquivos['type'][$i] == 'text/xml'){
					//Caminho do arquivo para anexo do XML
					$mail->AddAttachment('../assets/XML-PDF/XML/'.$dataAtual.'/'.$nome_arquivo);
				}
			}
		}
	}

	//Anexa PDF do agendamento no email
	if (isset($_FILES['arquivoPDF']) && !empty($_FILES['arquivoPDF']['name'])){

		$arquivos = $_FILES['arquivoPDF'];

		//Conta numero de arquivos
		$total = count($arquivos['name']);

		//Instancia o caminho
		$diretorio = '../assets/XML-PDF/PDF/'.$dataAtual;

		//Percorre informação dos arquivos
		for ($i = 0; $i < $total; $i++){

			//Ajusta CPF e CNPJ
			$cnpjModif = str_replace(str_split('./-'), '', $_POST['cnpj']);

			//Pega os dados das notas fiscais selecionadas
			$dados = array_filter($_POST['registros'], function ($it) {
				return isset($it['valida']) and $it['valida'] == '1';
			});

			foreach ($dados as $key => $value) {
				$NrNotaFiscal = $value['NrNotaFiscal'];
			}

			//Seta nome dos arquivos
			$nome_arquivo = substr($_POST['nome'],0,10).'_'.$NrNotaFiscal.'_'.$cnpjModif.'_'.$i.'.pdf';

			//valida se tem o nome do arquivo
			if($arquivos['name'][$i] != ''){
				if($arquivos['type'][$i] == 'application/pdf'){
					//Caminho do arquivo para anexo do PDF
					$mail->AddAttachment('../assets/XML-PDF/PDF/'.$dataAtual.'/'.$nome_arquivo);
				}
			}
		}
	}

	$enviaCheckList = $mail->Send();
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

	include '../connection_close.php';

	//Valida se foi enviado email
	if(isset($enviaCheckList) && !empty($enviaCheckList)) {

		//Apaga arquivo enviado por e-mail (checklist)
		unlink("../assets/agendamentos/AGENDAMENTO - ".$cnpj.".pdf");

	}

} else {

	//Envia email com o log do erro
	$mail->From = "portal@rasador.com.br";
	$mail->FromName = "Rasador Agendamento";

	//$mail->AddAddress('ti@rasador.com.br');
	//$mail->AddAddress('ti2@rasador.com.br');

	$mail->IsHTML(true);

	$mail->Subject = "Erro de agendamento - ".$usuario_cnpj." - ".date('d/m/Y H:i:s');
	$mail->Body = "Problema no insert - XEDINFSIT";

	//Envia xml para os logs
	$mail->Send();

	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

	header('Location: agendamento_entregas');

}

//Valida se inserido no DB o agendamento
if(isset($insert) && $insert != '1'){

	?>

	<form action="agendamento_entregas" method="POST" accept-charset="utf-8" name="agendamento">
		<input type="hidden" name="msg" value="sucess">
	</form>

	<script language="JavaScript">document.agendamento.submit();</script>

	<?php

	exit();

} else {

	?>

	<form action="agendamento_entregas" method="POST" accept-charset="utf-8" name="agendamento">
		<input type="hidden" name="msg" value="error">
	</form>

	<script language="JavaScript">document.agendamento.submit();</script>

	<?php

	exit();

}

?>

