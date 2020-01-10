<?php


namespace Application\Factory;


use Application\Controller\EnderecoController;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

class EnderecoControllerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get(EntityManager::class);

        return new EnderecoController($em);
    }
}