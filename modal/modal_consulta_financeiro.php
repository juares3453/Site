<?php


class ConsultaFinanceiroModal{

	private $CdPortador;
	private $DsPortador;
	private $CdTitulo;
	private $DsSituacao;
	private $DtEmissao;
	private $DtVencimento;
	private $VlLiquidoOriginal;
	private $VlSaldo;
	private $FgSituacao;
	private $NrFatura;
	private $CdFilial;
	private $CdParcela;
    private $InProprioTerceiros;
    private $DtAnoFatura;

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
    public function getDsPortador()
    {
    	return $this->DsPortador;
    }

    /**
     * @param mixed $DsPortador
     *
     * @return self
     */
    public function setDsPortador($DsPortador)
    {
    	$this->DsPortador = $DsPortador;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getCdTitulo()
    {
    	return $this->CdTitulo;
    }

    /**
     * @param mixed $CdTitulo
     *
     * @return self
     */
    public function setCdTitulo($CdTitulo)
    {
    	$this->CdTitulo = $CdTitulo;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getDsSituacao()
    {
    	return $this->DsSituacao;
    }

    /**
     * @param mixed $DsSituacao
     *
     * @return self
     */
    public function setDsSituacao($DsSituacao)
    {
    	$this->DsSituacao = $DsSituacao;

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
    public function getVlLiquidoOriginal()
    {
    	return $this->VlLiquidoOriginal;
    }

    /**
     * @param mixed $VlLiquidoOriginal
     *
     * @return self
     */
    public function setVlLiquidoOriginal($VlLiquidoOriginal)
    {
    	$this->VlLiquidoOriginal = $VlLiquidoOriginal;

    	return $this;
    }

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
    public function getFgSituacao()
    {
    	return $this->FgSituacao;
    }

    /**
     * @param mixed $FgSituacao
     *
     * @return self
     */
    public function setFgSituacao($FgSituacao)
    {
    	$this->FgSituacao = $FgSituacao;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getNrFatura()
    {
    	return $this->NrFatura;
    }

    /**
     * @param mixed $NrFatura
     *
     * @return self
     */
    public function setNrFatura($NrFatura)
    {
    	$this->NrFatura = $NrFatura;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getCdFilial()
    {
    	return $this->CdFilial;
    }

    /**
     * @param mixed $CdFilial
     *
     * @return self
     */
    public function setCdFilial($CdFilial)
    {
    	$this->CdFilial = $CdFilial;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getCdParcela()
    {
    	return $this->CdParcela;
    }

    /**
     * @param mixed $CdParcela
     *
     * @return self
     */
    public function setCdParcela($CdParcela)
    {
    	$this->CdParcela = $CdParcela;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getInProprioTerceiros()
    {
        return $this->InProprioTerceiros;
    }

    /**
     * @param mixed $InProprioTerceiros
     *
     * @return self
     */
    public function setInProprioTerceiros($InProprioTerceiros)
    {
        $this->InProprioTerceiros = $InProprioTerceiros;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtAnoFatura()
    {
        return $this->DtAnoFatura;
    }

    /**
     * @param mixed $DtAnoFatura
     *
     * @return self
     */
    public function setDtAnoFatura($DtAnoFatura)
    {
        $this->DtAnoFatura = $DtAnoFatura;

        return $this;
    }
}