<?php

if(isset($_GET['NrFatura']) && isset($_GET['CdEmpresa'])) {

	include '../connection_open.php';
	include '../controller/controller_consulta_financeiro.php';

	$NrFatura = $_GET['NrFatura'];
	$CdEmpresa = $_GET['CdEmpresa'];

	$class = new ConsultaFinanceiroController($conn);

	$diretorio = $class->DiretorioBoleto($NrFatura,$CdEmpresa);

	if(isset($diretorio) && file_exists($diretorio)){

		switch(strtolower(substr(strrchr(basename($diretorio),"."),1))){

			case "pdf": $tipo="application/pdf"; break;
			case "exe": $tipo="application/octet-stream"; break;
			case "zip": $tipo="application/zip"; break;
			case "doc": $tipo="application/msword"; break;
			case "xls": $tipo="application/vnd.ms-excel"; break;
			case "ppt": $tipo="application/vnd.ms-powerpoint"; break;
			case "gif": $tipo="image/gif"; break;
			case "png": $tipo="image/png"; break;
			case "jpg": $tipo="image/jpg"; break;
			case "mp3": $tipo="audio/mpeg"; break;
			case "php":
			case "htm":
			case "html":
		}

		header("Content-Type: ".$tipo);

		header("Content-Length: ".filesize($diretorio));

		header("Content-Disposition: attachment; filename=".basename($diretorio));

		readfile($diretorio);

		exit;
	}

}