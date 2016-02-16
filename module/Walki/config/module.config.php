<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Walki;

return array(
    'router' => array(
        'routes' => array(
            'walki' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/walki[/:action][/:id_taktyki]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'Walki\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'wildcard' => array(
                        'type' => 'Zend\Mvc\Router\Http\Wildcard',
                        'options' => array(
                            'key_value_delimiter' => '/',
                            'param_delimiter' => '/',
                        ),
                        'may_terminate' => true,
                    ),
                ),
            ),
            'taktyki' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/taktyki[/:action][/:id_taktyki]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'Walki\Controller\Taktyki',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'wildcard' => array(
                        'type' => 'Zend\Mvc\Router\Http\Wildcard',
                        'options' => array(
                            'key_value_delimiter' => '/',
                            'param_delimiter' => '/',
                        ),
                        'may_terminate' => true,
                    ),
                ),
            ),
            'pojedynek' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/pojedynek[/:action][/:id_taktyki]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'Walki\Controller\Pojedynek',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'wildcard' => array(
                        'type' => 'Zend\Mvc\Router\Http\Wildcard',
                        'options' => array(
                            'key_value_delimiter' => '/',
                            'param_delimiter' => '/',
                        ),
                        'may_terminate' => true,
                    ),
                ),
            ),

        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'Walki\Taktyki' => function($sm){
                return new \Walki\View\Helper\Taktyka();
            }
        ),
    ),
    'controllers' => array(
        'factories'=> array(
            'Walki\Controller\Index' => 'Walki\Controller\Service\IndexControllerFactory',
            'Walki\Controller\Taktyki' => 'Walki\Controller\Service\TaktykiControllerFactory',
            'Walki\Controller\Pojedynek' => 'Walki\Controller\Service\PojedynekControllerFactory'
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
    'view_helpers' => array(
        'factories' => array(
            'taktyki' => function(\Zend\View\HelperPluginManager $sm){
                $styleBazowe = $sm->getServiceLocator()->get('Walki\Taktyki');
                return $styleBazowe;
            }
        ),
    ),
);
