<?php

class Controller{

	private $conn;

	public function __construct($connec) {
		$this->conn = $connec;
	}

	public function ListaDetalheFatura($CdTipo,$NrFatura,$CdEmpresa,$CdParcela,$CdInscricao){
		$dao = new Dao($this->conn);
		return $dao->ListaDetalheFatura($CdTipo,$NrFatura,$CdEmpresa,$CdParcela,$CdInscricao);
	}

	public function ListaNF($NrDocumento,$CdTipo,$NrFatura,$CdEmpresa,$CdParcela,$CdInscricao){
		$dao = new Dao($this->conn);
		return $dao->ListaNF($NrDocumento,$CdTipo,$NrFatura,$CdEmpresa,$CdParcela,$CdInscricao);
	}


	public function retirarAcentos($string){
		return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(Ç)/" ),explode(" ","a A e E i I o O u U n N C"),$string);
	}
}