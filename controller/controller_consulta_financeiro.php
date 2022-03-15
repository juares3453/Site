<?php

class ConsultaFinanceiroController{

	private $conn;

	public function __construct($connec) {
		$this->conn = $connec;
	}

	public function ListaFaturas($dias,$stFat,$cnpj) {
		$dao = new ConsultaFinanceiroDAO($this->conn);
		return $dao->ListaFaturas($dias,$stFat,$cnpj);
	}

	public function ListaNFSe($cnpj,$NrFatura,$CdEmpresa) {
		$dao = new ConsultaFinanceiroDAO($this->conn);
		return $dao->ListaNFSe($cnpj,$NrFatura,$CdEmpresa);
	}

	public function BuscaAnoFatura($NrFatura,$CdEmpresa) {
		$dao = new ConsultaFinanceiroDAO($this->conn);
		return $dao->BuscaAnoFatura($NrFatura,$CdEmpresa);
	}


	public function GeraDetalheFatura($CdTipo,$NrFatura,$CdPortador,$CdEmpresa,$CdInscricao,$CdParcela,$cont,$VlFrete,$DtVencimento) {
		if($VlFrete != 0){
			return "
			<form action='gera_detalhe' method='POST' accept-charset='utf-8' id='FormDetalheFatura$cont'>
			<input type='hidden' name='CdTipo' value='$CdTipo'>
			<input type='hidden' name='NrFatura' value='$NrFatura'>
			<input type='hidden' name='CdEmpresa' value='$CdEmpresa'>
			<input type='hidden' name='CdInscricao' value='$CdInscricao'>
			<input type='hidden' name='CdParcela' value='$CdParcela'>
			<td><a href='javascript:void(0)' class='fi-print size-14' id='EnviaDetalheFatura$cont'></a></td>
			</form>
			";
		} else {

			$diretorio = $this->DiretorioDetalhe($NrFatura,$CdEmpresa,$DtVencimento);

			if(isset($diretorio) && file_exists($diretorio)){
				return "<td><a href='precontroller_gera_detalhe?NrFatura=".$NrFatura."&CdEmpresa=".$CdEmpresa."&DtVencimento=".$DtVencimento."' class='fi-print size-14'></a></td>";
			} else {
				return "<td class='centro'><a style='pointer-events: none; cursor: default;' class='fi-print size-14' id='EnviaDetalheFatura$cont'></a></td>";
			}
		}
	}

	public function DiretorioNFSe($NFSe,$CdEmpresa){

		if($CdEmpresa == '1'){
			return "/nfserasador/NFSeBG/PDF/NFS-e".$NFSe.".pdf";
		}

		if($CdEmpresa == '4'){
			return "/nfserasador/NFSeSP/PDF/NFS-e".$NFSe.".pdf";
		}

		if($CdEmpresa == '3'){
			return "/nfserasador/NFSeCB/PDF/NFS-e".$NFSe.".pdf";
		}
	}

	public function GeraNFSe($Cnpj,$NrFatura,$CdEmpresa){

		foreach ($this->ListaNFSe($Cnpj, $NrFatura, $CdEmpresa) as $dadosNFSe){
			$NFSe = $dadosNFSe->getNrFatura();
		}

		if(isset($NFSe)){

			$diretorio = $this->DiretorioNFSe($NFSe,$CdEmpresa);

			if(isset($diretorio) && file_exists($diretorio)){
				return "<td><a href='precontroller_gera_nfse?NFSe=".$NFSe."&Empresa=".$CdEmpresa."' class='fi-print size-14'></a></td>";
			} else {
				return "<td><a style='pointer-events: none; cursor: default;' class='fi-print size-14'></a></td>";
			}

		} else {
			return "<td><a style='pointer-events: none; cursor: default;' class='fi-print size-14'></a></td>";
		}

	}

	public function DiretorioBoleto($NrFatura,$CdEmpresa){

		$AnoAtual = date('y');

		$NrFatura = str_pad($NrFatura , 6 , '0' , STR_PAD_LEFT);

		if($CdEmpresa == '1'){

			$diretorio = "/prod/filiais/BG/mail/FAT00".$CdEmpresa.$NrFatura.$AnoAtual."CTE.pdf";

			if(isset($diretorio) && file_exists($diretorio)){
				return $diretorio;
			} else if(isset($diretorio) && !file_exists($diretorio)){
				return "/prod/filiais/BG/mail/FAT00".$CdEmpresa.$NrFatura.$AnoAtual.".pdf";
			}

		} else if($CdEmpresa = '4'){

			$diretorio = "/prod/filiais/BA/mail/FAT00".$CdEmpresa.$NrFatura.$AnoAtual."CTE.pdf";

			if(isset($diretorio) && file_exists($diretorio)){
				return $diretorio;
			} else if(isset($diretorio) && !file_exists($diretorio)){
				return "/prod/filiais/BA/mail/FAT00".$CdEmpresa.$NrFatura.$AnoAtual.".pdf";
			}

		} else if ($CdEmpresa = '3'){

			$diretorio = "/prod/filiais/CB/mail/FAT00".$CdEmpresa.$NrFatura.$AnoAtual."CTE.pdf";

			if(isset($diretorio) && file_exists($diretorio)){
				return $diretorio;
			} else if(isset($diretorio) && !file_exists($diretorio)){
				return "/prod/filiais/CB/mail/FAT00".$CdEmpresa.$NrFatura.$AnoAtual.".pdf";
			}

		}

	}

	public function DiretorioDetalhe($NrFatura,$CdEmpresa,$DtVencimento){

		$AnoAtual = date('y', strtotime($DtVencimento));

		//$AnoAtual = date('y');

		$NrFatura = str_pad($NrFatura , 6 , '0' , STR_PAD_LEFT);

		if($CdEmpresa == '1'){

			$diretorio = "/prod/filiais/BG/detalhe/FAT00".$CdEmpresa.$NrFatura.$AnoAtual.".xlsx";

			if(isset($diretorio) && file_exists($diretorio)){
				return $diretorio;
			}

		} else if($CdEmpresa = '4'){

			$diretorio = "/prod/filiais/BA/detalhe/FAT00".$CdEmpresa.$NrFatura.$AnoAtual.".xlsx";

			if(isset($diretorio) && file_exists($diretorio)){
				return $diretorio;
			}

		} else if ($CdEmpresa = '3'){

			$diretorio = "/prod/filiais/CB/detalhe/FAT00".$CdEmpresa.$NrFatura.$AnoAtual.".xlsx";

			if(isset($diretorio) && file_exists($diretorio)){
				return $diretorio;
			}

		}

	}

	public function GeraBoleto($NrFatura,$CdEmpresa) {

		$diretorio = $this->DiretorioBoleto($NrFatura,$CdEmpresa);

		if(isset($diretorio) && file_exists($diretorio)){
			return "<td><a href='precontroller_gera_boleto?NrFatura=".$NrFatura."&CdEmpresa=".$CdEmpresa."' class='fi-print size-14'></a></td>";
		} else {
			return "<td><a style='pointer-events: none; cursor: default;' class='fi-print size-14'></a></td>";
		}

	}

	public function ValidaVencimento($DtVencimento,$VlSaldo){
		$data1 = $DtVencimento;
		$data2 = date('Y-m-d');

		if(strtotime($data1) < strtotime($data2) && $VlSaldo > 0){
			return "class='red'";
		} else if($VlSaldo == 0) {
			return "class='green'";
		}
	}

}