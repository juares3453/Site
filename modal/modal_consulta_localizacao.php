<?php

class ConsultaLocalizacaoModal{

	private $CTe;
	private $DtEmissao;
	private $Remetente;
	private $Destinatario;
	private $DsSituacaoCarga;
	private $NrSeqControle;
	private $NotaFiscal;
	private $DtSaidaOr;
	private $DtChegada;
	private $DtArmazenada;
	private $DtAgendamento;
	private $DtSaidaEnt;
	private $DtEntrega;
    private $Historico;
    private $Data;
    private $Cliente;
    private $CdRemetente;
    private $DtPrevEntrega;

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
    public function getNrSeqControle()
    {
        return $this->NrSeqControle;
    }

    /**
     * @param mixed $NrSeqControle
     *
     * @return self
     */
    public function setNrSeqControle($NrSeqControle)
    {
        $this->NrSeqControle = $NrSeqControle;

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
    public function getDtSaidaOr()
    {
        return $this->DtSaidaOr;
    }

    /**
     * @param mixed $DtSaidaOr
     *
     * @return self
     */
    public function setDtSaidaOr($DtSaidaOr)
    {
        $this->DtSaidaOr = $DtSaidaOr;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtChegada()
    {
        return $this->DtChegada;
    }

    /**
     * @param mixed $DtChegada
     *
     * @return self
     */
    public function setDtChegada($DtChegada)
    {
        $this->DtChegada = $DtChegada;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtArmazenada()
    {
        return $this->DtArmazenada;
    }

    /**
     * @param mixed $DtArmazenada
     *
     * @return self
     */
    public function setDtArmazenada($DtArmazenada)
    {
        $this->DtArmazenada = $DtArmazenada;

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
    public function getDtSaidaEnt()
    {
        return $this->DtSaidaEnt;
    }

    /**
     * @param mixed $DtSaidaEnt
     *
     * @return self
     */
    public function setDtSaidaEnt($DtSaidaEnt)
    {
        $this->DtSaidaEnt = $DtSaidaEnt;

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
    public function getHistorico()
    {
        return $this->Historico;
    }

    /**
     * @param mixed $Historico
     *
     * @return self
     */
    public function setHistorico($Historico)
    {
        $this->Historico = $Historico;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->Data;
    }

    /**
     * @param mixed $Data
     *
     * @return self
     */
    public function setData($Data)
    {
        $this->Data = $Data;

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