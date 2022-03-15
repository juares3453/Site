<?php 


class AgendamentoModal{

	private $CdRemetente;
	private $CdDestinatario;
	private $NrSerie;
	private $NrNotaFiscal;
	private $DtEmissao;
	private $VlNotaFiscal;
	private $QtPeso;
	private $QtVolume;
	private $CdEspecie;
	private $CdNatureza;
	private $CdTpTransporte;
	private $QtMetrosCubicos;
	private $CdOperacaoFiscal;
	private $NrPedido;
	private $DtMovimento;
	private $DsMarca;
	private $CdEmpresaDestino;
	private $InTipoFrete;
	private $CdConsignatario;
	private $DtTolerancia;
	private $Armazenamento;
	private $DsDestinatario;
	private $DsRemetente;

	private $DsEntidade;
	private $DsEndereco;
	private $DsBairro;
	private $NrCEP;
	private $NrTelefone;
	private $DsNumero;
	private $DsComplemento;

	private $CdRetorno;
    private $CdConceitoCliente;

	private $DsLocal;
	private $DsUF;

	private $CdSequencia;
	private $CdDestinatarioAgend;
	private $DsEntidadeAgend;
	private $NrCepEntregaAgend;
	private $DsCidadeAgend;
	private $DsUFAgend;
	private $DsBairroAgend;
	private $DsEnderecoAgend;
	private $DsNumAgend;
	private $NrTelefoneAgend;
	private $DsComplementoAgend;
	private $DtEntregaProgramada;
	private $DsComentarioAgend;
	private $NrSerieNFAgend;
	private $NrNotaFiscalAgend;
	private $VlMercadoria;
	private $QtPesoCubado;
	private $QtVolumes;
	private $NrMarca;
	private $NrChaveAcessoNFe;
	private $DtAgendamento;
    private $InProcessado;
	private $CdInscricao;

    private $DtUtil;

    private $CdLote;

    public function getCdInscricao()
    {
        return $this->CdInscricao;
    }
    
    public function setCdInscricao($CdInscricao)
    {
        return $this->CdInscricao = $CdInscricao;
    }

    public function getCdConceitoCliente()
    {
        return $this->CdConceitoCliente;
    }
    
    public function setCdConceitoCliente($CdConceitoCliente)
    {
        return $this->CdConceitoCliente = $CdConceitoCliente;
    }
    
    public function getDtUtil()
    {
        return $this->DtUtil;
    }
    
