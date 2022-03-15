<?php 

class Modal  {

	private $VlSaldo;
	private $CdPortador;
	private $CdFatura;
	private $NrNFSe;
	private $VlTtlFatura;
	private $DtFatura;
	private $DtVencimento;
	private $CNPJCliente;
	private $Cliente;
	private $Remetente;
	private $Destinatario;
	private $CdDocumento;
	private $EmpDocumento;
	private $DtDocumento;
	private $VlPedagio;
	private $VlSeguro;
	private $FPeso;
	private $FValor;
	private $VlTaxa;
	private $VlArmazenagem;
	private $VlTRT;
	private $VlFrete;
	private $VlMercadoria;
	private $QtPeso;
	private $QtVolume;
	private $NrNotaFiscal;
	private $QtPesoNF;
	private $DtEmissaoNF;
	private $VlNF;
	private $QtVolNF;
	private $DsMarca;

    private $PesoNota;
    private $DtEmissaoNota;
    private $VlMercadoriaNota;
    private $VlrNota;
    private $VolumeNota;

    /**
     * @return mixed
     */
    public function getVlSaldo()
    {
        return $this->VlSaldo;
    }

    /**
     * @param mixed $VlSaldo
     *
     * @return self
     */
    public function setVlSaldo($VlSaldo)
    {
        $this->VlSaldo = $VlSaldo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCdPortador()
    {
        return $this->CdPortador;
    }

    /**
     * @param mixed $CdPortador
     *
     * @return self
     */
    public function setCdPortador($CdPortador)
    {
        $this->CdPortador = $CdPortador;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCdFatura()
    {
        return $this->CdFatura;
    }

    /**
     * @param mixed $CdFatura
     *
     * @return self
     */
    public function setCdFatura($CdFatura)
    {
        $this->CdFatura = $CdFatura;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrNFSe()
    {
        return $this->NrNFSe;
    }

    /**
     * @param mixed $NrNFSe
     *
     * @return self
     */
    public function setNrNFSe($NrNFSe)
    {
        $this->NrNFSe = $NrNFSe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVlTtlFatura()
    {
        return $this->VlTtlFatura;
    }

    /**
     * @param mixed $VlTtlFatura
     *
     * @return self
     */
    public function setVlTtlFatura($VlTtlFatura)
    {
        $this->VlTtlFatura = $VlTtlFatura;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtFatura()
    {
        return $this->DtFatura;
    }

    /**
     * @param mixed $DtFatura
     *
     * @return self
     */
    public function setDtFatura($DtFatura)
    {
        $this->DtFatura = $DtFatura;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtVencimento()
    {
        return $this->DtVencimento;
    }

    /**
     * @param mixed $DtVencimento
     *
     * @return self
     */
    public function setDtVencimento($DtVencimento)
    {
        $this->DtVencimento = $DtVencimento;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCNPJCliente()
    {
        return $this->CNPJCliente;
    }

    /**
     * @param mixed $CNPJCliente
     *
     * @return self
     */
    public function setCNPJCliente($CNPJCliente)
    {
        $this->CNPJCliente = $CNPJCliente;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->Cliente;
    }

    /**
     * @param mixed $Cliente
     *
     * @return self
     */
    public function setCliente($Cliente)
    {
        $this->Cliente = $Cliente;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRemetente()
    {
        return $this->Remetente;
    }

    /**
     * @param mixed $Remetente
     *
     * @return self
     */
    public function setRemetente($Remetente)
    {
        $this->Remetente = $Remetente;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDestinatario()
    {
        return $this->Destinatario;
    }

    /**
     * @param mixed $Destinatario
     *
     * @return self
     */
    public function setDestinatario($Destinatario)
    {
        $this->Destinatario = $Destinatario;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCdDocumento()
    {
        return $this->CdDocumento;
    }

    /**
     * @param mixed $CdDocumento
     *
     * @return self
     */
    public function setCdDocumento($CdDocumento)
    {
        $this->CdDocumento = $CdDocumento;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmpDocumento()
    {
        return $this->EmpDocumento;
    }

    /**
     * @param mixed $EmpDocumento
     *
     * @return self
     */
    public function setEmpDocumento($EmpDocumento)
    {
        $this->EmpDocumento = $EmpDocumento;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtDocumento()
    {
        return $this->DtDocumento;
    }

    /**
     * @param mixed $DtDocumento
     *
     * @return self
     */
    public function setDtDocumento($DtDocumento)
    {
        $this->DtDocumento = $DtDocumento;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVlPedagio()
    {
        return $this->VlPedagio;
    }

    /**
     * @param mixed $VlPedagio
     *
     * @return self
     */
    public function setVlPedagio($VlPedagio)
    {
        $this->VlPedagio = $VlPedagio;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVlSeguro()
    {
        return $this->VlSeguro;
    }

    /**
     * @param mixed $VlSeguro
     *
     * @return self
     */
    public function setVlSeguro($VlSeguro)
    {
        $this->VlSeguro = $VlSeguro;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFPeso()
    {
        return $this->FPeso;
    }

    /**
     * @param mixed $FPeso
     *
     * @return self
     */
    public function setFPeso($FPeso)
    {
        $this->FPeso = $FPeso;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFValor()
    {
        return $this->FValor;
    }

    /**
     * @param mixed $FValor
     *
     * @return self
     */
    public function setFValor($FValor)
    {
        $this->FValor = $FValor;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVlTaxa()
    {
        return $this->VlTaxa;
    }

    /**
     * @param mixed $VlTaxa
     *
     * @return self
     */
    public function setVlTaxa($VlTaxa)
    {
        $this->VlTaxa = $VlTaxa;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVlArmazenagem()
    {
        return $this->VlArmazenagem;
    }

    /**
     * @param mixed $VlArmazenagem
     *
     * @return self
     */
    public function setVlArmazenagem($VlArmazenagem)
    {
        $this->VlArmazenagem = $VlArmazenagem;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVlTRT()
    {
        return $this->VlTRT;
    }

    /**
     * @param mixed $VlTRT
     *
     * @return self
     */
    public function setVlTRT($VlTRT)
    {
        $this->VlTRT = $VlTRT;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVlFrete()
    {
        return $this->VlFrete;
    }

    /**
     * @param mixed $VlFrete
     *
     * @return self
     */
    public function setVlFrete($VlFrete)
    {
        $this->VlFrete = $VlFrete;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVlMercadoria()
    {
        return $this->VlMercadoria;
    }

    /**
     * @param mixed $VlMercadoria
     *
     * @return self
     */
    public function setVlMercadoria($VlMercadoria)
    {
        $this->VlMercadoria = $VlMercadoria;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQtPeso()
    {
        return $this->QtPeso;
    }

    /**
     * @param mixed $QtPeso
     *
     * @return self
     */
    public function setQtPeso($QtPeso)
    {
        $this->QtPeso = $QtPeso;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQtVolume()
    {
        return $this->QtVolume;
    }

    /**
     * @param mixed $QtVolume
     *
     * @return self
     */
    public function setQtVolume($QtVolume)
    {
        $this->QtVolume = $QtVolume;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrNotaFiscal()
    {
        return $this->NrNotaFiscal;
    }

    /**
     * @param mixed $NrNotaFiscal
     *
     * @return self
     */
    public function setNrNotaFiscal($NrNotaFiscal)
    {
        $this->NrNotaFiscal = $NrNotaFiscal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQtPesoNF()
    {
        return $this->QtPesoNF;
    }

    /**
     * @param mixed $QtPesoNF
     *
     * @return self
     */
    public function setQtPesoNF($QtPesoNF)
    {
        $this->QtPesoNF = $QtPesoNF;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtEmissaoNF()
    {
        return $this->DtEmissaoNF;
    }

    /**
     * @param mixed $DtEmissaoNF
     *
     * @return self
     */
    public function setDtEmissaoNF($DtEmissaoNF)
    {
        $this->DtEmissaoNF = $DtEmissaoNF;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVlNF()
    {
        return $this->VlNF;
    }

    /**
     * @param mixed $VlNF
     *
     * @return self
     */
    public function setVlNF($VlNF)
    {
        $this->VlNF = $VlNF;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQtVolNF()
    {
        return $this->QtVolNF;
    }

    /**
     * @param mixed $QtVolNF
     *
     * @return self
     */
    public function setQtVolNF($QtVolNF)
    {
        $this->QtVolNF = $QtVolNF;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsMarca()
    {
        return $this->DsMarca;
    }

    /**
     * @param mixed $DsMarca
     *
     * @return self
     */
    public function setDsMarca($DsMarca)
    {
        $this->DsMarca = $DsMarca;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPesoNota()
    {
        return $this->PesoNota;
    }

    /**
     * @param mixed $PesoNota
     *
     * @return self
     */
    public function setPesoNota($PesoNota)
    {
        $this->PesoNota = $PesoNota;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtEmissaoNota()
    {
        return $this->DtEmissaoNota;
    }

    /**
     * @param mixed $DtEmissaoNota
     *
     * @return self
     */
    public function setDtEmissaoNota($DtEmissaoNota)
    {
        $this->DtEmissaoNota = $DtEmissaoNota;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVlMercadoriaNota()
    {
        return $this->VlMercadoriaNota;
    }

    /**
     * @param mixed $VlMercadoriaNota
     *
     * @return self
     */
    public function setVlMercadoriaNota($VlMercadoriaNota)
    {
        $this->VlMercadoriaNota = $VlMercadoriaNota;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVlrNota()
    {
        return $this->VlrNota;
    }

    /**
     * @param mixed $VlrNota
     *
     * @return self
     */
    public function setVlrNota($VlrNota)
    {
        $this->VlrNota = $VlrNota;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVolumeNota()
    {
        return $this->VolumeNota;
    }

    /**
     * @param mixed $VolumeNota
     *
     * @return self
     */
    public function setVolumeNota($VolumeNota)
    {
        $this->VolumeNota = $VolumeNota;

        return $this;
    }
}