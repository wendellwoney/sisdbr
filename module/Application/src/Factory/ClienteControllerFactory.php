<?php


namespace Application\Factory;


use Application\Controller\ClienteController;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

class ClienteControllerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get(EntityManager::class);

        return new ClienteController($em);
    }
}