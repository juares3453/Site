<?php

require '../vendor/autoload.php';

include '../connection_open.php';
include '../controller/controller.php';
include '../dao/dao.php';
include '../modal/modal.php';

$class = new Controller($conn);

$CdTipo = $_POST['CdTipo'];
$CdEmpresa = $_POST['CdEmpresa'];
$NrFatura = $_POST['NrFatura'];
$CdInscricao = $_POST['CdInscricao'];
$CdParcela = $_POST['CdParcela'];

$VlFrete = 0;

foreach($class->ListaDetalheFatura($CdTipo,$NrFatura,$CdEmpresa,$CdParcela,$CdInscricao) as $dados) {
	$VlFrete += $dados->getVlFrete();
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$styleArrayTitle = [
	'font' => [
		'bold' => true
	]
];

$spreadsheet->getActiveSheet()->getSheetView()->setZoomScale(90);
$spreadsheet->getActiveSheet()->setTitle('Detalhe_Fatura_'.$NrFatura);

$i = 1;

$NrDocumento[0] = 0;

foreach($class->ListaDetalheFatura($CdTipo,$NrFatura,$CdEmpresa,$CdParcela,$CdInscricao) as $dados) {

	$contNrDocumento++;

	$NrDocumento[$contNrDocumento] = $dados->getCdDocumento();

	if($NrDocumento[$contNrDocumento] != $NrDocumento[$contNrDocumento-1]){

		if($i != 1){
			$i += 1;
		}

		$sheet->setCellValue('A'.$i,'Documeto');
		$sheet->setCellValue('B'.$i,'Data de Emissão');
		$sheet->setCellValue('C'.$i,'Remetente');
		$sheet->setCellValue('D'.$i,'Destinatário');
		$sheet->setCellValue('E'.$i,'Peso');
		$sheet->setCellValue('F'.$i,'Valor Mercadoria');
			// $sheet->setCellValue('H'.$i,'Valor Pedágio');
		$sheet->setCellValue('G'.$i,'Seguro');
		$sheet->setCellValue('H'.$i,'Taxa');
		$sheet->setCellValue('I'.$i,'Armazenagem');
		$sheet->setCellValue('J'.$i,'TRT');
		$sheet->setCellValue('K'.$i,'Frete');

		$sheet->getStyle('A'.$i.':K'.$i)->applyFromArray($styleArrayTitle);

		$spreadsheet->getActiveSheet()->getStyle('A'.$i.':K'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('cccccc');

		$i = $i + 1;

		$spreadsheet->getActiveSheet()->getStyle('E'.$i.':K'.$i)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

		$sheet->setCellValue('A'.$i, $dados->getEmpDocumento().'-'.$dados->getCdDocumento());
		$sheet->setCellValue('B'.$i, $dados->getDtDocumento());
		$sheet->setCellValue('C'.$i, $dados->getRemetente().' ');
		$sheet->setCellValue('D'.$i, $dados->getDestinatario().' ');
		$sheet->setCellValue('E'.$i, $dados->getQtPeso());
			// $sheet->setCellValue('F'.$i, $dados->getQtVolume());
		$sheet->setCellValue('F'.$i, $dados->getVlMercadoria());
			// $sheet->setCellValue('H'.$i, $dados->getVlPedagio());
		$sheet->setCellValue('G'.$i, $dados->getVlSeguro());
		$sheet->setCellValue('H'.$i, $dados->getVlTaxa());
		$sheet->setCellValue('I'.$i, $dados->getVlArmazenagem());
		$sheet->setCellValue('J'.$i, $dados->getVlTRT());
		$sheet->setCellValue('K'.$i, $dados->getVlFrete());

		$i = $i + 2;

		$sheet->getStyle('A'.$i.':F'.$i)->applyFromArray($styleArrayTitle);

		$sheet->setCellValue('A'.$i,'Nota Fiscal');
		$sheet->setCellValue('B'.$i,'Data Emissão NF');
		$sheet->setCellValue('C'.$i,'Ordem De Compra');
		$sheet->setCellValue('D'.$i,'Peso NF');
		$sheet->setCellValue('E'.$i,'Volume NF');
		$sheet->setCellValue('F'.$i,'Valor NF');

		foreach($class->ListaNF($NrDocumento[$contNrDocumento],$CdTipo,$NrFatura,$CdEmpresa,$CdParcela,$CdInscricao) as $dadosNF){

			$i++;

			$spreadsheet->getActiveSheet()->getStyle('D'.$i.':F'.$i)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

			$sheet->setCellValue('A'.$i, $dadosNF->getNrNotaFiscal());
			$sheet->setCellValue('B'.$i, $dadosNF->getDtEmissaoNF());
			$sheet->setCellValue('C'.$i, $dadosNF->getDsMarca());
			$sheet->setCellValue('D'.$i, $dadosNF->getQtPesoNF());
			$sheet->setCellValue('E'.$i, $dadosNF->getQtVolNF());
			$sheet->setCellValue('F'.$i, $dadosNF->getVlNF());

		}

		$i++;

	}

}

foreach(range('A','C') as $x) {
	$spreadsheet->getActiveSheet()->getColumnDimension($x)->setAutoSize(true);
}

$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(16);

foreach(range('G','X') as $x) {
	$spreadsheet->getActiveSheet()->getColumnDimension($x)->setAutoSize(true);
}

$spreadsheet->getActiveSheet()->getStyle('A:FA')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffffff');

$spreadsheet->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal('left');

$writer = new Xlsx($spreadsheet);

header('Content-type: application/vnd.ms-excel');

header('Content-Disposition: attachment; filename="Detalhe_Fatura_'.$NrFatura.'.xlsx"');

$writer->save('php://output');

// require '../vendor/autoload.php';

// include '../connection_open.php';
// include '../controller/controller.php';
// include '../dao/dao.php';
// include '../modal/modal.php';

// $class = new Controller($conn);

// $CdTipo = $_POST['CdTipo'];
// $CdEmpresa = $_POST['CdEmpresa'];
// $NrFatura = $_POST['NrFatura'];
// $CdInscricao = $_POST['CdInscricao'];
// $CdParcela = $_POST['CdParcela'];

// $VlFrete = 0;

// foreach($class->ListaDetalheFatura($CdTipo,$NrFatura,$CdEmpresa,$CdParcela,$CdInscricao) as $dados) {
// 	$VlFrete += $dados->getVlFrete();
// }

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Style\Border;
// use PhpOffice\PhpSpreadsheet\Style\Color;

// $spreadsheet = new Spreadsheet();

// $sheet = $spreadsheet->getActiveSheet();

// $styleArrayTitle = [
// 	'font' => [
// 		'bold' => true
// 	]
// ];

// if($VlFrete != 0){

// 	$spreadsheet->getActiveSheet()->getSheetView()->setZoomScale(95);
// 	$spreadsheet->getActiveSheet()->setTitle('Detalhe_Fatura_'.$NrFatura);

// 	$spreadsheet->getActiveSheet()->getStyle('E:M')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
// 	$spreadsheet->getActiveSheet()->getStyle('P:R')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

// 	$sheet->getStyle('A1:S1')->applyFromArray($styleArrayTitle);

// 	$sheet->setCellValue('A1','Documeto');
// 	$sheet->setCellValue('B1','Data de Emissão');
// 	$sheet->setCellValue('C1','Remetente');
// 	$sheet->setCellValue('D1','Destinatário');
// 	$sheet->setCellValue('E1','Peso');
// 	$sheet->setCellValue('F1','Volume');
// 	$sheet->setCellValue('G1','Valor Mercadoria');
// 	$sheet->setCellValue('H1','Valor Pedágio');
// 	$sheet->setCellValue('I1','Valor Seguro');
// 	$sheet->setCellValue('J1','Valor Taxa');
// 	$sheet->setCellValue('K1','Valor Armazenagem');
// 	$sheet->setCellValue('L1','Valor TRT');
// 	$sheet->setCellValue('M1','Valor Frete');
// 	$sheet->setCellValue('N1','Nota Fiscal');
// 	$sheet->setCellValue('O1','Data Emissão NF');
// 	$sheet->setCellValue('P1','Peso NF');
// 	$sheet->setCellValue('Q1','Volume NF');
// 	$sheet->setCellValue('R1','Valor NF');
// 	$sheet->setCellValue('S1','Ordem de Compra');

// 	$i = 1;

// 	foreach($class->ListaDetalheFatura($CdTipo,$NrFatura,$CdEmpresa,$CdParcela,$CdInscricao) as $dados) {

// 		$i++;

// 		$sheet->setCellValue('A'.$i, $dados->getEmpDocumento().'-'.$dados->getCdDocumento());
// 		$sheet->setCellValue('B'.$i, $dados->getDtDocumento());
// 		$sheet->setCellValue('C'.$i, $dados->getRemetente().' ');
// 		$sheet->setCellValue('D'.$i, $dados->getDestinatario().' ');
// 		$sheet->setCellValue('E'.$i, $dados->getQtPeso());
// 		$sheet->setCellValue('F'.$i, $dados->getQtVolume());
// 		$sheet->setCellValue('G'.$i, $dados->getVlMercadoria());
// 		$sheet->setCellValue('H'.$i, $dados->getVlPedagio());
// 		$sheet->setCellValue('I'.$i, $dados->getVlSeguro());
// 		$sheet->setCellValue('J'.$i, $dados->getVlTaxa());
// 		$sheet->setCellValue('K'.$i, $dados->getVlArmazenagem());
// 		$sheet->setCellValue('L'.$i, $dados->getVlTRT());
// 		$sheet->setCellValue('M'.$i, $dados->GETVlFrete());
// 		$sheet->setCellValue('N'.$i, $dados->getNrNotaFiscal());
// 		$sheet->setCellValue('O'.$i, $dados->getDtEmissaoNF());
// 		$sheet->setCellValue('P'.$i, $dados->getQtPesoNF());
// 		$sheet->setCellValue('Q'.$i, $dados->getQtVolNf());
// 		$sheet->setCellValue('R'.$i, $dados->getVlNF());
// 		$sheet->setCellValue('S'.$i, $dados->getDsMarca());

// 	}

// 	foreach(range('A','X') as $x) {
// 		$spreadsheet->getActiveSheet()->getColumnDimension($x)->setAutoSize(true);
// 	}

// 	$writer = new Xlsx($spreadsheet);

// 	header('Content-type: application/vnd.ms-excel');

// 	header('Content-Disposition: attachment; filename="Detalhe_Fatura_'.$NrFatura.'.xlsx"');

// 	$writer->save('php://output');

// }
