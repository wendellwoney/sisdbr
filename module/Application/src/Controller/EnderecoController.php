<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Model\ClienteModel;
use Application\Model\EnderecoModel;
use Doctrine\ORM\EntityManager;
use Entity\Cidade;
use Entity\Cliente;
use Entity\Endereco;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class EnderecoController extends AbstractActionController
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function cadastroAction()
    {
        $view = new ViewModel();
        if ($this->getRequest()->isPost()) {
            $endereco = new Endereco();
            $endereco->setNome($this->params()->fromPost('nome'));
            $endereco->setBairro($this->params()->fromPost('bairro'));
            $endereco->setCep($this->params()->fromPost('cep'));
            $cidade = $this->entityManager->getRepository(Cidade::class)->findBy(
                ['ibge' => $this->params()->fromPost('ibge')]
            );
            $endereco->setCidade(current($cidade));
            $clienteModel = new ClienteModel($this->entityManager);
            $cliente = $clienteModel->get($this->params()->fromPost('idcliente'));
            $endereco->setCliente($cliente);
            $endereco->setEndereco($this->params()->fromPost('endereco'));
            $endereco->setNumero($this->params()->fromPost('numero'));
            $endereco->setTipo($this->params()->fromPost('tipo'));
            $endereco->setComplemento($this->params()->fromPost('complemento', null));
            try {
                $enderecoModel = new EnderecoModel($this->entityManager);
                $this->flashMessenger()->addMessage($enderecoModel->create($endereco));
                $this->redirect()->toRoute('ClienteEditar', ['id' => $cliente->getId(), 'endereco' => true]);

            } catch (\Exception $e) {
                $view->setVariable('msge', $e->getMessage());
            }
        }

        $clienteModel = new ClienteModel($this->entityManager);
        $cliente = $clienteModel->get($this->params()->fromRoute('id'));
        $view->setVariable('cliente', $cliente);

        return $view;
    }

    public function editaAction()
    {
        $view = new ViewModel();
        $enderecoModel = new EnderecoModel($this->entityManager);
        $clienteModel = new ClienteModel($this->entityManager);
        if ($this->getRequest()->isPost()) {
            $endereco = new Endereco();
            $endereco->setId($this->params()->fromPost('id'));
            $endereco->setNome($this->params()->fromPost('nome'));
            $endereco->setBairro($this->params()->fromPost('bairro'));
            $endereco->setCep($this->params()->fromPost('cep'));
            $cidade = $this->entityManager->getRepository(Cidade::class)->findBy(
                ['ibge' => $this->params()->fromPost('ibge')]
            );
            $endereco->setCidade(current($cidade));
            $cliente = $clienteModel->get($this->params()->fromPost('idcliente'));
            $endereco->setCliente($cliente);
            $endereco->setEndereco($this->params()->fromPost('endereco'));
            $endereco->setNumero($this->params()->fromPost('numero'));
            $endereco->setTipo($this->params()->fromPost('tipo'));
            $endereco->setComplemento($this->params()->fromPost('complemento', null));
            try {
                $this->flashMessenger()->addMessage($enderecoModel->update($endereco));
                $this->redirect()->toRoute('ClienteEditar', ['id' => $cliente->getId(), 'endereco' => true]);

            } catch (\Exception $e) {
                $view->setVariable('msge', $e->getMessage());
            }
        }


        $cliente = $clienteModel->get($this->params()->fromRoute('clienteid'));
        $endereco = $enderecoModel->get($this->params()->fromRoute('id'));

        $view->setVariable('cliente', $cliente);
        $view->setVariable('endereco', $endereco);

        return $view;
    }

    public function removerAction()
    {
        $view = new ViewModel();
        $enderecoModel = new EnderecoModel($this->entityManager);
        try {
            $endereco = $enderecoModel->get($this->params()->fromRoute('id'));
            if (!empty($endereco)) {
                $enderecoModel->delete($this->params()->fromRoute('id'));
                $this->flashMessenger()->addMessage('Endereço Removido');
                $this->redirect()->toRoute('ClienteEditar', ['id' => $this->params()->fromRoute('clienteid'), 'endereco' => true]);
            }else{
                $this->redirect()->toRoute('ClienteEditar', ['id' => $this->params()->fromRoute('clienteid'), 'endereco' => true]);
            }
        } catch (\Exception $e) {
            $view->setVariable('msge', $e->getMessage());
        }

        //$view->setTerminal(true);
        return $view;
    }
}
