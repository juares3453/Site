<?php

class Dao {

	private $conn;

	public function __construct($connection) {
		$this->conn = $connection;
	}

	public function ListaDetalheFatura($CdTipo,$NrFatura,$CdEmpresa,$CdParcela,$CdInscricao) {
		$results = array();
		$stmt = $this->conn->prepare("EXEC sp_DetalhaFaturaRec :CdTipo , :NrFatura , :CdEmpresa , :CdParcela , :CdInscricao");
		$stmt->bindValue(':CdTipo', $CdTipo, PDO::PARAM_INT);
		$stmt->bindValue(':NrFatura', $NrFatura, PDO::PARAM_INT);
		$stmt->bindValue(':CdEmpresa', $CdEmpresa, PDO::PARAM_INT);
		$stmt->bindValue(':CdParcela', $CdParcela, PDO::PARAM_STR);
		$stmt->bindValue(':CdInscricao', $CdInscricao, PDO::PARAM_INT);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new Modal();
				$info->setVlSaldo($row->VlSaldo);
				$info->setCdPortador($row->CdPortador);
				$info->setCdFatura($row->CdFatura);
				$info->setNrNFSe($row->NrNFSe);
				$info->setVlTtlFatura($row->VlTtlFatura);
				$info->setDtFatura(date('d/m/Y', strtotime($row->DtFatura)));
				$info->setDtVencimento(date('d/m/Y', strtotime($row->DtVencimento)));
				$info->setCNPJCliente($row->CNPJCliente);
				$info->setCliente($row->Cliente);
				$info->setRemetente($row->Remetente);
				$info->setDestinatario($row->Destinatario);
				$info->setCdDocumento($row->CdDocumento);
				$info->setEmpDocumento($row->EmpDocumento);
				$info->setDtDocumento(date('d/m/Y', strtotime($row->DtDocumento)));
				$info->setVlPedagio($row->VlPedagio);
				$info->setVlSeguro($row->VlSeguro);
				$info->setFPeso($row->FPeso);
				$info->setFValor($row->FValor);
				$info->setVlTaxa($row->VlTaxa);
				$info->setVlArmazenagem($row->VlArmazenagem);
				$info->setVlTRT($row->VlTRT);
				$info->setVlFrete($row->VlFrete);
				$info->setVlMercadoria($row->VlMercadoria);
				$info->setQtPeso($row->QtPeso);
				$info->setQtVolume($row->QtVolume);
				$info->setNrNotaFiscal($row->NrNotaFiscal);
				$info->setQtPesoNF($row->QtPesoNF);
				$info->setDtEmissaoNF(date('d/m/Y', strtotime($row->DtEmissaoNF)));
				$info->setVlNF($row->VlNF);
				$info->setQtVolNF($row->QtVolNF);
				$info->setDsMarca($row->DsMarca);
				$results[] = $info;
			}
		}
		return $results;
	}

	public function ListaNF($NrDocumento,$CdTipo,$NrFatura,$CdEmpresa,$CdParcela,$CdInscricao) {
		$results = array();
		$stmt = $this->conn->prepare("EXEC sp_DetalhaFaturaRec_doc :NrDocumento , :CdTipo , :NrFatura , :CdEmpresa , :CdParcela , :CdInscricao");
		$stmt->bindValue(':NrDocumento', $NrDocumento, PDO::PARAM_INT);
		$stmt->bindValue(':CdTipo', $CdTipo, PDO::PARAM_INT);
		$stmt->bindValue(':NrFatura', $NrFatura, PDO::PARAM_INT);
		$stmt->bindValue(':CdEmpresa', $CdEmpresa, PDO::PARAM_INT);
		$stmt->bindValue(':CdParcela', $CdParcela, PDO::PARAM_STR);
		$stmt->bindValue(':CdInscricao', $CdInscricao, PDO::PARAM_INT);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$info = new Modal();
				$info->setNrNotaFiscal($row->NrNotaFiscal);
				$info->setDtEmissaoNF(date('d/m/Y', strtotime($row->DtEmissaoNF)));
				$info->setDsMarca($row->DsMarca);
				$info->setQtPesoNF($row->QtPesoNF);
				$info->setQtVolNF($row->QtVolNF);
				$info->setVlNF($row->VlNF);
				$results[] = $info;
			}
		}
		return $results;
	}


}

?>