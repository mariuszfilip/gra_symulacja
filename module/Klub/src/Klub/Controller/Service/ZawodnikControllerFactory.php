<?php

namespace Klub\Controller\Service;
use Klub\Controller\ZawodnikController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Date: 21.10.15
 * Time: 21:31
 * @author Mariusz Filipkowski
 */


class ZawodnikControllerFactory implements FactoryInterface{


    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ZawodnikController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        try{
            $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $repo  = $em->getRepository('Klub\Entity\Zawodnik');
            return new ZawodnikController($repo);
        }catch (\Exception $e){
            echo $e->getMessage();
            exit();
        }
    }
}

