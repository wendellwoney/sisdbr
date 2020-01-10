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
use Util\Funcao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Zend\View\Model\JsonModel;
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
                $cliente = $clienteModel->get($this->params()->fromRoute('id'));
                if (!empty($cliente)) {
                    $clienteModel->delete($this->params()->fromRoute('id'));
                    $view->setVariable('msgs', 'Cliente removido!');
                }
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
            $cliente->setApelido($this->params()->fromPost('apelido', null));
            $cliente->setSexo($this->params()->fromPost('sexo'));
            $cliente->setTelefoneCelular($this->params()->fromPost('telefone_celular'));
            $cliente->setObservacao($this->params()->fromPost('observacao'));
            $cliente->setEmail($this->params()->fromPost('email'));
            $cliente->setCpf($this->params()->fromPost('cpf'));
            $nascimento = $this->params()->fromPost('nascimento');
            $novaData = explode('/', $nascimento);
            $nascimento = $novaData[2] . "-" . $novaData[1] . "-" . $novaData[0];
            $dataNascimento = new \DateTime($nascimento);
            $cliente->setNascimento($dataNascimento);
            $cliente->setTelefoneContato($this->params()->fromPost('telefone_contato', null));
            $cliente->setDataCadastro();
            try {
                $foto = $this->params()->fromFiles('foto');
                if ($foto['size'] != 0) {
                    $cliente->setFoto(Funcao::imageUpload($foto, "public/img/cliente/"));
                }
                $clienteModel = new ClienteModel($this->entityManager);

                $this->flashMessenger()->addMessage($clienteModel->create($cliente));
                $this->redirect()->toRoute('ClienteEditar', ['id' => $cliente->getId(), 'endereco' => true]);
            } catch (\Exception $e) {
                $view->setVariable('msge', $e->getMessage());
            }
        }
        return $view;
    }

    public function editaAction()
    {
        $clienteModel = new ClienteModel($this->entityManager);
        $view = new ViewModel();
        if ($this->getRequest()->isPost()) {
            $cliente = new Cliente();
            $cliente->setId($this->params()->fromPost('id'));
            $cliente->setNome($this->params()->fromPost('nome'));
            $cliente->setApelido($this->params()->fromPost('apelido', null));
            $cliente->setSexo($this->params()->fromPost('sexo'));
            $cliente->setTelefoneCelular($this->params()->fromPost('telefone_celular'));
            $cliente->setObservacao($this->params()->fromPost('observacao'));
            $cliente->setEmail($this->params()->fromPost('email'));
            $cliente->setCpf($this->params()->fromPost('cpf'));
            $nascimento = $this->params()->fromPost('nascimento');
            $novaData = explode('/', $nascimento);
            $nascimento = $novaData[2] . "-" . $novaData[1] . "-" . $novaData[0];
            $dataNascimento = new \DateTime($nascimento);
            $cliente->setNascimento($dataNascimento);
            $cliente->setTelefoneContato($this->params()->fromPost('telefone_contato', null));
            $cliente->setDataCadastro();
            try {
                $foto = $this->params()->fromFiles('foto');
                if ($foto['size'] != 0) {
                    $cliente->setFoto(Funcao::imageUpload($foto, "public/img/cliente/"));
                }
                $clienteModel = new ClienteModel($this->entityManager);
                $view->setVariable('msgs', $clienteModel->update($cliente));
            } catch (\Exception $e) {
                $view->setVariable('msge', $e->getMessage());
            }
        }

        if ($this->params()->fromRoute('endereco')) {
            $view->setVariable('actend', true);
        }

        $flashMessenger = $this->flashMessenger();
        if ($flashMessenger->hasMessages()) {
            $view->setVariable('messages', $flashMessenger->getMessages());
        }
        $view->setVariable('cliente', $clienteModel->get($this->params()->fromRoute('id')));
        return $view;
    }

    public function jsonAction()
    {
        $clienteModel = new ClienteModel($this->entityManager);
        $cadastros = $clienteModel->graficoClienteCadastrado();
        $label = array();
        $data = array();
        foreach ($cadastros as $mes => $valor) {
            $label[] = $mes;
            $data[] = $valor;
        }

        $arra['label'] = $label;
        $arra['data'] = $data;

        echo json_encode($arra);exit;
    }

}
