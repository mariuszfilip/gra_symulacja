<?php
/**
 * Date: 30.11.15
 * Time: 23:28
 * @author Mariusz Filipkowski
 */

namespace Admin\Controller\Service;

use Admin\Controller\NewsController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NewsControllerFactory implements FactoryInterface{


    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // TODO: Implement createService() method.

        return new NewsController();
    }
}