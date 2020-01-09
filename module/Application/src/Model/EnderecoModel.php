<?php


namespace Application\Model;


use Doctrine\ORM\EntityManager;
use Entity\Cliente;
use Entity\Endereco;

class EnderecoModel implements IModel
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getList()
    {
        return $this->entityManager->getRepository(Endereco::class);
    }

    public function get($id)
    {
        return $this->entityManager->getRepository(Endereco::class)->find($id);
    }

    public function cliente(Cliente $cliente)
    {
        return $this->entityManager->getRepository(Endereco::class)
            ->findBy(
                ['cliente_id' => $cliente->getId()]
            );
    }

    public function create($object)
    {
        // TODO: Implement create() method.
    }

    public function update($object)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

}