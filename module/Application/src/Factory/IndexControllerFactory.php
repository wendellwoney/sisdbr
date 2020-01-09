<?php


namespace Application\Factory;


use Doctrine\ORM\EntityManager;
use Application\Controller\IndexController;
use Interop\Container\ContainerInterface;

class IndexControllerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get(EntityManager::class);

        return new IndexController($em);
    }
}