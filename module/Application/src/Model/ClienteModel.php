<?php


namespace Application\Model;


use Doctrine\ORM\EntityManager;
use Entity\Cliente;
use Entity\Endereco;

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
        try {
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

    public function update($cliente)
    {
        try {
            $this->entityManager->beginTransaction();
            $this->entityManager->merge($cliente);
            $this->entityManager->flush();
            $this->entityManager->commit();
            return 'Cliente editado com sucesso';
        } catch (\Exception $e) {
            throw new \Exception('Erro ao editar o cliente, por favor tente novamente mais tarde!');
        }
    }

    public function delete($id)
    {
        try {
            $cliente = $this->get($id);
            $this->entityManager->beginTransaction();
            //Remover os Endereços do Cliente
            if($cliente->getEndereco()->count() > 0){
                $enderecoModel = new EnderecoModel($this->entityManager);
                foreach ($cliente->getEndereco() as $endereco){
                    $this->entityManager->remove($enderecoModel->get($endereco->getId()));
                }
            }
            $this->entityManager->remove($cliente);
            $this->entityManager->flush();
            $this->entityManager->commit();
            return 'Cliente removido!';
        } catch (\Exception $e) {
            throw new \Exception('Erro ao remover o cliente, por favor tente novamente mais tarde!');
        }
    }

    public function graficoClienteCadastrado()
    {
        $arrayClienteTotal = [];
        $clientes = $this->getList();

        foreach ($clientes as $cliente) {
            @$arrayClienteTotal[$cliente->getDataCadastro()->format('M')] += 1;
        }

        return $arrayClienteTotal;
    }

}