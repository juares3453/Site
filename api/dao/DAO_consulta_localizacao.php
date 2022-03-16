<?php

class ConsultaLocalizacaoDAO {

	private $conn;

	public function __construct($connection) {
		$this->conn = $connection;
	}

	public function ListaDadosNotaFiscal($tpCnpj,$NrNotaFiscal,$Cnpj) {
		$results = array();
		$stmt = $this->conn->prepare("EXECUTE sp_HistEntregaWeb ?, ?, ?");
		$stmt->bindValue(1, $tpCnpj, PDO::PARAM_STR);
		$stmt->bindValue(2, $NrNotaFiscal, PDO::PARAM_STR);
		$stmt->bindValue(3, $Cnpj, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new ConsultaLocalizacaoModal();
				$info->setCTe($row->CTe);
				$info->setDtEmissao(date('d/m/Y', strtotime($row->DtEmissao)));
				$info->setCliente($row->Cliente);
				$info->setCdRemetente($row->CdRemetente);
				$info->setRemetente($row->Remetente);
				$info->setDestinatario($row->Destinatario);
				$info->setDsSituacaoCarga($row->DsSituacaoCarga);
				$info->setNrSeqControle($row->NrSeqControle);
				$info->setNotaFiscal($row->NotaFiscal);
				$info->setDtSaidaOr(date('d/m/Y', strtotime($row->DtSaidaOr)));
				$info->setDtPrevEntrega(date('d/m/Y', strtotime($row->DtPrevEntrega)));
				$info->setDtSaidaEnt(date('d/m/Y', strtotime($row->DtSaidaEnt)));
				$info->setDtChegada(date('d/m/Y', strtotime($row->DtChegada)));
				$info->setDtArmazenada(date('d/m/Y', strtotime($row->DtArmazenada)));
				$info->setDtAgendamento(date('d/m/Y', strtotime($row->DtAgendamento)));
				$info->setDtEntrega(date('d/m/Y', strtotime($row->DtEntrega)));
				$results[] = $info;
			}
		}
		return $results;
	}

	public function ListaHistorico($Cnpj,$NrNotaFiscal) {
		$results = array();
		$stmt = $this->conn->prepare("EXECUTE sp_ListaHistEntregaWeb ?, ?");
		$stmt->bindValue(1, $NrNotaFiscal, PDO::PARAM_STR);
		$stmt->bindValue(2, $Cnpj, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new ConsultaLocalizacaoModal();
				$info->setHistorico($row->HISTORICO);
				$info->setData(date('d/m/Y', strtotime($row->DATA)));
				$results[] = $info;
			}
		}
		return $results;
	}

}