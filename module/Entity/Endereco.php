<?php


namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;
/**
 *
 * @ORM\Table(name="enderecos", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Endereco
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=2, nullable=false)
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", length=9, nullable=false)
     */
    private $cep;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $endereco;

    /**
     * @ORM\Column(type="integer",nullable=false)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $complemento;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $bairro;

    /**
     * Um endereco tem uma cidade.
     * @ORM\OneToOne(targetEntity="Cidade")
     * @ORM\JoinColumn(name="cidades_id", referencedColumnName="id")
     */
    private $cidade;

    /**
     * Varios enderecos para um cliente
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="enderecos")
     * @ORM\JoinColumn(name="clientes_id", referencedColumnName="id")
     */
    private $cliente;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param string $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    /**
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param string $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param int $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return string
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * @param string $complemento
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    /**
     * @return string
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param string $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * @return Cidade
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param Cidade $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * @return Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param Cliente $cliente
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

}