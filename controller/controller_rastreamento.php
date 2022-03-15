<?php

class RastreamentoController {

	private $conn;

	public function __construct($connec) {
		$this->conn = $connec;
	}

	public function ListaRastreamentos(RastreamentoModal $obj) {
		$dao = new RastreamentoDAO($this->conn);
		return $dao->ListaRastreamentos($obj);
	}

	public function OcultaData($data) {
		if ($data == "01/01/1970" || $data == "31/12/1969") {
			return "";
		} else {
			return $data;
		}
	}

}