<?php 

class ArquivoDAO {

	private $conn;

	public function __construct($connection) {
		$this->conn = $connection;
	}

	public function ListaArquivos($DtIni, $DtFim, $NrFatura, $NrCTe, $NrNF, $CdInscricao){
		$results = array();
		$stmt = $this->conn->prepare('EXEC sp_ListaXMLePDFdoCTe :DtIni, :DtFim, :NrFatura, :NrCTe, :NrNF, :CdInscricao');
		$stmt->bindValue(':DtIni', $DtIni, PDO::PARAM_STR);
		$stmt->bindValue(':DtFim', $DtFim, PDO::PARAM_INT);
		$stmt->bindValue(':NrFatura', $NrFatura, PDO::PARAM_STR);
		$stmt->bindValue(':NrCTe', $NrCTe, PDO::PARAM_STR);
		$stmt->bindValue(':NrNF', $NrNF, PDO::PARAM_STR);
		$stmt->bindValue(':CdInscricao', $CdInscricao, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
				$info = new ArquivoModal();
				$info->setRemetente($row->Remetente);
				$info->setDestinatario($row->Destinatario);
				$info->setConhecimento($row->Conhecimento);
				$info->setDtEmissao(date('d/m/Y', strtotime($row->DtEmissao)));
				$info->setXML($row->XML);
				$info->setPDF($row->PDF);
				$results[] = $info;
			}
		}
		return $results;
	}

}