<?php

if(isset($_POST) && !empty($_POST)){

	$cnpj = $_POST['Cnpj'];
	$nf = $_POST['NotaFiscal'];

	header('Location: http://consultanf.rasador.com.br:8080/softranweb/ConsultaLocalizacaoNotaFiscal.html?cnpj='.$cnpj.'&notaFiscal='.$nf.'');

}