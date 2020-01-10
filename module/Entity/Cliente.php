<?php


namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;
use Zend\Validator\Date;

/**
 *
 * @ORM\Table(name="clientes", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Cliente
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
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $apelido;

    /**
     * @ORM\Column(type="string", length=11, nullable=false)
     */
    private $cpf;

    /**
     * @ORM\Column(type="string", length=1, nullable=false)
     */
    private $sexo;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $nascimento;

    /**
     * @ORM\Column(type="string", length=13, nullable=true)
     */
    private $telefone_contato;

    /**
     * @ORM\Column(type="string", length=14, nullable=false)
     */
    private $telefone_celular;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $foto;

    /** @ORM\Column(type="datetime") */
    private $data_cadastro;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $observacao;

    /**
     * Um cliente tem varias enderecos
     * @ORM\OneToMany(targetEntity="Endereco", mappedBy="cliente")
     */
    private $endereco;

    public function __construct() {
        $this->endereco = new ArrayCollection();
    }

    /**
     * @return mixed
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getApelido()
    {
        return $this->apelido;
    }

    /**
     * @param string $apelido
     */
    public function setApelido($apelido)
    {
        $this->apelido = $apelido;
    }

    /**
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param string $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return Date
     */
    public function getNascimento()
    {
        return $this->nascimento;
    }

    /**
     * @param Date $nascimento
     */
    public function setNascimento($nascimento)
    {
        $this->nascimento = $nascimento;
    }

    /**
     * @return string
     */
    public function getTelefoneContato()
    {
        return $this->telefone_contato;
    }

    /**
     * @param string $telefone_contato
     */
    public function setTelefoneContato($telefone_contato)
    {
        $this->telefone_contato = $telefone_contato;
    }

    /**
     * @return string
     */
    public function getTelefoneCelular()
    {
        return $this->telefone_celular;
    }

    /**
     * @param string $telefone_celular
     */
    public function setTelefoneCelular($telefone_celular)
    {
        $this->telefone_celular = $telefone_celular;
    }

    /**
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param string $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * @return \DateTime
     */
    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }

    /**
     * @param \DateTime $data_cadastro
     */
    public function setDataCadastro()
    {
        $this->data_cadastro = new \DateTime("now");
    }

    /**
     * @return ArrayCollection
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @return string
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * @param string $observacao
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;
    }


}