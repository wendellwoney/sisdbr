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

    public function create($endereco)
    {
        try {
            $this->entityManager->beginTransaction();
            $this->entityManager->persist($endereco);
            $this->entityManager->flush();
            $this->entityManager->commit();
            $this->entityManager->refresh($endereco);
            return 'Endereço cadastrado';
        } catch (\Exception $e) {
            throw new \Exception('Erro no Cadastro do endereço, por favor tente novamente mais tarde!');
        }
    }

    public function update($endereco)
    {
        try {
            $this->entityManager->beginTransaction();
            $this->entityManager->merge($endereco);
            $this->entityManager->flush();
            $this->entityManager->commit();
            return 'Endereço editado com sucesso';
        } catch (\Exception $e) {
            echo $e->getMessage();exit;
            throw new \Exception('Erro ao editar o endereço, por favor tente novamente mais tarde!');
        }
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

}