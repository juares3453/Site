<?php

class LoginController {

	private $conn;

	public function __construct($connec) {
		$this->conn = $connec;
	}

	public function ConsultaDadosLoginPortal($usuario_form,$cnpj_form) {
		$dao = new LoginDAO($this->conn);
		return $dao->ConsultaDadosLoginPortal($usuario_form,$cnpj_form);
	}

	public function ConsultaLogsPortal($usuario_form,$cnpj_form) {
		$dao = new LoginDAO($this->conn);
		return $dao->ConsultaLogsPortal($usuario_form,$cnpj_form);
	}

	public function SalvaLogs(LoginModal $obj) {
		$dao = new LoginDAO($this->conn);
		return $dao->SalvaLogs($obj);
	}

	public function UpdateLogs(LoginModal $obj) {
		$dao = new LoginDAO($this->conn);
		return $dao->UpdateLogs($obj);
	}

	public function UpdateErrorLogin(LoginModal $obj) {
		$dao = new LoginDAO($this->conn);
		return $dao->UpdateErrorLogin($obj);
	}

	public function AlteraStatusUsuario(LoginModal $obj) {
		$dao = new LoginDAO($this->conn);
		return $dao->AlteraStatusUsuario($obj);
	}

	public function AlteraSenha(LoginModal $obj) {
		$dao = new LoginDAO($this->conn);
		return $dao->AlteraSenha($obj);
	}

	public function PerfilConfig($usuario_login,$usuario_inscricao) {
		$dao = new LoginDAO($this->conn);
		return $dao->PerfilConfig($usuario_login,$usuario_inscricao);
	}

	public function ValidaPaginaPerfil($url,$CdPerfil,$PermiteFinanceiro) {
		if($CdPerfil == '102'){
			if($PermiteFinanceiro == '0' && $url == 'consulta_financeiro.php'){
				return header('Location: index');
			}
		} else if ($CdPerfil == '105'){
			if($PermiteFinanceiro == '0'){
				if($url == 'consulta_nota_fiscal.php' || $url == 'consulta_financeiro.php' || $url == 'arquivo_xml_pdf.php'){
					return header('Location: index');
				}
			}
		}
	}

	public function AtualizaTermo(LoginModal $obj) {
		$dao = new LoginDAO($this->conn);
		return $dao->AtualizaTermo($obj);
	}

	public function ListaSenhaUsuario($cnpj) {
		$dao = new LoginDAO($this->conn);
		return $dao->ListaSenhaUsuario($cnpj);
	}

	public function InsertRecuperaSenha($cnpj,$hash) {
		$dao = new LoginDAO($this->conn);
		return $dao->InsertRecuperaSenha($cnpj,$hash);
	}

	public function ValidaHashSenha($hash) {
		$dao = new LoginDAO($this->conn);
		return $dao->ValidaHashSenha($hash);
	}

}