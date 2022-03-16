<?php

class ConsultaAgendamentoModal{

	private $NrNotaFiscal;
	private $DtEntregaAgendada;
	private $DtAgendamento;
	private $DsDestinatario;
	private $CdDestinatario;
	private $DsLocalEntrega;
	private $DsComplemento;
	private $DsBairro;
	private $DsLocal;
	private $DsUF;
	private $NrCepEntrega;
	private $NrTelefone;
	private $DsObservacao;
    private $NrNotaFiscalAgend;
    private $DsMarca;

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
    public function getDtEntregaAgendada()
    {
    	return $this->DtEntregaAgendada;
    }

    /**
     * @param mixed $DtEntregaAgendada
     *
     * @return self
     */
    public function setDtEntregaAgendada($DtEntregaAgendada)
    {
    	$this->DtEntregaAgendada = $DtEntregaAgendada;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getDtAgendamento()
    {
    	return $this->DtAgendamento;
    }

    /**
     * @param mixed $DtAgendamento
     *
     * @return self
     */
    public function setDtAgendamento($DtAgendamento)
    {
    	$this->DtAgendamento = $DtAgendamento;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getDsDestinatario()
    {
    	return $this->DsDestinatario;
    }

    /**
     * @param mixed $DsDestinatario
     *
     * @return self
     */
    public function setDsDestinatario($DsDestinatario)
    {
    	$this->DsDestinatario = $DsDestinatario;

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
    public function getDsLocalEntrega()
    {
    	return $this->DsLocalEntrega;
    }

    /**
     * @param mixed $DsLocalEntrega
     *
     * @return self
     */
    public function setDsLocalEntrega($DsLocalEntrega)
    {
    	$this->DsLocalEntrega = $DsLocalEntrega;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getDsComplemento()
    {
    	return $this->DsComplemento;
    }

    /**
     * @param mixed $DsComplemento
     *
     * @return self
     */
    public function setDsComplemento($DsComplemento)
    {
    	$this->DsComplemento = $DsComplemento;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getDsBairro()
    {
    	return $this->DsBairro;
    }

    /**
     * @param mixed $DsBairro
     *
     * @return self
     */
    public function setDsBairro($DsBairro)
    {
    	$this->DsBairro = $DsBairro;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getDsLocal()
    {
    	return $this->DsLocal;
    }

    /**
     * @param mixed $DsLocal
     *
     * @return self
     */
    public function setDsLocal($DsLocal)
    {
    	$this->DsLocal = $DsLocal;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getDsUF()
    {
    	return $this->DsUF;
    }

    /**
     * @param mixed $DsUF
     *
     * @return self
     */
    public function setDsUF($DsUF)
    {
    	$this->DsUF = $DsUF;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getNrCepEntrega()
    {
    	return $this->NrCepEntrega;
    }

    /**
     * @param mixed $NrCepEntrega
     *
     * @return self
     */
    public function setNrCepEntrega($NrCepEntrega)
    {
    	$this->NrCepEntrega = $NrCepEntrega;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getNrTelefone()
    {
    	return $this->NrTelefone;
    }

    /**
     * @param mixed $NrTelefone
     *
     * @return self
     */
    public function setNrTelefone($NrTelefone)
    {
    	$this->NrTelefone = $NrTelefone;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getDsObservacao()
    {
    	return $this->DsObservacao;
    }

    /**
     * @param mixed $DsObservacao
     *
     * @return self
     */
    public function setDsObservacao($DsObservacao)
    {
    	$this->DsObservacao = $DsObservacao;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getNrNotaFiscalAgend()
    {
        return $this->NrNotaFiscalAgend;
    }

    /**
     * @param mixed $NrNotaFiscalAgend
     *
     * @return self
     */
    public function setNrNotaFiscalAgend($NrNotaFiscalAgend)
    {
        $this->NrNotaFiscalAgend = $NrNotaFiscalAgend;

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
}