<?php

namespace Walki\Controller\Service;
use Walki\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Date: 21.10.15
 * Time: 21:31
 * @author Mariusz Filipkowski
 */


class IndexControllerFactory implements FactoryInterface{


    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return IndexController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        try{
            $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $repo  = $em->getRepository('Walki\Entity\Taktyka');
            $repo2  = $em->getRepository('Walki\Entity\TaktykaKlincz');
            return new IndexController($repo,$repo2);
        }catch (\Exception $e){
            echo $e->getMessage();
            exit();
        }
    }
}