    public function setDtUtil($DtUtil)
    {
        return $this->DtUtil = $DtUtil;
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
    public function getNrSerie()
    {
        return $this->NrSerie;
    }

    /**
     * @param mixed $NrSerie
     *
     * @return self
     */
    public function setNrSerie($NrSerie)
    {
        $this->NrSerie = $NrSerie;

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
    public function getVlNotaFiscal()
    {
        return $this->VlNotaFiscal;
    }

    /**
     * @param mixed $VlNotaFiscal
     *
     * @return self
     */
    public function setVlNotaFiscal($VlNotaFiscal)
    {
        $this->VlNotaFiscal = $VlNotaFiscal;

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
    public function getCdEspecie()
    {
        return $this->CdEspecie;
    }

    /**
     * @param mixed $CdEspecie
     *
     * @return self
     */
    public function setCdEspecie($CdEspecie)
    {
        $this->CdEspecie = $CdEspecie;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCdNatureza()
    {
        return $this->CdNatureza;
    }

    /**
     * @param mixed $CdNatureza
     *
     * @return self
     */
    public function setCdNatureza($CdNatureza)
    {
        $this->CdNatureza = $CdNatureza;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCdTpTransporte()
    {
        return $this->CdTpTransporte;
    }

    /**
     * @param mixed $CdTpTransporte
     *
     * @return self
     */
    public function setCdTpTransporte($CdTpTransporte)
    {
        $this->CdTpTransporte = $CdTpTransporte;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQtMetrosCubicos()
    {
        return $this->QtMetrosCubicos;
    }

    /**
     * @param mixed $QtMetrosCubicos
     *
     * @return self
     */
    public function setQtMetrosCubicos($QtMetrosCubicos)
    {
        $this->QtMetrosCubicos = $QtMetrosCubicos;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCdOperacaoFiscal()
    {
        return $this->CdOperacaoFiscal;
    }

    /**
     * @param mixed $CdOperacaoFiscal
     *
     * @return self
     */
    public function setCdOperacaoFiscal($CdOperacaoFiscal)
    {
        $this->CdOperacaoFiscal = $CdOperacaoFiscal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrPedido()
    {
        return $this->NrPedido;
    }

    /**
     * @param mixed $NrPedido
     *
     * @return self
     */
    public function setNrPedido($NrPedido)
    {
        $this->NrPedido = $NrPedido;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtMovimento()
    {
        return $this->DtMovimento;
    }

    /**
     * @param mixed $DtMovimento
     *
     * @return self
     */
    public function setDtMovimento($DtMovimento)
    {
        $this->DtMovimento = $DtMovimento;

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
    public function getCdEmpresaDestino()
    {
        return $this->CdEmpresaDestino;
    }

    /**
     * @param mixed $CdEmpresaDestino
     *
     * @return self
     */
    public function setCdEmpresaDestino($CdEmpresaDestino)
    {
        $this->CdEmpresaDestino = $CdEmpresaDestino;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInTipoFrete()
    {
        return $this->InTipoFrete;
    }

    /**
     * @param mixed $InTipoFrete
     *
     * @return self
     */
    public function setInTipoFrete($InTipoFrete)
    {
        $this->InTipoFrete = $InTipoFrete;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCdConsignatario()
    {
        return $this->CdConsignatario;
    }

    /**
     * @param mixed $CdConsignatario
     *
     * @return self
     */
    public function setCdConsignatario($CdConsignatario)
    {
        $this->CdConsignatario = $CdConsignatario;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtTolerancia()
    {
        return $this->DtTolerancia;
    }

    /**
     * @param mixed $DtTolerancia
     *
     * @return self
     */
    public function setDtTolerancia($DtTolerancia)
    {
        $this->DtTolerancia = $DtTolerancia;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArmazenamento()
    {
        return $this->Armazenamento;
    }

    /**
     * @param mixed $Armazenamento
     *
     * @return self
     */
    public function setArmazenamento($Armazenamento)
    {
        $this->Armazenamento = $Armazenamento;

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
    public function getDsRemetente()
    {
        return $this->DsRemetente;
    }

    /**
     * @param mixed $DsRemetente
     *
     * @return self
     */
    public function setDsRemetente($DsRemetente)
    {
        $this->DsRemetente = $DsRemetente;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsEntidade()
    {
        return $this->DsEntidade;
    }

    /**
     * @param mixed $DsEntidade
     *
     * @return self
     */
    public function setDsEntidade($DsEntidade)
    {
        $this->DsEntidade = $DsEntidade;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsEndereco()
    {
        return $this->DsEndereco;
    }

    /**
     * @param mixed $DsEndereco
     *
     * @return self
     */
    public function setDsEndereco($DsEndereco)
    {
        $this->DsEndereco = $DsEndereco;

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
    public function getNrCEP()
    {
        return $this->NrCEP;
    }

    /**
     * @param mixed $NrCEP
     *
     * @return self
     */
    public function setNrCEP($NrCEP)
    {
        $this->NrCEP = $NrCEP;

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
    public function getDsNumero()
    {
        return $this->DsNumero;
    }

    /**
     * @param mixed $DsNumero
     *
     * @return self
     */
    public function setDsNumero($DsNumero)
    {
        $this->DsNumero = $DsNumero;

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
    public function getCdRetorno()
    {
        return $this->CdRetorno;
    }

    /**
     * @param mixed $CdRetorno
     *
     * @return self
     */
    public function setCdRetorno($CdRetorno)
    {
        $this->CdRetorno = $CdRetorno;

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
    public function getCdSequencia()
    {
        return $this->CdSequencia;
    }

    /**
     * @param mixed $CdSequencia
     *
     * @return self
     */
    public function setCdSequencia($CdSequencia)
    {
        $this->CdSequencia = $CdSequencia;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCdDestinatarioAgend()
    {
        return $this->CdDestinatarioAgend;
    }

    /**
     * @param mixed $CdDestinatarioAgend
     *
     * @return self
     */
    public function setCdDestinatarioAgend($CdDestinatarioAgend)
    {
        $this->CdDestinatarioAgend = $CdDestinatarioAgend;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsEntidadeAgend()
    {
        return $this->DsEntidadeAgend;
    }

    /**
     * @param mixed $DsEntidadeAgend
     *
     * @return self
     */
    public function setDsEntidadeAgend($DsEntidadeAgend)
    {
        $this->DsEntidadeAgend = $DsEntidadeAgend;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrCepEntregaAgend()
    {
        return $this->NrCepEntregaAgend;
    }

    /**
     * @param mixed $NrCepEntregaAgend
     *
     * @return self
     */
    public function setNrCepEntregaAgend($NrCepEntregaAgend)
    {
        $this->NrCepEntregaAgend = $NrCepEntregaAgend;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsCidadeAgend()
    {
        return $this->DsCidadeAgend;
    }

    /**
     * @param mixed $DsCidadeAgend
     *
     * @return self
     */
    public function setDsCidadeAgend($DsCidadeAgend)
    {
        $this->DsCidadeAgend = $DsCidadeAgend;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsUFAgend()
    {
        return $this->DsUFAgend;
    }

    /**
     * @param mixed $DsUFAgend
     *
     * @return self
     */
    public function setDsUFAgend($DsUFAgend)
    {
        $this->DsUFAgend = $DsUFAgend;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsBairroAgend()
    {
        return $this->DsBairroAgend;
    }

    /**
     * @param mixed $DsBairroAgend
     *
     * @return self
     */
    public function setDsBairroAgend($DsBairroAgend)
    {
        $this->DsBairroAgend = $DsBairroAgend;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsEnderecoAgend()
    {
        return $this->DsEnderecoAgend;
    }

    /**
     * @param mixed $DsEnderecoAgend
     *
     * @return self
     */
    public function setDsEnderecoAgend($DsEnderecoAgend)
    {
        $this->DsEnderecoAgend = $DsEnderecoAgend;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsNumAgend()
    {
        return $this->DsNumAgend;
    }

    /**
     * @param mixed $DsNumAgend
     *
     * @return self
     */
    public function setDsNumAgend($DsNumAgend)
    {
        $this->DsNumAgend = $DsNumAgend;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrTelefoneAgend()
    {
        return $this->NrTelefoneAgend;
    }

    /**
     * @param mixed $NrTelefoneAgend
     *
     * @return self
     */
    public function setNrTelefoneAgend($NrTelefoneAgend)
    {
        $this->NrTelefoneAgend = $NrTelefoneAgend;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsComplementoAgend()
    {
        return $this->DsComplementoAgend;
    }

    /**
     * @param mixed $DsComplementoAgend
     *
     * @return self
     */
    public function setDsComplementoAgend($DsComplementoAgend)
    {
        $this->DsComplementoAgend = $DsComplementoAgend;

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
    public function getDsComentarioAgend()
    {
        return $this->DsComentarioAgend;
    }

    /**
     * @param mixed $DsComentarioAgend
     *
     * @return self
     */
    public function setDsComentarioAgend($DsComentarioAgend)
    {
        $this->DsComentarioAgend = $DsComentarioAgend;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrSerieNFAgend()
    {
        return $this->NrSerieNFAgend;
    }

    /**
     * @param mixed $NrSerieNFAgend
     *
     * @return self
     */
    public function setNrSerieNFAgend($NrSerieNFAgend)
    {
        $this->NrSerieNFAgend = $NrSerieNFAgend;

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
    public function getQtPesoCubado()
    {
        return $this->QtPesoCubado;
    }

    /**
     * @param mixed $QtPesoCubado
     *
     * @return self
     */
    public function setQtPesoCubado($QtPesoCubado)
    {
        $this->QtPesoCubado = $QtPesoCubado;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQtVolumes()
    {
        return $this->QtVolumes;
    }

    /**
     * @param mixed $QtVolumes
     *
     * @return self
     */
    public function setQtVolumes($QtVolumes)
    {
        $this->QtVolumes = $QtVolumes;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrMarca()
    {
        return $this->NrMarca;
    }

    /**
     * @param mixed $NrMarca
     *
     * @return self
     */
    public function setNrMarca($NrMarca)
    {
        $this->NrMarca = $NrMarca;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrChaveAcessoNFe()
    {
        return $this->NrChaveAcessoNFe;
    }

    /**
     * @param mixed $NrChaveAcessoNFe
     *
     * @return self
     */
    public function setNrChaveAcessoNFe($NrChaveAcessoNFe)
    {
        $this->NrChaveAcessoNFe = $NrChaveAcessoNFe;

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
    public function getInProcessado()
    {
        return $this->InProcessado;
    }

    /**
     * @param mixed $InProcessado
     *
     * @return self
     */
    public function setInProcessado($InProcessado)
    {
        $this->InProcessado = $InProcessado;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCdLote()
    {
        return $this->CdLote;
    }

    /**
     * @param mixed $CdLote
     *
     * @return self
     */
    public function setCdLote($CdLote)
    {
        $this->CdLote = $CdLote;

        return $this;
    }
}