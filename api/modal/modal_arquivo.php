<?php

class ArquivoModal{

	private $Remetente;
	private $Destinatario;
	private $Conhecimento;
	private $DtEmissao;
	private $Xml;
	private $Pdf;

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
    public function getConhecimento()
    {
    	return $this->Conhecimento;
    }

    /**
     * @param mixed $Conhecimento
     *
     * @return self
     */
    public function setConhecimento($Conhecimento)
    {
    	$this->Conhecimento = $Conhecimento;

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
    public function getXml()
    {
    	return $this->Xml;
    }

    /**
     * @param mixed $Xml
     *
     * @return self
     */
    public function setXml($Xml)
    {
    	$this->Xml = $Xml;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getPdf()
    {
    	return $this->Pdf;
    }

    /**
     * @param mixed $Pdf
     *
     * @return self
     */
    public function setPdf($Pdf)
    {
    	$this->Pdf = $Pdf;

    	return $this;
    }
}