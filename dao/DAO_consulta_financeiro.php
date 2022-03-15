<?php

class ConsultaFinanceiroDAO {

	private $conn;

	public function __construct($connection) {
		$this->conn = $connection;
	}

	public function ListaFaturas($dias,$stFat,$cnpj) {

		//Todas faturas
		if($stFat == 5){
			$results = array();
			$stmt = $this->conn->prepare("
				SELECT
				I.CdPortador,
				I.DsPortador,
				H.CdTitulo,
				isnull((select top 1 K.DsSituacao from GFASitua K where K.CdSituacao=H.CdSituacao),'') as [DsSituacao],
				H.DtEmissao,
				H.DtVencimento,
				H.VlLiquidoOriginal,
				H.VlSaldo,
				H.NrFatura,
				H.CdFilial,
				H.CdParcela,
				J.InProprioTerceiros
				FROM GFATitu H
				LEFT JOIN SISPorta I ON I.CdPortador=H.CdPortador
				LEFT JOIN GTCFAT J ON J.CdInscricao = H.CdInscricao AND J.CdFatura = H.NrFatura AND J.CdEmpresa = H.CdFilial
				WHERE H.CdInscricao = ?
				AND H.DtEmissao > GETDATE()-$dias
				AND H.InSituacao IS NULL
				AND H.InPagarReceber = 1
				ORDER BY 6
				");
		}

		//A Vencer
		if($stFat == 0){
			$results = array();
			$stmt = $this->conn->prepare("
				SELECT
				I.CdPortador,
				I.DsPortador,
				H.CdTitulo,
				isnull((select top 1 K.DsSituacao from GFASitua K where K.CdSituacao=H.CdSituacao),'') as [DsSituacao],
				H.DtEmissao,
				H.DtVencimento,
				H.VlLiquidoOriginal,
				H.VlSaldo,
				H.NrFatura,
				H.CdFilial,
				H.CdParcela,
				J.InProprioTerceiros
				FROM GFATitu H
				LEFT JOIN SISPorta I ON I.CdPortador=H.CdPortador
				LEFT JOIN GTCFAT J ON J.CdInscricao = H.CdInscricao AND J.CdFatura = H.NrFatura AND J.CdEmpresa = H.CdFilial
				WHERE H.VlSaldo > 0
				AND H.CdInscricao = ?
				AND H.DtEmissao > GETDATE()-$dias
				AND H.InSituacao IS NULL
				AND H.DtVencimento >= GETDATE()
				AND H.InPagarReceber = 1
				ORDER BY 6
				");

		}

		//Vencidas
		if($stFat == 1){
			$results = array();
			$stmt = $this->conn->prepare("
				SELECT
				I.CdPortador,
				I.DsPortador,
				H.CdTitulo,
				isnull((select top 1 K.DsSituacao from GFASitua K where K.CdSituacao=H.CdSituacao),'') as [DsSituacao],
				H.DtEmissao,
				H.DtVencimento,
				H.VlLiquidoOriginal,
				H.VlSaldo,
				H.NrFatura,
				H.CdFilial,
				H.CdParcela,
				J.InProprioTerceiros
				FROM GFATitu H
				LEFT JOIN SISPorta I ON I.CdPortador=H.CdPortador
				LEFT JOIN GTCFAT J ON J.CdInscricao = H.CdInscricao AND J.CdFatura = H.NrFatura AND J.CdEmpresa = H.CdFilial
				WHERE H.VlSaldo > 0
				AND H.CdInscricao = ?
				AND H.DtEmissao > GETDATE()-$dias
				AND H.InSituacao IS NULL
				AND H.DtVencimento < GETDATE()
				AND H.InPagarReceber = 1
				ORDER BY 6
				");
		}

		//Pagas
		if($stFat == 2){
			$results = array();
			$stmt = $this->conn->prepare("
				SELECT
				I.CdPortador,
				I.DsPortador,
				H.CdTitulo,
				isnull((select top 1 K.DsSituacao from GFASitua K where K.CdSituacao=H.CdSituacao),'') as [DsSituacao],
				H.DtEmissao,
				H.DtVencimento,
				H.VlLiquidoOriginal,
				H.VlSaldo,
				H.NrFatura,
				H.CdFilial,
				H.CdParcela,
				J.InProprioTerceiros
				FROM GFATitu H
				LEFT JOIN SISPorta I ON I.CdPortador=H.CdPortador
				LEFT JOIN GTCFAT J ON J.CdInscricao = H.CdInscricao AND J.CdFatura = H.NrFatura AND J.CdEmpresa = H.CdFilial
				WHERE H.VlSaldo = 0
				AND H.CdInscricao = ?
				AND H.DtEmissao > GETDATE()-$dias
				AND H.InSituacao IS NULL
				AND H.InPagarReceber = 1
				ORDER BY 6
				");
		}

		$stmt->bindValue(1, $cnpj, PDO::PARAM_STR);

		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new ConsultaFinanceiroModal();
				$info->setCdPortador($row->CdPortador);
				$info->setDsPortador($row->DsPortador);
				$info->setCdTitulo($row->CdTitulo);
				$info->setDsSituacao($row->DsSituacao);
				$info->setDtVencimento($row->DtVencimento);
				$info->setVlLiquidoOriginal($row->VlLiquidoOriginal);
				$info->setVlSaldo($row->VlSaldo);
				$info->setNrFatura($row->NrFatura);
				$info->setCdFilial($row->CdFilial);
				$info->setCdParcela($row->CdParcela);
				$info->setInProprioTerceiros($row->InProprioTerceiros);
				$results[] = $info;
			}
		}
		return $results;
	}

	public function ListaNFSe($cnpj,$fatura,$empresa) {

		$results = array();
		$stmt = $this->conn->prepare("

			SELECT
			C.NrNotaFiscal
			FROM [SOFTRAN_RASADOR].[dbo].[GFATITU] A
			LEFT JOIN [SOFTRAN_RASADOR].[dbo].[GTCFatNS] B ON A.NrFatura = B.CdFatura
			LEFT JOIN [SOFTRAN_RASADOR].[dbo].[SISNFs] C ON C.NrNotaFiscal = B.NrNotaFiscal AND A.CdInscricao = C.CdInscricao
			WHERE A.CdPlanoConta = '5100'
			and C.CdInscricao = ?
			and C.CdTributacao IN ('64','68','69')
			and B.CdFatura = ?
			and C.CdEmitente = ?

			");

		$stmt->bindValue(1, $cnpj, PDO::PARAM_STR);
		$stmt->bindValue(2, $fatura, PDO::PARAM_STR);
		$stmt->bindValue(3, $empresa, PDO::PARAM_STR);

		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new ConsultaFinanceiroModal();
				$info->setNrFatura($row->NrNotaFiscal);
				$results[] = $info;
			}
		}
		return $results;
	}

	public function BuscaAnoFatura($fatura,$empresa) {

		$results = array();
		$stmt = $this->conn->prepare("

			SELECT
				(YEAR(H.DtVencimento) % 100) as DtAnoFatura
			FROM GFATitu H
			LEFT JOIN SISPorta I ON I.CdPortador=H.CdPortador
			LEFT JOIN GTCFAT J ON J.CdInscricao = H.CdInscricao AND J.CdFatura = H.NrFatura AND J.CdEmpresa = H.CdFilial
			WHERE H.InSituacao IS NULL
			AND H.InPagarReceber = 1
			AND NrFatura = ?
			AND CdFilial = ?

			");

		$stmt->bindValue(1, $fatura, PDO::PARAM_STR);
		$stmt->bindValue(2, $empresa, PDO::PARAM_STR);

		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new ConsultaFinanceiroModal();
				$info->setDtAnoFatura($row->DtAnoFatura);
				$results[] = $info;
			}
		}
		return $results;
	}



}