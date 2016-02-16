<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use  Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements
    ViewHelperProviderInterface

{


        public function onBootstrap(MvcEvent $e)
    {
        $sharedManager = $e->getApplication()->getEventManager()->getSharedManager();
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $sm = $e->getApplication ()->getServiceManager ();


        $sharedManager->attach('Zend\Mvc\Application', 'dispatch.error',  function($e) use ($sm) {
                if ($e->getParam('exception')){
                    $sm->get('Zend\Log\Logger')->crit($e->getParam('exception'));
                }
            }
        );
        $sharedEvents = $eventManager->getSharedManager();

        $sharedEvents->attach('ZfcUser\Form\Register',
            'init',
            function ($e) use ($sm){
                /* @var $form \ZfcUser\Form\Register */
                $form = $e->getTarget();

                $form->add(
                    array(
                        'name' => 'adres',
                        'type' => 'text',
                        'options' => array(
                            'label' => 'Adres',
                        ),
                    )
                );

                $form->add(
                    array(
                        'name' => 'numer_telefonu',
                        'type' => 'text',
                        'options' => array(
                            'label' => 'Numer telefonu',
                        ),
                    )
                );
                $miniaturki = $sm->get('Rejestracja\Miniaturki');
                $aLista = $miniaturki->pobierz();

                $form->add(
                    array(
                        'type' => 'Zend\Form\Element\Radio',
                        'name' => 'id_minaturki',
                        'options' => array(
                            'value_options' => $aLista,
                        ),
                        'attributes' => array(
                            'id'=>"fcaptcha-id"
                        )
                    )
                );

            }
        );

        // Validators for custom fields
        $sharedEvents->attach('ZfcUser\Form\RegisterFilter',
            'init',
            function ($e) {
                /* @var $form \ZfcUser\Form\RegisterFilter */
                $filter = $e->getTarget();

                $filter->add(array(
                    'name'     => 'id_minaturki',
                    'required' => true,
                ));


            }
        );
        $zfcServiceEvents = $e->getApplication()->getServiceManager()->get('zfcuser_user_service')->getEventManager();
        $zfcServiceEvents->attach('register', function($e) {
            $form = $e->getParam('form');
            $user = $e->getParam('user');

            /* @var $user Application\Entity\User */
            $user->setAddress( $form->get('adres')->getValue() );
            $user->setNumberPhone( $form->get('numer_telefonu')->getValue() );
        });


    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getViewHelperConfig()
    {

    }
}
