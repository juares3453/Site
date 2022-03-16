<?php

class AgendamentoController {

	private $conn;

	public function __construct($connec) {
		$this->conn = $connec;
	}

	public function GeraNumeroLote() {
		$dao = new AgendamentoDAO($this->conn);
		return $dao->GeraNumeroLote();
	}

	public function ListaNotasAgendamento($cnpj) {
		$dao = new AgendamentoDAO($this->conn);
		return $dao->ListaNotasAgendamento($cnpj);
	}

	public function ListaRegistros($cnpj) {
		$dao = new AgendamentoDAO($this->conn);
		return $dao->ListaRegistros($cnpj);
	}

	public function ListaCnpjID($id_cnpj,$cnpj) {
		$dao = new AgendamentoDAO($this->conn);
		return $dao->ListaCnpjID($id_cnpj,$cnpj);
	}

	public function BuscaDadosCliente($cnpj) {
		$dao = new AgendamentoDAO($this->conn);
		return $dao->BuscaDadosCliente($cnpj);
	}

	public function ValidaDataDeEntrega($data,$cep) {
		$dao = new AgendamentoDAO($this->conn);
		return $dao->ValidaDataDeEntrega($data,$cep);
	}

	public function RetornaDataUtil($data,$cep) {
		$dao = new AgendamentoDAO($this->conn);
		return $dao->RetornaDataUtil($data,$cep);
	}

	public function BuscaCep($cep) {
		$dao = new AgendamentoDAO($this->conn);
		return $dao->BuscaCep($cep);
	}

	public function InsereDadosAgendamento(AgendamentoModal $obj) {
		$dao = new AgendamentoDAO($this->conn);
		return $dao->InsereDadosAgendamento($obj);
	}

	public function ValidaInadimplente($usuario_inscricao) {
		$dao = new AgendamentoDAO($this->conn);
		return $dao->ValidaInadimplente($usuario_inscricao);
	}

	public function ValidaPeso($data,$cep,$peso) {
		$dao = new AgendamentoDAO($this->conn);
		return $dao->ValidaPeso($data,$cep,$peso);
	}

	public function RetornaMensagemValidaPeso($cep) {
		$dao = new AgendamentoDAO($this->conn);
		return $dao->RetornaMensagemValidaPeso($cep);
	}

	public function ValidaConsignatario($notafiscal,$nrserie,$cdremetente) {
		$dao = new AgendamentoDAO($this->conn);
		return $dao->ValidaConsignatario($notafiscal,$nrserie,$cdremetente);
	}

	public function GeraLoteEDI($CdLote) {
		$dao = new AgendamentoDAO($this->conn);
		return $dao->GeraLoteEDI($CdLote);
	}

	public function ValidaDataLimite($data){

		$dataAtual = date('Y-m-d H:i:s');

		if($dataAtual > $data){

			echo 'class="red"';

		} else {

			echo 'class="green"';

		}

	}

}