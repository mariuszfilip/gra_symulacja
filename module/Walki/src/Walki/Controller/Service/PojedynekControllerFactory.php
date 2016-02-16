<?php

namespace Walki\Controller\Service;
use Walki\Controller\PojedynekController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Date: 21.10.15
 * Time: 21:31
 * @author Mariusz Filipkowski
 */


class PojedynekControllerFactory implements FactoryInterface{


    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return PojedynekController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        try{
            $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $taktykaRepo  = $em->getRepository('Walki\Entity\Taktyka');
            $zawodnikRepo  = $em->getRepository('Klub\Entity\Zawodnik');
            return new PojedynekController($zawodnikRepo,$taktykaRepo);
        }catch (\Exception $e){
            echo $e->getMessage();
            exit();
        }
    }
}

