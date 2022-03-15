<?php

class ConsultaAgendamentoController {

	private $conn;

	public function __construct($connec) {
		$this->conn = $connec;
	}

	public function ListaAgendamentos($cnpj,$dtInicial,$dtFinal) {
		$dao = new ConsultaAgendamentoDAO($this->conn);
		return $dao->ListaAgendamentos($cnpj,$dtInicial,$dtFinal);
	}

}