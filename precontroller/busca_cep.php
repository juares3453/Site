<?php

header('Content-Type: text/html; charset=utf-8');

include '../connection_open.php';
include '../dao/DAO_agendamento.php';
include '../modal/modal_agendamento.php';
include '../controller/controller_agendamento.php';

$dados = array();

if (isset($_POST) && !empty($_POST)){

	$class = new AgendamentoController($conn);

	if(!empty($_POST['cepNovo'])){

		$cep = $_POST['cepNovo'];

		foreach($class->BuscaCep($cep) as $dados){

			$info['cidade'] = $dados->getDsLocal();
			$info['uf'] = $dados->getDsUF();

			echo json_encode($info);

		}

	} else {

		$cep = $_POST['cep'];

		foreach($class->BuscaCep($cep) as $dados){

			$info['cidade'] = $dados->getDsLocal();
			$info['uf'] = $dados->getDsUF();

			echo json_encode($info);

		}

	}

}