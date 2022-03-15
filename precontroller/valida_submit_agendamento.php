<?php

header('Content-Type: text/html; charset=utf-8');

require '../controller/controller_valida_session.php';

include '../connection_open.php';
include '../dao/DAO_agendamento.php';
include '../modal/modal_agendamento.php';
include '../controller/controller_agendamento.php';

$usuario_inscricao = session::get_var('cnpj');

if (isset($_POST) && !empty($_POST)){
	$class = new AgendamentoController($conn);

	foreach($class->ValidaInadimplente($usuario_inscricao) as $dados){ //valida inadimplentes

		if($dados->getCdConceitoCliente() == 99){

			$info['valida'] = '1';
			$info['mensagem'] = 'Não foi possível concluir o agendamento, contate com o setor financeiro (54)2102-7700';
			echo json_encode($info);

		} else {

			$SomaQtPesoModif = 0;
			$dataEntrega = $_POST['data'];
			$cep = $_POST['cep'];

			$dados = array_filter($_POST['registros'], function ($it) { //Valida notas selecionadas
				return isset($it['valida']) and $it['valida'] == '1';
			});

			foreach ($dados as $key => $value) {
				$QtPesoModif = $value['QtPeso'];
				$SomaQtPesoModif += $QtPesoModif; //Soma peso das notas selecionadas
			}

			foreach($class->ValidaPeso($dataEntrega,$cep,$SomaQtPesoModif) as $dados){
				if($dados->getCdRetorno() == 1){
					$info['valida'] = '2';
					echo json_encode($info);
				} else {
					foreach($class->RetornaMensagemValidaPeso($cep) as $dados){ //Retorna mensagem
						$info['valida'] = '1';
						$info['mensagem'] = $dados->getCdRetorno();
						echo json_encode($info);
					}
				}
			}
		}
	}
}