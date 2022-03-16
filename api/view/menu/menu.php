<?php

include '../controller/controller_login.php';

$classMenu = new LoginController($conn);


//Valida perfil se possui financeiro
foreach($classMenu->PerfilConfig($usuario_inscricao,$usuario_login) as $dados){
	$PermiteFinanceiro = $dados->getInPermiteConsFinanc();
	$CdPerfil = $dados->getCdPerfil();
}

//Valida se ao entrar em uma pagina que não é no inicio.php e se aceitou os termos de uso, se não faz logoff e redireciona para a tela de inicio
foreach($classMenu->ConsultaLogsPortal($usuario_login,$usuario_inscricao) as $dados){
	if($dados->getInAceiteTermo() != 1 && basename($_SERVER["PHP_SELF"]) != 'inicio.php'){
		header('Location: inicio');
	}
}

if(!isset($exigeAlteraSenha)){
	$exigeAlteraSenha = 0;
}

//Se tiver o campo exigir alteração de senha no primeiro login
if($exigeAlteraSenha == 1){

	?>

	<div class="col-md-12 col-sm-12 col-lg-2"><br>
		<ul id="menu">
			<li><a href="consulta_nota_fiscal">  Consulta Nota Fiscal</a></li>
			<li><a href="rastreamento_de_carga">  Rastreamento de Carga</a></li>
			<li><a href="consulta_financeiro">  Consulta Financeiro</a></li>
			<li><a href="" data-toggle="modal" data-target="#modalMsg">  Agendamento de Entregas</a></li>
			<li><a href="consulta_agendamento">  Consulta Agendamentos</a></li>
			<li><a href="arquivo_xml_pdf">  Arquivos XML e PDF CT-e</a></li>
			<li><a href="../../assets/manuais/Manual-Portal.pdf" download>  Manual</a></li>
			<li><a href="controller/controller_logout">  Sair</a></li>
		</ul>
	</div>

	<?php

} else if ($PermiteFinanceiro == 1){

	echo $classMenu->ValidaPaginaPerfil(basename($_SERVER["PHP_SELF"]),$CdPerfil,$PermiteFinanceiro);

	?>

	<div class="col-md-12 col-sm-12 col-lg-2"><br>
		<ul id="menu">
			<li><a href="consulta_nota_fiscal">  Consulta Nota Fiscal</a></li>
			<li><a href="rastreamento_de_carga">  Rastreamento de Carga</a></li>
			<li><a href="consulta_financeiro">  Consulta Financeiro</a></li>
			<li><a href="" data-toggle="modal" data-target="#modalMsg">  Agendamento de Entregas</a></li>
			<li><a href="consulta_agendamento">  Consulta Agendamentos</a></li>
			<li><a href="arquivo_xml_pdf">  Arquivos XML e PDF CT-e</a></li>
			<li><a href="../../assets/manuais/Manual-Portal.pdf" download>  Manual</a></li>
			<li><a href="controller/controller_logout">  Sair</a></li>
		</ul>
	</div>

	<?php

} else if ($CdPerfil == '105'){

	echo $classMenu->ValidaPaginaPerfil(basename($_SERVER["PHP_SELF"]),$CdPerfil,$PermiteFinanceiro);

	?>

	<div class="col-md-12 col-sm-12 col-lg-2"><br>
		<ul id="menu">
			<li><a href="rastreamento_de_carga">  Rastreamento de Carga</a></li>
			<li><a href="" data-toggle="modal" data-target="#modalMsg">  Agendamento de Entregas</a></li>
			<li><a href="consulta_agendamento">  Consulta Agendamentos</a></li>
			<li><a href="../../assets/manuais/Manual-Portal.pdf" download>  Manual</a></li>
			<li><a href="controller/controller_logout">  Sair</a></li>
		</ul>
	</div>

	<?php

} else if ($CdPerfil == '102'){

	echo $classMenu->ValidaPaginaPerfil(basename($_SERVER["PHP_SELF"]),$CdPerfil,$PermiteFinanceiro);

	?>

	<div class="col-md-12 col-sm-12 col-lg-2"><br>
		<ul id="menu">
			<li><a href="consulta_nota_fiscal">  Consulta Nota Fiscal</a></li>
			<li><a href="rastreamento_de_carga">  Rastreamento de Carga</a></li>
			<!-- <li><a href="consulta_financeiro">  Consulta Financeiro</a></li> -->
			<li><a href="" data-toggle="modal" data-target="#modalMsg">  Agendamento de Entregas</a></li>
			<li><a href="consulta_agendamento">  Consulta Agendamentos</a></li>
			<li><a href="arquivo_xml_pdf">  Arquivos XML e PDF CT-e</a></li>
			<li><a href="../../assets/manuais/Manual-Portal.pdf" download>  Manual</a></li>
			<li><a href="controller/controller_logout">  Sair</a></li>
		</ul>
	</div>

	<?php
}


?>