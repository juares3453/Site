<?php

class ConsultaAgendamentoDAO {

	private $conn;

	public function __construct($connection) {
		$this->conn = $connection;
	}

	public function ListaAgendamentos($cnpj,$dtInicial,$dtFinal) {
		$results = array();
		$stmt = $this->conn->prepare('

		SET NOCOUNT ON

		DECLARE
			@DATAI DATE,
			@DATAF DATE,
			@CNPJ VARCHAR(14)

		SELECT
			@CNPJ = ?,
			@DATAI = ?,
			@DATAF = ?

		SELECT
			 cast(substring(B.NrChaveAcessoNFe,26,9) as Int) AS NrNotaFiscal
			,B.NrNotaFiscalAgend
			,E.DsMarca
			,cast(B.DtEntregaProgramada as date) as [DtEntregaAgendada]
			,B.DtAgendamento as [DtAgendamento]
			,B.DsEntidadeAgend AS [DsDestinatario]
			,B.CdDestinatarioAgend as [CdDestinatario]
			,B.DsEnderecoAgend + B.DsNumAgend as [DsLocalEntrega]
			,B.DsComplementoAgend
			,D.DsBairro
			,D.DsLocal
			,D.DsUF
			,B.NrCepEntregaAgend AS [NrCepEntrega]
			,B.NrTelefoneAgend AS [NrTelefone]
			,cast(B.DsComentarioAgend as varchar (200)) AS [DsObservacao]
		FROM [Portal].[dbo].[XEDINFSIT] B
				LEFT JOIN SISCep D ON D.NrCep=B.NrCepEntregaAgend
				LEFT JOIN GTCNF E ON E.NrNotaFiscal = B.NrNotaFiscalAgend AND E.CdRemetente = B.CdRemetente AND E.NrSerie = B.NrSerieNFAgend
		WHERE B.CdDestinatario = @CNPJ
		AND B.DtAgendamento between @DATAI and @DATAF
		AND B.InSituacao is null

		UNION

		SELECT
			 B.NrNotaFiscal as [NrNotaFiscal]
			,B.NrNotaFiscal as [NrNotaFiscalAgend]
			,E.DsMarca
			,cast(B.DtEntregaProgramada AS DATE) as [DtEntregaAgendada]
			,A.DtGeracaoArquivo as [DtAgendamento]
			,C.DsEntidade AS [DsDestinatario]
			,C.CdInscricao as [CdDestinatario]
			,B.DsLocalEntrega
			,C.DsComplemento as [DsComplementoAgend]
			,D.DsBairro
			,D.DsLocal
			,D.DsUF
			,B.NrCepEntrega
			,C.NrTelefone
			,cast(B.DsObservacao as varchar (200))
		FROM EDINFS A
					LEFT JOIN EDINFSIT B ON A.CdLote=B.CdLote
					LEFT JOIN SISCli C ON B.CdDestinatario=C.CdInscricao
					LEFT JOIN SISCep D ON D.NrCep=B.NrCepEntrega
					LEFT JOIN GTCNF E ON E.NrNotaFiscal = B.NrNotaFiscal AND E.CdRemetente = B.CdRemetente AND E.NrSerie = B.NrSerieNF
		WHERE A.Dsusuario= ?
		AND A.CdInscricao= @CNPJ
		AND A.DtGeracaoArquivo between @DATAI and @DATAF
		AND NOT EXISTS ( SELECT 1 FROM [Portal].[dbo].[XEDINFSIT] X
						 WHERE X.CdDestinatario = @CNPJ
						 AND X.NrNotaFiscalAgend = B.NrNotaFiscal
				 AND X.DtAgendamento between @DATAI and @DATAF)

			');
		$stmt->bindValue(1, $cnpj, PDO::PARAM_STR);
		$stmt->bindValue(2, $dtInicial, PDO::PARAM_STR);
		$stmt->bindValue(3, date('Y-m-d', strtotime($dtFinal . ' +1 day')), PDO::PARAM_STR);
		$stmt->bindValue(4, 'web', PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new ConsultaAgendamentoModal();
				$info->setNrNotaFiscal($row->NrNotaFiscal);
				$info->setNrNotaFiscalAgend($row->NrNotaFiscalAgend);
				$info->setDsMarca($row->DsMarca);
				$info->setDtEntregaAgendada($row->DtEntregaAgendada);
				$info->setDtAgendamento($row->DtAgendamento);
				$info->setDsDestinatario($row->DsDestinatario);
				$info->setCdDestinatario($row->CdDestinatario);
				$info->setDsLocalEntrega($row->DsLocalEntrega);
				$info->setDsComplemento($row->DsComplementoAgend);
				$info->setDsBairro($row->DsBairro);
				$info->setDsLocal($row->DsLocal);
				$info->setDsUF($row->DsUF);
				$info->setNrCepEntrega($row->NrCepEntrega);
				$info->setNrTelefone($row->NrTelefone);
				$info->setDsObservacao($row->DsObservacao);
				$results[] = $info;
			}
		}
		return $results;
	}


}