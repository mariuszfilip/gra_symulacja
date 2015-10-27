<?php
/**
 * Date: 21.10.15
 * Time: 21:27
 * @author Mariusz Filipkowski
 */

namespace Klub\Factory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Klub\Repository\ZawodnikRepository;

class ZawodnikRepositoryFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        try{

            $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
            return new ZawodnikRepository($em);
        }catch (\Exception $e){
            echo $e->getMessage();
            exit();
        }
    }


}