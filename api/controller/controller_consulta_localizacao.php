<?php

class ConsultaLocalizacaoController {

	private $conn;

	public function __construct($connec) {
		$this->conn = $connec;
	}

	public function ListaDadosNotaFiscal($tpCnpj,$NrNotaFiscal,$Cnpj) {

		//Ajusta CPF e CNPJ
		$cnpjModif = str_replace(str_split('./-'), '', $Cnpj);
		$cnpj = strlen($cnpjModif);

		if($cnpj == 11){
			$Cnpj = '000'.$cnpjModif;
		} else {
			$Cnpj = $Cnpj;
			$Cnpj = str_replace(str_split('./-'), '', $Cnpj);
		}

		$dao = new ConsultaLocalizacaoDAO($this->conn);
		return $dao->ListaDadosNotaFiscal($tpCnpj,$NrNotaFiscal,$Cnpj);
	}

	public function ListaHistorico($Cnpj,$NrNotaFiscal) {
		$dao = new ConsultaLocalizacaoDAO($this->conn);
		return $dao->ListaHistorico($Cnpj,$NrNotaFiscal);
	}

	public function OcultaData($data) {
		if ($data == "01/01/1970" || $data == "31/12/1969") {
			return "";
		} else {
			return $data;
		}
	}
}