<?php


namespace Application\Model;


use Doctrine\ORM\EntityManager;
use Entity\Cliente;

class ClienteModel implements IModel
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getList()
    {
        return $this->entityManager->getRepository(Cliente::class)->findAll();
    }

    public function get($id)
    {
        return $this->entityManager->getRepository(Cliente::class)->find($id);
    }

    public function create($cliente)
    {
        try{
            $this->entityManager->beginTransaction();
            $this->entityManager->persist($cliente);
            $this->entityManager->flush();
            $this->entityManager->commit();
            $this->entityManager->refresh($cliente);
            return 'Cliente cadastrado';
        } catch (\Exception $e) {
            throw new \Exception('Erro no Cadastro do cliente, por favor tente novamente mais tarde!');
        }
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