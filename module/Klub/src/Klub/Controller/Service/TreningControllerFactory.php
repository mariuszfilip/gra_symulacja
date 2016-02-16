<?php

namespace Klub\Controller\Service;
use Klub\Controller\TreningController;
use Klub\Controller\ZawodnikController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Date: 21.10.15
 * Time: 21:31
 * @author Mariusz Filipkowski
 */


class TreningControllerFactory implements FactoryInterface{


    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return TreningController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        try{
            $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $repo  = $em->getRepository('Klub\Entity\Zawodnik');
            return new TreningController($repo);
        }catch (\Exception $e){
            echo $e->getMessage();
            exit();
        }
    }
}

