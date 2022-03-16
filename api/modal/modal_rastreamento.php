<?php


class RastreamentoModal{

	private $CdRemetente;
	private $Remetente;
	private $CidadeRem;
	private $NotaFiscal;
	private $CTe;
	private $Pedido;
	private $OC;
	private $CdDestinatario;
	private $Destinatario;
	private $CidadeDest;
	private $DtEmissao;
    private $DtEntregaProgramada;
    private $DtEntrega;
    private $VlrNota;
    private $PesoNota;
    private $VolumeNota;
    private $Frete;
    private $DsSituacaoCarga;

    private $DtInicial;
    private $DtFinal;
    private $NrNFe;
    private $StNFe;
    private $StCte;
    private $UsuarioCdInscricao;
    private $ID;
    private $DtPrevEntrega;
    

    /**
     * @return mixed
     */
    public function getCdRemetente()
    {
        return $this->CdRemetente;
    }

    /**
     * @param mixed $CdRemetente
     *
     * @return self
     */
    public function setCdRemetente($CdRemetente)
    {
        $this->CdRemetente = $CdRemetente;

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
    public function getCidadeRem()
    {
        return $this->CidadeRem;
    }

    /**
     * @param mixed $CidadeRem
     *
     * @return self
     */
    public function setCidadeRem($CidadeRem)
    {
        $this->CidadeRem = $CidadeRem;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotaFiscal()
    {
        return $this->NotaFiscal;
    }

    /**
     * @param mixed $NotaFiscal
     *
     * @return self
     */
    public function setNotaFiscal($NotaFiscal)
    {
        $this->NotaFiscal = $NotaFiscal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCTe()
    {
        return $this->CTe;
    }

    /**
     * @param mixed $CTe
     *
     * @return self
     */
    public function setCTe($CTe)
    {
        $this->CTe = $CTe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPedido()
    {
        return $this->Pedido;
    }

    /**
     * @param mixed $Pedido
     *
     * @return self
     */
    public function setPedido($Pedido)
    {
        $this->Pedido = $Pedido;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOC()
    {
        return $this->OC;
    }

    /**
     * @param mixed $OC
     *
     * @return self
     */
    public function setOC($OC)
    {
        $this->OC = $OC;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCdDestinatario()
    {
        return $this->CdDestinatario;
    }

    /**
     * @param mixed $CdDestinatario
     *
     * @return self
     */
    public function setCdDestinatario($CdDestinatario)
    {
        $this->CdDestinatario = $CdDestinatario;

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
    public function getCidadeDest()
    {
        return $this->CidadeDest;
    }

    /**
     * @param mixed $CidadeDest
     *
     * @return self
     */
    public function setCidadeDest($CidadeDest)
    {
        $this->CidadeDest = $CidadeDest;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtEmissao()
    {
        return $this->DtEmissao;
    }

    /**
     * @param mixed $DtEmissao
     *
     * @return self
     */
    public function setDtEmissao($DtEmissao)
    {
        $this->DtEmissao = $DtEmissao;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtEntregaProgramada()
    {
        return $this->DtEntregaProgramada;
    }

    /**
     * @param mixed $DtEntregaProgramada
     *
     * @return self
     */
    public function setDtEntregaProgramada($DtEntregaProgramada)
    {
        $this->DtEntregaProgramada = $DtEntregaProgramada;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtEntrega()
    {
        return $this->DtEntrega;
    }

    /**
     * @param mixed $DtEntrega
     *
     * @return self
     */
    public function setDtEntrega($DtEntrega)
    {
        $this->DtEntrega = $DtEntrega;

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

    /**
     * @return mixed
     */
    public function getFrete()
    {
        return $this->Frete;
    }

    /**
     * @param mixed $Frete
     *
     * @return self
     */
    public function setFrete($Frete)
    {
        $this->Frete = $Frete;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsSituacaoCarga()
    {
        return $this->DsSituacaoCarga;
    }

    /**
     * @param mixed $DsSituacaoCarga
     *
     * @return self
     */
    public function setDsSituacaoCarga($DsSituacaoCarga)
    {
        $this->DsSituacaoCarga = $DsSituacaoCarga;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtInicial()
    {
        return $this->DtInicial;
    }

    /**
     * @param mixed $DtInicial
     *
     * @return self
     */
    public function setDtInicial($DtInicial)
    {
        $this->DtInicial = $DtInicial;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtFinal()
    {
        return $this->DtFinal;
    }

    /**
     * @param mixed $DtFinal
     *
     * @return self
     */
    public function setDtFinal($DtFinal)
    {
        $this->DtFinal = $DtFinal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrNFe()
    {
        return $this->NrNFe;
    }

    /**
     * @param mixed $NrNFe
     *
     * @return self
     */
    public function setNrNFe($NrNFe)
    {
        $this->NrNFe = $NrNFe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsuarioCdInscricao()
    {
        return $this->UsuarioCdInscricao;
    }

    /**
     * @param mixed $UsuarioCdInscricao
     *
     * @return self
     */
    public function setUsuarioCdInscricao($UsuarioCdInscricao)
    {
        $this->UsuarioCdInscricao = $UsuarioCdInscricao;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStNFe()
    {
        return $this->StNFe;
    }

    /**
     * @param mixed $StNFe
     *
     * @return self
     */
    public function setStNFe($StNFe)
    {
        $this->StNFe = $StNFe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStCte()
    {
        return $this->StCte;
    }

    /**
     * @param mixed $StCte
     *
     * @return self
     */
    public function setStCte($StCte)
    {
        $this->StCte = $StCte;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     *
     * @return self
     */
    public function setID($ID)
    {
        $this->ID = $ID;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtPrevEntrega()
    {
        return $this->DtPrevEntrega;
    }

    /**
     * @param mixed $DtPrevEntrega
     *
     * @return self
     */
    public function setDtPrevEntrega($DtPrevEntrega)
    {
        $this->DtPrevEntrega = $DtPrevEntrega;

        return $this;
    }
}