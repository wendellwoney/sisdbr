<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Model\ClienteModel;
use Doctrine\ORM\EntityManager;
use Entity\Cliente;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ClienteController extends AbstractActionController
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        $view = new ViewModel();
        $clienteModel = new ClienteModel($this->entityManager);
        if ($this->params()->fromRoute('id')) {
            try {
                $clienteModel->delete($this->params()->fromRoute('id'));
                $view->setVariable('msgs', 'Cliente removido!');
            } catch (\Exception $e) {
                $view->setVariable('msge', $e->getMessage());
            }
        }

        $clientes = $clienteModel->getList();
        $view->setVariable('clientes', $clientes);

        return $view;
    }

    public function cadastroAction()
    {
        $view = new ViewModel();
        if ($this->getRequest()->isPost()) {
            $cliente = new Cliente();
            $cliente->setNome($this->params()->fromPost('nome'));
            $cliente->setApelido($this->params()->fromPost('apelido',null));
            $cliente->setSexo($this->params()->fromPost('sexo'));
            $cliente->setTelefoneCelular($this->params()->fromPost('telefone_celular'));
            $cliente->setObservacao($this->params()->fromPost('observacao'));
            $cliente->setEmail($this->params()->fromPost('email'));
            $cliente->setCpf($this->params()->fromPost('cpf'));
            $nascimento = $this->params()->fromPost('nascimento');
            $dataNascimento = (new \DateTime($nascimento));
            $cliente->setNascimento($dataNascimento);
            $cliente->setTelefoneContato($this->params()->fromPost('telefone_contato',null));
            $cliente->setDataCadastro();
            //TODO Uploade da foto

            try {
                $clienteModel = new ClienteModel($this->entityManager);
                $view->setVariable('msgs', $clienteModel->create($cliente));
            } catch (\Exception $e) {
                $view->setVariable('msge', $e->getMessage());
            }
        }
        return $view;
    }
}
