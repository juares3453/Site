<?php

$dados = $_POST['registros'];

$zip = new ZipArchive();

if( $zip->open( '../assets/zips/arquivo.zip' , ZipArchive::CREATE )  === true){

	foreach($dados as $key => $value){

		//Zipa XML e PDF
		if(isset($value['xml']) && !empty($value['xml']) && isset($value['pdf']) && !empty($value['pdf'])){

			$xmlModif = str_replace('\\', '/', $value['xml']);
			$xmlModif = str_replace('//10.0.0.8', '', $xmlModif);

			$pdfModif = str_replace('\\', '/', $value['pdf']);
			$pdfModif = str_replace('//10.0.0.8', '', $pdfModif);

			chdir('/');

			$zip->addFile($xmlModif ,$value['NomeArquivo'].'.xml');

			$zip->addFile($pdfModif ,$value['NomeArquivo'].'.pdf');

			chdir('/var/www/html/precontroller');

		}

		//Zipa somente os arquivos XML
		if(isset($value['xml']) && !empty($value['xml']) && !isset($value['pdf']) && empty($value['pdf'])){

			$xmlModif = str_replace('\\', '/', $value['xml']);
			$xmlModif = str_replace('//10.0.0.8', '', $xmlModif);

			chdir('/');

			$zip->addFile($xmlModif ,$value['NomeArquivo'].'.xml');

			chdir('/var/www/html/precontroller');

		}

		//Zipa somente os arquivos PDF
		if(isset($value['pdf']) && !empty($value['pdf']) && !isset($value['xml']) && empty($value['xml'])){

			$pdfModif = str_replace('\\', '/', $value['pdf']);
			$pdfModif = str_replace('//10.0.0.8', '', $pdfModif);

			chdir('/');

			$zip->addFile($pdfModif ,$value['NomeArquivo'].'.pdf');

			chdir('/var/www/html/precontroller');

		}

	}

	$zip->close();

	header('Content-type: application/zip');
	header('Content-disposition: attachment; filename="arquivo.zip"');
	readfile('../assets/zips/arquivo.zip');

	unlink('../assets/zips/arquivo.zip');

}