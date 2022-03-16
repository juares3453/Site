<?php 

class RastreamentoDAO {

	private $conn;

	public function __construct($connection) {
		$this->conn = $connection;
	}

	public function ListaRastreamentos(RastreamentoModal $obj) {
		$results = array();

		$sql = '

		DECLARE @ID INT,
		@CLIENTE VARCHAR(14),
		@T1 VARCHAR(2),
		@T2 VARCHAR(2),
		@DI DATETIME,
		@DF DATETIME,
		@C1 VARCHAR(20),
		@C11 VARCHAR(20),
		@C2 VARCHAR(20),
		@C22 VARCHAR(20),
		@C3 VARCHAR(20),
		@C33 VARCHAR(20),
		@NRNF int,
		@NRNF1 int,
		@NRCTE int,
		@NRCTE1 int,
		@CDREMENTENTE VARCHAR(20),
		@CDREMENTENTE1 VARCHAR(20),
		@CDDESTINATARIO VARCHAR(20),
		@CDDESTINATARIO1 VARCHAR(20)

		SELECT @ID = :ID
		SELECT @CLIENTE = :Usuario_inscricao
		SELECT @T1 = :StNFe
		SELECT @T2 = :StCte
		SELECT @NRCTE = :NrCteIni
		SELECT @NRCTE1 = :NrCteFim
		SELECT @CDREMENTENTE = :CdRemIni
		SELECT @CDREMENTENTE1 = :CdRemFim
		SELECT @CDDESTINATARIO = :CdDesIni
		SELECT @CDDESTINATARIO1 = :CdDesFim

		SELECT @C1 = 0
		SELECT @C11 = 99999999999999
		SELECT @C2 = 0
		SELECT @C22 = 99999999999999
		SELECT @C3 = 0
		SELECT @C33 = 99999999999999

		SELECT @DI = GETDATE()-700
		SELECT @DF = GETDATE()

		IF (@T1 = 2)
		BEGIN
		SELECT @C1 = @CLIENTE
		SELECT @C11 = @CLIENTE
		END

		IF (@T1 = 3)
		BEGIN
		SELECT @C2 = @CLIENTE
		SELECT @C22 = @CLIENTE
		END

		IF (@T1 = 4)
		BEGIN
		SELECT @C3 = @CLIENTE
		SELECT @C33 = @CLIENTE
		END

		IF (@T2 = 2)
		BEGIN
		SELECT @DI = GETDATE()-365
		SELECT @DF = GETDATE()
		END

		IF (@T2 = 3)
		BEGIN
		SELECT @DI = GETDATE()-601
		SELECT @DF = GETDATE()-599
		END


		SELECT
		A.CdRemetente
		,B.DsEntidade AS [Remetente]
		,(Select top 1 DsLocal From SISCEP WITH(INDEX = iNrCEP) Where B.NrCep = SISCEP.NrCep) AS [CidadeRem]
		,R.NrNotaFiscal As [NotaFiscal]
		,A.NrDoctoFiscal as [CTe]
		,(select TOP 1 Q.NrPedido
		from GTCNFPED Q
		where R.NrNotaFiscal = Q.NrNotaFiscal
		and R.NrSerie = Q.NrSerie
		and R.CdRemetente = Q.CdRemetente)
		AS [Pedido]
		,R.NrMarca AS [OC]
		,A.CdDestinatario
		,C.DsEntidade as [Destinatario]
		,(Select top 1 DsLocal From SISCEP WITH(INDEX = iNrCEP) Where C.NrCep = SISCEP.NrCep) AS [CidadeDest]
		,A.DtEmissao
		,dbo.SP_CalculaDtPrevisaoEntregaPercReg(A.DtEmissao,A.CdEmpresaDestino,A.CdPercurso,A.CdTransporte
		,A.CdRemetente,A.CdDestinatario,A.CdEmpresa, A.NrSeqControle) AS [DtPrevEntrega]
		,A.DtEntregaProgramada
		,A.DtEntrega

		,R.VlNotaFiscal AS [Valor]
		,R.QtPeso AS [Peso]
		,R.QtVolume AS [Volumes]

		,A.VlTotalPrestacao AS [Frete]
		,H.DsSituacaoCarga

		,cast(R.VlNotaFiscal as numeric(14,2)) as VlrNota
		,cast(R.QtPeso as Numeric (14,1)) as PesoNota
		,cast(R.QtVolume as numeric(14,0)) as VolumeNota
		FROM GTCConhe A WITH (NOLOCK)
		LEFT JOIN SISCLI   B WITH(Index = SISCLI0) ON A.CdRemetente      = B.CdInscricao
		LEFT JOIN SISCLI   C WITH(Index = SISCLI0) ON A.CdDestinatario   = C.CdInscricao
		LEFT JOIN GTCSitCg H ON A.CdSituacaoCarga  = H.CdSituacaoCarga
		LEFT JOIN GTCNFCon S ON A.CdRemetente = S.CdInscricao and A.CdEmpresa = S.CdEmpresa And A.NrSeqControle = S.NrSeqControle
		LEFT JOIN GTCNF    R ON S.CdInscricao = R.CdRemetente And S.NrSerie = R.NrSerie And S.NrNotaFiscal = R.NrNotaFiscal
		WHERE isnull(A.InConhecimento,0) = 0
		AND A.InTipoEmissao not in (4,8)
		AND ((A.CdDestinatario = @CLIENTE OR A.CdRemetente = @CLIENTE OR A.CdInscricao = @CLIENTE)
		or exists (select top 1 CdInscricao
		from SISUSUCL D
		where D.Id = @ID
		and D.CdInscricao <> @CLIENTE
		and A.CdInscricao = D.CdInscricao)
		or exists (select top 1 CdInscricao
		from SISUSUCL D
		where D.Id = @ID
		and D.CdInscricao <> @CLIENTE
		and A.CdDestinatario = D.CdInscricao)
		or exists (select top 1 CdInscricao
		from SISUSUCL D
		where D.Id = @ID
		and D.CdInscricao <> @CLIENTE
		and A.CdRemetente = D.CdInscricao))
		AND A.DtEmissao BETWEEN :DtInicial AND :DtFinal
		AND A.CdDestinatario between @C1 and @C11
		AND A.CdRemetente between @C2 and @C22
		AND A.CdInscricao between @C3 and @C33
		AND A.NrDoctoFiscal between @NRCTE and @NRCTE1
		AND A.CdRemetente between @CDREMENTENTE and @CDREMENTENTE1
		AND A.CdDestinatario between @CDDESTINATARIO and @CDDESTINATARIO1
		AND ISNULL(A.DtEntrega,GETDATE()-600) between @DI AND @DF

		';

		if(!empty($obj->getNrNFe())) {
			$sql .= 'AND (R.NrNotaFiscal = :NrNFe)';
		}

		$stmt = $this->conn->prepare($sql);

		$stmt->bindValue(':Usuario_inscricao', $obj->getUsuarioCdInscricao(), PDO::PARAM_STR);
		$stmt->bindValue(':DtInicial', $obj->getDtInicial(), PDO::PARAM_STR);
		$stmt->bindValue(':DtFinal', $obj->getDtFinal(), PDO::PARAM_STR);
		$stmt->bindValue(':StNFe', $obj->getStNFe(), PDO::PARAM_STR);
		$stmt->bindValue(':StCte', $obj->getStCte(), PDO::PARAM_STR);
		$stmt->bindValue(':ID', $obj->getID(), PDO::PARAM_STR);

		//Cte
		if($obj->getCTe() == '0'){
			$nrCteIni = '0';
			$nrCteFim = '99999999';
			$stmt->bindValue(':NrCteIni', $nrCteIni, PDO::PARAM_STR);
			$stmt->bindValue(':NrCteFim', $nrCteFim, PDO::PARAM_STR);

		} else {
			$stmt->bindValue(':NrCteIni', $obj->getCTe(), PDO::PARAM_STR);
			$stmt->bindValue(':NrCteFim', $obj->getCTe(), PDO::PARAM_STR);
		}
		//Remetente
		if($obj->getCdRemetente() == '0'){
			$cdRemIni = '0';
			$cdRemFim = '99999999999999';
			$stmt->bindValue(':CdRemIni', $cdRemIni, PDO::PARAM_STR);
			$stmt->bindValue(':CdRemFim', $cdRemFim, PDO::PARAM_STR);
		} else {
			$stmt->bindValue(':CdRemIni', $obj->getCdRemetente(), PDO::PARAM_STR);
			$stmt->bindValue(':CdRemFim', $obj->getCdRemetente(), PDO::PARAM_STR);
		}
		//Destinatario
		if($obj->getCdDestinatario() == '0'){
			$cdDesIni = '0';
			$cdDesFim = '99999999999999';
			$stmt->bindValue(':CdDesIni', $cdDesIni, PDO::PARAM_STR);
			$stmt->bindValue(':CdDesFim', $cdDesFim, PDO::PARAM_STR);
		} else {
			$stmt->bindValue(':CdDesIni', $obj->getCdDestinatario(), PDO::PARAM_STR);
			$stmt->bindValue(':CdDesFim', $obj->getCdDestinatario(), PDO::PARAM_STR);
		}

		if(!empty($obj->getNrNFe())) {
			$stmt->bindValue(':NrNFe', $obj->getNrNFe(), PDO::PARAM_STR);
		}

		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new RastreamentoModal();
				$info->setCdRemetente($row->CdRemetente);
				$info->setRemetente(substr($row->Remetente,0,20));
				$info->setCidadeRem($row->CidadeRem);
				$info->setNotaFiscal($row->NotaFiscal);
				$info->setCTe($row->CTe);
				$info->setPedido($row->Pedido);
				$info->setOC($row->OC);
				$info->setCdDestinatario($row->CdDestinatario);
				$info->setDestinatario(substr($row->Destinatario,0,20));
				$info->setCidadeDest($row->CidadeDest);
				$info->setDtEmissao(date('d/m/y' , strtotime($row->DtEmissao)));
				$info->setDtPrevEntrega(date('d/m/y' , strtotime($row->DtPrevEntrega)));
				$info->setDtEntregaProgramada(date('d/m/y', strtotime($row->DtEntregaProgramada)));
				$info->setDtEntrega(date('d/m/Y', strtotime($row->DtEntrega)));
				$info->setVlrNota($row->VlrNota);
				$info->setPesoNota($row->PesoNota);
				$info->setVolumeNota($row->VolumeNota);
				$info->setFrete($row->Frete);
				$info->setDsSituacaoCarga($row->DsSituacaoCarga);
				$results[] = $info;
			}
		}
		return $results;
	}


}