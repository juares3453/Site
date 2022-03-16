<?php

require '../controller/controller_valida_session.php';

require '../vendor/autoload.php';

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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

//Auto sizing
foreach(range('A','L') as $x) {
	$spreadsheet->getActiveSheet()->getColumnDimension($x)->setAutoSize(true);
}

$sheet = $spreadsheet->getActiveSheet();

$spreadsheet->getActiveSheet()->getSheetView()->setZoomScale(85);
$spreadsheet->getActiveSheet()->setTitle('Agendamentos Disponíveis');

$sheet->setCellValue('A1','Remetente');
$sheet->setCellValue('B1','Destinatário');
$sheet->setCellValue('C1','Série');
$sheet->setCellValue('D1','Nota Fiscal');
$sheet->setCellValue('E1','Data Emissão');
$sheet->setCellValue('F1','Valor');
$sheet->setCellValue('G1','Peso');
$sheet->setCellValue('H1','Qt. Volume');
$sheet->setCellValue('I1','Nr. Pedido');
$sheet->setCellValue('J1','Ordem de Compra');
$sheet->setCellValue('K1','Tolerância até');
$sheet->setCellValue('L1','Armazenamento');

$i=1;

foreach($class->ListaCnpjID($id_cnpj,$usuario_inscricao) as $dadosCNPJ) {

	foreach($class->ListaNotasAgendamento($dadosCNPJ->getCdRemetente()) as $dados){

		$i++;

		$sheet->setCellValue('A'.$i, $dados->getDsRemetente().' ');
		$sheet->setCellValue('B'.$i, $dados->getDsDestinatario().' ');
		$sheet->setCellValue('C'.$i, $dados->getNrSerie());
		$sheet->setCellValue('D'.$i, $dados->getNrNotaFiscal());
		$sheet->setCellValue('E'.$i, $dados->getDtEmissao());
		$sheet->setCellValue('F'.$i, $dados->getVlNotaFiscal());
		$sheet->setCellValue('G'.$i, $dados->getQtPeso());
		$sheet->setCellValue('H'.$i, $dados->getQtVolume());
		$sheet->setCellValue('I'.$i, $dados->getNrPedido());
		$sheet->setCellValue('J'.$i, $dados->getDsMarca());
		$sheet->setCellValue('K'.$i, date('d/m/Y', strtotime($dados->getDtTolerancia())));
		$sheet->setCellValue('L'.$i, $dados->getArmazenamento());

	}

}

$writer = new Xlsx($spreadsheet);
// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');

// It will be called file.xls
header('Content-Disposition: attachment; filename="Agendamentos.xlsx"');

// Write file to the browser
$writer->save('php://output');