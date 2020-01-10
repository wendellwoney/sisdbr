<?php


namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

/**
 *
 * @ORM\Table(name="estados", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Estado
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
    private $sigla;

    /**
     * Um estado tem varias cidades. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Cidade", mappedBy="estado")
     */
    private $cidades;

    public function __construct() {
        $this->cidades = new ArrayCollection();
    }

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
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * @param string $sigla
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
    }

    /**
     * @return ArrayCollection
     */
    public function getCidades()
    {
        return $this->cidades;
    }

}