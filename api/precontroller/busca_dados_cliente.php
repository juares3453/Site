<?php

header('Content-Type: text/html; charset=utf-8');

include '../connection_open.php';
include '../dao/DAO_agendamento.php';
include '../modal/modal_agendamento.php';
include '../controller/controller_agendamento.php';

$dados = array();

if (isset($_POST) && !empty($_POST)){

	$class = new AgendamentoController($conn);

	//Pega o numero de caracteres para ver se é cpf
	$cpfModif = str_replace(str_split('./-'), '', $_POST['cnpj']);
	$cpf = strlen($cpfModif);

	if($cpf == 11){
		$cnpj = '000'.$cpfModif;
	} else {
		$cnpj = $_POST['cnpj'];
		$cnpj = str_replace(str_split('./-'), '', $cnpj);
	}

	//Consulta no banco
	foreach($class->BuscaDadosCliente($cnpj) as $dados){

		$info['nome'] = $dados->getDsEntidade();
		$info['cep'] = $dados->getNrCEP();
		$info['telefone'] = $dados->getNrTelefone();
		$info['bairro'] = $dados->getDsBairro();
		$info['numero'] = $dados->getDsNumero();
		$info['endereco'] = $dados->getDsEndereco();
		$info['complemento'] = $dados->getDsComplemento();
		$info['cidade'] = $dados->getDsLocal();
		$info['uf'] = $dados->getDsUF();

		echo json_encode($info);

	}
}

