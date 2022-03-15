<?php

class AgendamentoDAO {

	private $conn;

	public function __construct($connection) {
		$this->conn = $connection;
	}

	public function ListaNotasAgendamento($cnpj) {
		$results = array();
		$stmt = $this->conn->prepare('EXECUTE [SOFTRAN_RASADOR].[dbo].[sp_ListaNfPortal] ?');
		$stmt->bindValue(1, $cnpj, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new AgendamentoModal();
				$info->setCdRemetente($row->CdRemetente);
				$info->setCdDestinatario($row->CdDestinatario);
				$info->setDsRemetente($row->DsRemetente);
				$info->setDsDestinatario($row->DsDestinatario);
				$info->setNrSerie($row->NrSerie);
				$info->setNrNotaFiscal($row->NrNotaFiscal);
				$info->setDtEmissao(date('d/m/Y', strtotime($row->DtEmissao)));
				$info->setVlNotaFiscal(number_format($row->VlNotaFiscal,2 , ',', '.'));
				$info->setQtPeso(round($row->QtPeso),0);
				$info->setQtVolume(round($row->QtVolume),0);
				$info->setNrPedido($row->NrPedido);
				$info->setDsMarca($row->DsMarca);
				$info->setDtTolerancia($row->DtTolerancia);
				$info->setArmazenamento($row->Armazenamento);
				$results[] = $info;
			}
		}

