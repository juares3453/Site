<?php

class LoginDAO {

	private $conn;

	public function __construct($connection) {
		$this->conn = $connection;
	}

	public function ConsultaDadosLoginPortal($usuario_form,$cnpj_form) {
		$results = array();
		$stmt = $this->conn->prepare('
			SELECT
			ID,
			CdInscricao,
			DsLogin,
			DsSenha,
			CdPerfil,
			(select top 1 B.DsEmail1
			from SISCli A
			left join SISEmpre B on A.CdEmpresa=B.CdEmpresa
			where A.CdInscricao=SISWEBUSU.CdInscricao)
			AS [EmailCL]
			FROM SISWEBUSU
			WHERE DsLogin = ?
			AND CdInscricao = ?
			');
		$stmt->bindValue(1, $usuario_form, PDO::PARAM_STR);
		$stmt->bindValue(2, $cnpj_form, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new LoginModal();
				$info->setID($row->ID);
				$info->setCdInscricao($row->CdInscricao);
				$info->setDsLogin($row->DsLogin);
				$info->setDsSenha($row->DsSenha);
				$info->setEmailCL($row->EmailCL);
				$results[] = $info;
			}
		}
		return $results;
	}

	public function ConsultaLogsPortal($usuario_form,$cnpj_form) {
		$results = array();
		$stmt = $this->conn->prepare('SELECT ID, DsLogin, DsEnderecoIp, DtUltimoAcesso, InAtivo, CdError, DtUltimaTentativa, DtUltimaVisita, CdInscricao, InAceiteTermo from [Portal].[dbo].[LogPortalCli] WHERE DsLogin = ? AND CdInscricao = ?');
		$stmt->bindValue(1, $usuario_form, PDO::PARAM_STR);
		$stmt->bindValue(2, $cnpj_form, PDO::PARAM_STR);
		$stmt->execute();

		//Conta linhas afetadas no SQL
		$rowCount = $stmt->rowCount();

		if($rowCount != 0){
			if ($stmt) {
				while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
					$info = new LoginModal();
					$info->setID($row->ID);
					$info->setDsLogin($row->DsLogin);
					$info->setDtUltimoAcesso($row->DtUltimoAcesso);
					$info->setDsEnderecoIp($row->DsEnderecoIp);
					$info->setInAtivo($row->InAtivo);
					$info->setCdError($row->CdError);
					$info->setDtUltimaTentativa($row->DtUltimaTentativa);
					$info->setDtUltimaVisita($row->DtUltimaVisita);
					$info->setCdInscricao($row->CdInscricao);
					$info->setInAceiteTermo($row->InAceiteTermo);
					$info->setRowCount($rowCount);
					$results[] = $info;
				}
			}
		} else {
			$dados = new LoginModal();
			$dados->setRowCount($rowCount);
			$results[] = $dados;
		}

