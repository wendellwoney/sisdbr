<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Factory\ClienteControllerFactory;
use Application\Factory\EnderecoControllerFactory;
use Application\Factory\IndexControllerFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../../../Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    'Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
    'router' => [
        'routes' => [
            'Inicial' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'ClienteLista' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/cliente[/][:id]',
                    'defaults' => [
                        'controller' => Controller\ClienteController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'ClienteCadastro' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/cliente/cadastro[/]',
                    'defaults' => [
                        'controller' => Controller\ClienteController::class,
                        'action'     => 'cadastro',
                    ],
                ],
            ],
            'ClienteEditar' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/cliente/edita/:id[/][:endereco]',
                    'defaults' => [
                        'controller' => Controller\ClienteController::class,
                        'action'     => 'edita',
                    ],
                ],
            ],
            'EnderecoCadastro' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/endereco/cliente/:id[/]',
                    'defaults' => [
                        'controller' => Controller\EnderecoController::class,
                        'action'     => 'cadastro',
                    ],
                ],
            ],
            'EnderecoEdita' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/endereco/cliente/:clienteid/edita/:id[/]',
                    'defaults' => [
                        'controller' => Controller\EnderecoController::class,
                        'action'     => 'edita',
                    ],
                ],
            ],
            'EnderecoRemove' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/endereco/cliente/:clienteid/remove/:id[/]',
                    'defaults' => [
                        'controller' => Controller\EnderecoController::class,
                        'action'     => 'remover',
                    ],
                ],
            ],
            'grafico' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/grafico',
                    'defaults' => [
                        'controller' => Controller\ClienteController::class,
                        'action'     => 'json',
                    ],
                ],
            ]
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => IndexControllerFactory::class,
            Controller\ClienteController::class => ClienteControllerFactory::class,
            Controller\EnderecoController::class => EnderecoControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../../../layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
