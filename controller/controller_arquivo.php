<?php

class ArquivoController {

	private $conn;

	public function __construct($connec) {
		$this->conn = $connec;
	}

	public function ListaArquivos($DtIni,$DtFim,$NrFatura,$NrCTe,$NrNF,$CdInscricao) {
		$dao = new ArquivoDAO($this->conn);
		return $dao->ListaArquivos($DtIni,$DtFim,$NrFatura,$NrCTe,$NrNF,$CdInscricao);
	}

}