		return $results;
	}

	public function SalvaLogs(LoginModal $obj) {
		$this->conn->beginTransaction();
		try {
			$stmt = $this->conn->prepare(
				'INSERT INTO [Portal].[dbo].[LogPortalCli] (DsLogin, DsEnderecoIp, DtUltimoAcesso, InAtivo, CdError, DtUltimaTentativa, DtUltimaVisita, CdInscricao)
				VALUES (:DsLogin, :DsEnderecoIp, :DtUltimoAcesso, :InAtivo, :CdError, :DtUltimaTentativa, :DtUltimaVisita, :CdInscricao)'
				);
			$stmt->bindValue(':DsLogin', $obj->getDsLogin(), PDO::PARAM_STR);
			$stmt->bindValue(':CdInscricao', $obj->getCdInscricao(), PDO::PARAM_INT);
			$stmt->bindValue(':DsEnderecoIp', $obj->getDsEnderecoIp(), PDO::PARAM_STR);
			$stmt->bindValue(':DtUltimoAcesso', $obj->getDtUltimoAcesso(), PDO::PARAM_STR);
			$stmt->bindValue(':InAtivo', $obj->getInAtivo(), PDO::PARAM_INT);
			$stmt->bindValue(':CdError', $obj->getCdError(), PDO::PARAM_INT);
			$stmt->bindValue(':DtUltimaTentativa', $obj->getDtUltimaTentativa(), PDO::PARAM_INT);
			$stmt->bindValue(':DtUltimaVisita', $obj->getDtUltimaVisita(), PDO::PARAM_INT);
			$stmt->execute();

			$this->conn->commit();
		} catch (Exception $e) {
			$this->conn->rollback();
		}
	}

	public function UpdateLogs(LoginModal $obj) {
		$this->conn->beginTransaction();
		try {
			$stmt = $this->conn->prepare(
				'UPDATE [Portal].[dbo].[LogPortalCli] SET DsEnderecoIp = :DsEnderecoIp, DtUltimoAcesso = :DtUltimoAcesso, InAtivo = :InAtivo, CdError = :CdError, DtUltimaVisita = :DtUltimaVisita, CdInscricao = :CdInscricao WHERE DsLogin = :DsLogin AND CdInscricao = :CdInscricaoConsulta'
				);
			$stmt->bindValue(':DsLogin', $obj->getDsLogin(), PDO::PARAM_INT);
			$stmt->bindValue(':CdInscricao', $obj->getCdInscricao(), PDO::PARAM_INT);
			$stmt->bindValue(':CdInscricaoConsulta', $obj->getCdInscricao(), PDO::PARAM_INT);
			$stmt->bindValue(':DsEnderecoIp', $obj->getDsEnderecoIp(), PDO::PARAM_STR);
			$stmt->bindValue(':DtUltimoAcesso', $obj->getDtUltimoAcesso(), PDO::PARAM_STR);
			$stmt->bindValue(':InAtivo', $obj->getInAtivo(), PDO::PARAM_INT);
			$stmt->bindValue(':CdError', $obj->getCdError(), PDO::PARAM_INT);
			$stmt->bindValue(':DtUltimaVisita', $obj->getDtUltimaVisita(), PDO::PARAM_INT);
			$stmt->execute();

			$this->conn->commit();
		} catch (Exception $e) {
			$this->conn->rollback();
		}
	}

	public function UpdateErrorLogin(LoginModal $obj) {
		$this->conn->beginTransaction();
		try {
			$stmt = $this->conn->prepare(
				'UPDATE [Portal].[dbo].[LogPortalCli] SET CdError = CdError+1, DtUltimaTentativa = :DtUltimaTentativa, DsEnderecoIp = :DsEnderecoIp WHERE DsLogin = :DsLogin AND CdInscricao = :CdInscricao'
				);
			$stmt->bindValue(':DsLogin', $obj->getDsLogin(), PDO::PARAM_INT);
			$stmt->bindValue(':CdInscricao', $obj->getCdInscricao(), PDO::PARAM_INT);
			$stmt->bindValue(':DtUltimaTentativa', $obj->getDtUltimaTentativa(), PDO::PARAM_INT);
			$stmt->bindValue(':DsEnderecoIp', $obj->getDsEnderecoIp(), PDO::PARAM_INT);
			$stmt->execute();

			$this->conn->commit();
		} catch (Exception $e) {
			$this->conn->rollback();
		}
	}

	public function AlteraStatusUsuario(LoginModal $obj) {
		$this->conn->beginTransaction();
		try {
			$stmt = $this->conn->prepare(
				'UPDATE [Portal].[dbo].[LogPortalCli] SET InAtivo = :InAtivo, DtUltimaTentativa = :DtUltimaTentativa, CdError = :CdError, DsEnderecoIp = :DsEnderecoIp WHERE DsLogin = :DsLogin AND CdInscricao = :CdInscricao'
				);
			$stmt->bindValue(':DsLogin', $obj->getDsLogin(), PDO::PARAM_INT);
			$stmt->bindValue(':CdInscricao', $obj->getCdInscricao(), PDO::PARAM_INT);
			$stmt->bindValue(':InAtivo', $obj->getInAtivo(), PDO::PARAM_INT);
			$stmt->bindValue(':CdError', $obj->getCdError(), PDO::PARAM_INT);
			$stmt->bindValue(':DtUltimaTentativa', $obj->getDtUltimaTentativa(), PDO::PARAM_INT);
			$stmt->bindValue(':DsEnderecoIp', $obj->getDsEnderecoIp(), PDO::PARAM_INT);
			$stmt->execute();

			$this->conn->commit();
		} catch (Exception $e) {
			$this->conn->rollback();
		}
	}

	public function AlteraSenha(LoginModal $obj) {
		$this->conn->beginTransaction();
		try {
			$stmt = $this->conn->prepare('

				UPDATE SISWEBUSU SET DsSenha = ?, InPermAltContatoCliente = 0
				WHERE DsLogin = ?
				AND CdInscricao = ?

				');
			$stmt->bindValue(1, $obj->getDsSenha(), PDO::PARAM_INT);
			$stmt->bindValue(2, $obj->getDsLogin(), PDO::PARAM_INT);
			$stmt->bindValue(3, $obj->getCdInscricao(), PDO::PARAM_INT);

			$stmt->execute();

			$this->conn->commit();
		} catch (Exception $e) {
			$this->conn->rollback();
		}
	}

	public function PerfilConfig($usuario_login,$usuario_inscricao) {
		$results = array();
		$stmt = $this->conn->prepare('
			SELECT TOP 1
			B.*
			FROM SISWEBUSU A
			LEFT JOIN SISPERWB B ON A.CdPerfil=B.CdPerfil
			WHERE  CdInscricao = ?
			AND DsLogin = ?
			');
		$stmt->bindValue(1, $usuario_login, PDO::PARAM_STR);
		$stmt->bindValue(2, $usuario_inscricao, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new LoginModal();
				$info->setInPermiteConsFinanc($row->InPermiteConsFinanc);
				$info->setCdPerfil($row->CdPerfil);
				$results[] = $info;
			}
		}
		return $results;
	}

	public function ValidaExigeAlteraSenha($usuario_login,$usuario_inscricao) {
		$results = array();
		$stmt = $this->conn->prepare('
			SELECT InPermAltContatoCliente
			FROM SISWEBUSU
			WHERE DsLogin = ?
			AND CdInscricao = ?
			');
		$stmt->bindValue(1, $usuario_login, PDO::PARAM_STR);
		$stmt->bindValue(2, $usuario_inscricao, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new LoginModal();
				$info->setInPermAltContatoCliente($row->InPermAltContatoCliente);
				$results[] = $info;
			}
		}
		return $results;
	}

	public function AtualizaTermo(LoginModal $obj) {
		$this->conn->beginTransaction();
		try {
			$stmt = $this->conn->prepare('
				UPDATE [Portal].[dbo].[LogPortalCli] SET InAceiteTermo = ?
				WHERE DsLogin = ?
				AND CdInscricao = ?
				');
			$stmt->bindValue(1, $obj->getInAceiteTermo(), PDO::PARAM_INT);
			$stmt->bindValue(2, $obj->getDsLogin(), PDO::PARAM_INT);
			$stmt->bindValue(3, $obj->getCdInscricao(), PDO::PARAM_INT);
			$stmt->execute();
			$this->conn->commit();
		} catch (Exception $e) {
			$this->conn->rollback();
		}
	}

	public function ListaSenhaUsuario($cnpj) {
		$results = array();
		$stmt = $this->conn->prepare('
			SELECT  
			A.DsLogin as [DsLogin],
			A.DsSenha as [DsSenha],
			B.DsEMail as [DsEmail]
			FROM SISWEBUSU A
			LEFT JOIN SISCLI B ON A.CdInscricao = B.CdInscricao
			WHERE A.CdInscricao = ?
			');
		$stmt->bindValue(1, $cnpj, PDO::PARAM_INT);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new LoginModal();
				$info->setDsLogin($row->DsLogin);
				$info->setDsEmail($row->DsEmail);
				$info->setDsSenha($row->DsSenha);
				$results[] = $info;
			}
		}
		return $results;
	}

	public function InsertRecuperaSenha($cnpj,$hash) {
		$this->conn->beginTransaction();
		try {
			$stmt = $this->conn->prepare('INSERT INTO [Portal].[dbo].[RecuperaSenha] (CdInscricao, Hash_email, DtSolicitacao) VALUES (?, ?, ?)');
			$stmt->bindValue(1, $cnpj, PDO::PARAM_INT);
			$stmt->bindValue(2, $hash, PDO::PARAM_INT);
			$stmt->bindValue(3, date('Y-m-d'), PDO::PARAM_INT);
			$stmt->execute();
			$this->conn->commit();
		} catch (Exception $e) {
			echo $e;
			$this->conn->rollback();
		}
	}

	public function ValidaHashSenha($hash) {
		$results = array();
		$stmt = $this->conn->prepare('SELECT * FROM [Portal].[dbo].[RecuperaSenha] WHERE Hash_email = ?');
		$stmt->bindValue(1, $hash, PDO::PARAM_INT);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new LoginModal();
				$info->setCdInscricao($row->CdInscricao);
				$results[] = $info;
			}
		}
		return $results;
	}

}