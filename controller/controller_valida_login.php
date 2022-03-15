<?php

include '../modal/modal_login.php';
include '../dao/DAO_login.php';

class ValidaController {

	private $conn;

	public function __construct($connec) {
		$this->conn = $connec;
	}

	public function ValidaDadosLogin($usuario_form,$usuario_inscricao) {
		$dao = new LoginDAO($this->conn);

		foreach($dao->ConsultaLogsPortal($usuario_form,$usuario_inscricao) as $dados){
			if($dados->getRowCount() == 0){
				session_destroy();
				return header('Location: index');
			} else {
				return $dao->ConsultaLogsPortal($usuario_form,$usuario_inscricao);
			}
		}
	}

	public function ValidaExigeAlteraSenha($usuario_login,$usuario_inscricao) {
		$dao = new LoginDAO($this->conn);
		return $dao->ValidaExigeAlteraSenha($usuario_login,$usuario_inscricao);
	}

}