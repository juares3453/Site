<?php

header('Content-Type: text/html; charset=utf-8');

include '../connection_open.php';
include '../dao/DAO_agendamento.php';
include '../modal/modal_agendamento.php';
include '../controller/controller_agendamento.php';

if (isset($_POST) && !empty($_POST)){

	$class = new AgendamentoController($conn);

	$cep = $_POST['cep'];
	$dataForm = $_POST['data'];

	if (empty($cep)) {

		$x = 'Favor preencher o CEP antes de informar uma data de agendamento';
		echo json_encode($x);

	} else {

		foreach($class->ValidaDataDeEntrega($dataForm,$cep) as $dados){

			if($dados->getCdRetorno() == '0'){

				foreach($class->RetornaDataUtil($dataForm,$cep) as $dados){

					if(empty($dados->getDtUtil()) || $dados->getDtUtil() == 'null'){
						$info = 'Data inválida.';
						echo json_encode($info);
					} else {
						$info = 'Data inválida, próxima data válida '.date('d/m/Y', strtotime($dados->getDtUtil()));
						echo json_encode($info);
					}

				}

			}

		}

	}

}