		return $results;
	}

	public function ListaRegistros($cnpj) {
		$results = array();
		$stmt = $this->conn->prepare('EXECUTE [SOFTRAN_RASADOR].[dbo].[sp_ListaNfPortalList] ?');
		$stmt->bindValue(1, $cnpj, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new AgendamentoModal();
				$info->setCdRemetente($row->CdRemetente);
				$results[] = $info;
			}
		}

		return $results;
	}

	public function ListaCnpjID($id_cnpj,$cnpj) {
		$results = array();
		$stmt = $this->conn->prepare('

			SET NOCOUNT ON

			DECLARE @ID INT,
			@CNPJ VARCHAR(14),
			@CLIENTE VARCHAR(14),
			@AUXCLI INT,
			@AUX INT

			SET @ID = ?;
			SET @CNPJ = ?;

			DECLARE  @TMP TABLE (
			CdCNPJ  VARCHAR(14) NULL
			)

			INSERT INTO @TMP (CdCNPJ)
			VALUES (@CNPJ);

			INSERT INTO @TMP (CdCNPJ)
			SELECT CdInscricao FROM SISUSUCL WHERE Id = @ID AND CdInscricao <> @CNPJ;

			SELECT * FROM @TMP

			');
		$stmt->bindValue(1, $id_cnpj, PDO::PARAM_STR);
		$stmt->bindValue(2, $cnpj, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new AgendamentoModal();
				$info->setCdRemetente($row->CdCNPJ);
				$results[] = $info;
			}
		}

		return $results;
	}

	public function BuscaDadosCliente($cnpj) {
		$results = array();
		$stmt = $this->conn->prepare('
			SELECT
			A.CdInscricao
			,A.DsEntidade
			,A.DsEndereco
			,A.DsNumero
			,A.DsBairro
			,A.DsComplemento
			,A.NrTelefone
			,A.NrCEP
			,B.DsLocal
			,B.DsUF
			FROM SISCli A
			LEFT JOIN SISCep B ON A.NrCEP = B.NrCEP
			WHERE A.CdInscricao = ?
			');
		$stmt->bindValue(1, $cnpj, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new AgendamentoModal();
				$info->setDsEntidade($row->DsEntidade);
				$info->setDsEndereco($row->DsEndereco);
				$info->setDsBairro($row->DsBairro);
				$info->setNrCEP($row->NrCEP);
				$info->setNrTelefone($row->NrTelefone);
				$info->setDsNumero($row->DsNumero);
				$info->setDsLocal($row->DsLocal);
				$info->setDsUF($row->DsUF);
				$info->setDsComplemento($row->DsComplemento);
				$results[] = $info;
			}
		}
		return $results;
	}

	public function ValidaDataDeEntrega($data,$cep) {
		$results = array();
		$stmt = $this->conn->prepare('SELECT SOFTRAN_RASADOR.dbo.sp_SeDiaUtilAgenda(:cep,:data) as CdRetorno');
		$stmt->bindValue(1, $cep, PDO::PARAM_STR);
		$stmt->bindValue(2, $data, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new AgendamentoModal();
				$info->setCdRetorno($row->CdRetorno);
				$results[] = $info;
			}
		}
		return $results;
	}

	public function RetornaDataUtil($data,$cep) {
		$results = array();
		$stmt = $this->conn->prepare('SELECT SOFTRAN_RASADOR.dbo.sp_ProxDiaUtilAgenda(?,?) as DtUtil');
		$stmt->bindValue(1, $cep, PDO::PARAM_STR);
		$stmt->bindValue(2, $data, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new AgendamentoModal();
				$info->setDtUtil($row->DtUtil);
				$results[] = $info;
			}
		}
		return $results;
	}

	public function BuscaCep($cep) {
		$results = array();
		$stmt = $this->conn->prepare('SELECT * FROM SISCEP WHERE NrCep = ?');
		$stmt->bindValue(1, $cep, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new AgendamentoModal();
				$info->setDsLocal($row->DsLocal);
				$info->setDsUF($row->DsUF);
				$results[] = $info;
			}
		}
		return $results;
	}

	public function InsereDadosAgendamento(AgendamentoModal $obj) {
		$this->conn->beginTransaction();
		try {
			$stmt = $this->conn->prepare('
				BEGIN
				IF NOT EXISTS (SELECT * FROM XEDINFSIT
				WHERE NrSerieNFAgend = :NrSerieNFAgend1
				AND NrNotaFiscalAgend = :NrNotaFiscalAgend1
				AND CdDestinatarioAgend = :CdDestinatarioAgend1
				AND isnull(InSituacao,0) = 0)

				BEGIN
				INSERT XEDINFSIT (CdLote, CdSequencia, CdDestinatarioAgend, DsEntidadeAgend, NrCepEntregaAgend, DsCidadeAgend, DsUFAgend, DsBairroAgend, DsEnderecoAgend, DsNumAgend, NrTelefoneAgend, DsComplementoAgend, DtEntregaProgramada, DsComentarioAgend, NrSerieNFAgend, NrNotaFiscalAgend, CdRemetente, CdDestinatario, VlMercadoria, QtPesoCubado, QtVolumes, NrPedido, NrChaveAcessoNFe, DtAgendamento, InProcessado, CdInscricao)
				VALUES (:CdLote, :CdSequencia, :CdDestinatarioAgend, :DsEntidadeAgend, :NrCepEntregaAgend, :DsCidadeAgend, :DsUFAgend, :DsBairroAgend, :DsEnderecoAgend, :DsNumAgend, :NrTelefoneAgend, :DsComplementoAgend, :DtEntregaProgramada, :DsComentarioAgend, :NrSerieNFAgend, :NrNotaFiscalAgend, :CdRemetente, :CdDestinatario, :VlMercadoria, :QtPesoCubado, :QtVolumes, :NrPedido, :NrChaveAcessoNFe, :DtAgendamento, :InProcessado, :CdInscricao)
				END
				END
				');

			$stmt->bindValue(':CdLote', $obj->getCdLote(), PDO::PARAM_INT);
			$stmt->bindValue(':CdSequencia', $obj->getCdSequencia(), PDO::PARAM_INT);
			$stmt->bindValue(':CdDestinatarioAgend', $obj->getCdDestinatarioAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':DsEntidadeAgend', $obj->getDsEntidadeAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':NrCepEntregaAgend', $obj->getNrCepEntregaAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':DsCidadeAgend', $obj->getDsCidadeAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':DsUFAgend', $obj->getDsUFAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':DsBairroAgend', $obj->getDsBairroAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':DsEnderecoAgend', $obj->getDsEnderecoAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':DsNumAgend', $obj->getDsNumAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':NrTelefoneAgend', $obj->getNrTelefoneAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':DsComplementoAgend', $obj->getDsComplementoAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':DtEntregaProgramada', $obj->getDtEntregaProgramada(), PDO::PARAM_INT);
			$stmt->bindValue(':DsComentarioAgend', $obj->getDsComentarioAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':NrSerieNFAgend', $obj->getNrSerieNFAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':NrNotaFiscalAgend', $obj->getNrNotaFiscalAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':CdRemetente', $obj->getCdRemetente(), PDO::PARAM_INT);
			$stmt->bindValue(':CdDestinatario', $obj->getCdDestinatario(), PDO::PARAM_INT);
			$stmt->bindValue(':VlMercadoria', $obj->getVlMercadoria(), PDO::PARAM_INT);
			$stmt->bindValue(':QtPesoCubado', $obj->getQtPesoCubado(), PDO::PARAM_INT);
			$stmt->bindValue(':QtVolumes', $obj->getQtVolumes(), PDO::PARAM_INT);
			$stmt->bindValue(':NrPedido', $obj->getNrPedido(), PDO::PARAM_INT);
			$stmt->bindValue(':NrChaveAcessoNFe', $obj->getNrChaveAcessoNFe(), PDO::PARAM_INT);
			$stmt->bindValue(':DtAgendamento', $obj->getDtAgendamento(), PDO::PARAM_INT);
			$stmt->bindValue(':InProcessado', $obj->getInProcessado(), PDO::PARAM_INT);
			$stmt->bindValue(':NrSerieNFAgend1', $obj->getNrSerieNFAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':NrNotaFiscalAgend1', $obj->getNrNotaFiscalAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':CdDestinatarioAgend1', $obj->getCdDestinatarioAgend(), PDO::PARAM_INT);
			$stmt->bindValue(':CdInscricao', $obj->getCdInscricao(), PDO::PARAM_INT);
			$stmt->execute();

			$this->conn->commit();

		} catch (Exception $e) {
			$this->conn->rollback();
		}
	}

	//Gera o CdLote
	public function GeraNumeroLote() {
		$stmt = $this->conn->prepare('SELECT MAX(CdLote)+1 AS CdLote FROM XEDINFSIT');
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new AgendamentoModal();
				$info->setCdLote($row->CdLote);
				$results[] = $info;
			}
		}
		return $results;
	}

	//Valida Inadimplente
	public function ValidaInadimplente($usuario_inscricao) {
		$stmt = $this->conn->prepare('SELECT CdConceitoCliente from SISCliFa where CdInscricao = ?');
		$stmt->bindValue(1, $usuario_inscricao, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new AgendamentoModal();
				$info->setCdConceitoCliente($row->CdConceitoCliente);
				$results[] = $info;
			}
		}
		return $results;
	}

	public function ValidaPeso($data,$cep,$peso) {
		$results = array();
		$stmt = $this->conn->prepare('SELECT SOFTRAN_RASADOR.dbo.sp_RetornaSePesoUltrap_nv(:cep,:data,:peso) as CdRetorno');
		$stmt->bindValue(1, $cep, PDO::PARAM_STR);
		$stmt->bindValue(2, $data, PDO::PARAM_STR);
		$stmt->bindValue(3, $peso, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new AgendamentoModal();
				$info->setCdRetorno($row->CdRetorno);
				$results[] = $info;
			}
		}
		return $results;
	}

	public function RetornaMensagemValidaPeso($cep) {
		$results = array();
		$stmt = $this->conn->prepare('

			SELECT top 1
			A.DsMsgAgendExcedidos as CdRetorno
			FROM ESP35304 A
			WHERE A.CdEmpresa = (select top 1
			case when ISNULL(D.CdEmpresa,4)= 4 then 4
			when D.CdEmpresa IN (12,13,15) then 12
			when D.CdEmpresa = 14 then 14
			when D.CdEmpresa = 3 then 3
			when D.CdEmpresa = 2 then 1
			else (case when C.DsUF = \'SP\' then 4
			when C.DsUF = \'SC\' then 12
			else 1 end)
			end AS [CD]
			from SISRegia D
			left join SISRegia C on (substring (C.NrRegiao,1,8) + \'0000\') = D.NrRegiao
			left join SISCep B on C.CdRegiao=B.CdRegiao
			where B.NrCep = ?)

			');
		$stmt->bindValue(1, $cep, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new AgendamentoModal();
				$info->setCdRetorno($row->CdRetorno);
				$results[] = $info;
			}
		}
		return $results;
	}

	public function GeraLoteEDI($CdLote) {
		$this->conn->beginTransaction();
		try {
			$stmt = $this->conn->prepare('EXEC sp_GeraLoteEDI ?');
			$stmt->bindValue(1, $CdLote, PDO::PARAM_INT);
			$stmt->execute();
			$this->conn->commit();
		} catch (Exception $e) {
			$this->conn->rollback();
		}
	}

	public function ValidaConsignatario($notafiscal,$nrserie,$cdremetente) {
		$results = array();
		$stmt = $this->conn->prepare('

			SELECT B.CdConsignatario FROM SOFTRAN_RASADOR.dbo.GTCNFCon A
				LEFT JOIN SOFTRAN_RASADOR.dbo.GTCCONHE B ON A.NrSeqControle = B.NrSeqControle
				LEFT JOIN SOFTRAN_RASADOR.dbo.GTCCONCE C ON A.NrSeqControle = C.NrSeqControle
			WHERE A.NrNotaFiscal = ?
			AND A.NrSerie = ?
			AND B.CdRemetente = ?
			AND A.CdEmpresa = 1
			AND C.InSituacaoSefaz = 100
			AND B.DtEmissao >= GETDATE()-400

		');
		$stmt->bindValue(1, $notafiscal, PDO::PARAM_STR);
		$stmt->bindValue(2, $nrserie, PDO::PARAM_STR);
		$stmt->bindValue(3, $cdremetente, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new AgendamentoModal();
				$info->setCdConsignatario($row->CdConsignatario);
				$results[] = $info;
			}
		}

		return $results;
	}

}