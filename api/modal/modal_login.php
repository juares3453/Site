<?php


class LoginModal{

	private $ID;
	private $CdInscricao;
	private $DsEmail;
	private $DsLogin;
	private $DsSenha;
	private $DsEnderecoIp;
	private $DtUltimoAcesso;
	private $InAtivo;
	private $row_count;
	private $CdError;
	private $DtUltimaTentativa;
	private $DtUltimaVisita;
	private $EmailCL;
	private $NovaSenha;
	private $InPermiteConsFinanc;
	private $InPermAltContatoCliente;
	private $CdPerfil;
	private $InAceiteTermo;

	public function getNovaSenha()
	{
		return $this->NovaSenha;
	}

	public function setNovaSenha($NovaSenha)
	{
		return $this->NovaSenha = $NovaSenha;
	}

	public function getEmailCL()
	{
		return $this->EmailCL;
	}

	public function setEmailCL($EmailCL)
	{
		return $this->EmailCL = $EmailCL;
	}

	public function getDtUltimaVisita()
	{
		return $this->DtUltimaVisita;
	}

	public function setDtUltimaVisita($DtUltimaVisita)
	{
		return $this->DtUltimaVisita = $DtUltimaVisita;
	}

	public function getCdInscricao()
	{
		return $this->CdInscricao;
	}

	public function setCdInscricao($CdInscricao)
	{
		return $this->CdInscricao = $CdInscricao;
	}

	public function getDsEmail()
	{
		return $this->DsEmail;
	}

	public function setDsEmail($DsEmail)
	{
		return $this->DsEmail = $DsEmail;
	}

	public function getDsLogin()
	{
		return $this->DsLogin;
	}

	public function setDsLogin($DsLogin)
	{
		return $this->DsLogin = $DsLogin;
	}

	public function getDsSenha()
	{
		return $this->DsSenha;
	}

	public function setDsSenha($DsSenha)
	{
		return $this->DsSenha = $DsSenha;
	}

	public function getID()
	{
		return $this->ID;
	}

	public function setID($ID)
	{
		return $this->ID = $ID;
	}

	public function getDsEnderecoIp()
	{
		return $this->DsEnderecoIp;
	}

	public function setDsEnderecoIp($DsEnderecoIp)
	{
		return $this->DsEnderecoIp = $DsEnderecoIp;
	}

	public function getDtUltimoAcesso()
	{
		return $this->DtUltimoAcesso;
	}

	public function setDtUltimoAcesso($DtUltimoAcesso)
	{
		return $this->DtUltimoAcesso = $DtUltimoAcesso;
	}

	public function getInAtivo()
	{
		return $this->InAtivo;
	}

	public function setInAtivo($InAtivo)
	{
		return $this->InAtivo = $InAtivo;
	}

	public function getRowCount()
	{
		return $this->RowCount;
	}

	public function setRowCount($RowCount)
	{
		return $this->RowCount = $RowCount;
	}

	public function getCdError()
	{
		return $this->CdError;
	}

	public function setCdError($CdError)
	{
		return $this->CdError = $CdError;
	}

	public function getDtUltimaTentativa()
	{
		return $this->DtUltimaTentativa;
	}

	public function setDtUltimaTentativa($DtUltimaTentativa)
	{
		return $this->DtUltimaTentativa = $DtUltimaTentativa;
	}

	public function getInPermiteConsFinanc()
	{
		return $this->InPermiteConsFinanc;
	}

	public function setInPermiteConsFinanc($InPermiteConsFinanc)
	{
		return $this->InPermiteConsFinanc = $InPermiteConsFinanc;
	}

	public function getInPermAltContatoCliente()
	{
		return $this->InPermAltContatoCliente;
	}

	public function setInPermAltContatoCliente($InPermAltContatoCliente)
	{
		$this->InPermAltContatoCliente = $InPermAltContatoCliente;

		return $this;
	}

    /**
     * @return mixed
     */
    public function getCdPerfil()
    {
    	return $this->CdPerfil;
    }

    /**
     * @param mixed $CdPerfil
     *
     * @return self
     */
    public function setCdPerfil($CdPerfil)
    {
    	$this->CdPerfil = $CdPerfil;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getInAceiteTermo()
    {
    	return $this->InAceiteTermo;
    }

    /**
     * @param mixed $InAceiteTermo
     *
     * @return self
     */
    public function setInAceiteTermo($InAceiteTermo)
    {
    	$this->InAceiteTermo = $InAceiteTermo;

    	return $this;
    }
}