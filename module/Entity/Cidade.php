<?php


namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

/**
 *
 * @ORM\Table(name="cidades", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Cidade
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
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $ibge;

    /**
     * Muitas cidades tem um estado.
     * @ORM\ManyToOne(targetEntity="Estado", inversedBy="cidades")
     * @ORM\JoinColumn(name="estados_id", referencedColumnName="id")
     */
    private $estado;

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
    public function getIbge()
    {
        return $this->ibge;
    }

    /**
     * @param string $ibge
     */
    public function setIbge($ibge)
    {
        $this->ibge = $ibge;
    }


    /**
     * @return Estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param Estado $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }


}