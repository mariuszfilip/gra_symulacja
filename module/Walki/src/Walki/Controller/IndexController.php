<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Walki\Controller;

use Walki\Entity\Taktyka;
use Walki\Entity\TaktykaKlincz;
use Walki\Entity\TaktykaParter;
use Walki\Entity\TaktykaStojka;
use Walki\Repository\TaktykaKlinczRepository;
use Walki\Repository\TaktykaRepository;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Walki\Form\TaktykaForm;

class IndexController extends AbstractActionController
{

    private $_service;

    private $_service2;

    public function __construct(TaktykaRepository $service,TaktykaKlinczRepository $service2){
        $this->_service = $service;
        $this->_service2 = $service2;
    }
    public function indexAction()
    {
        return new ViewModel();

    }
    public function taktykaAction()
    {
        return new ViewModel();

    }

    public function listaAction()
    {
        return new ViewModel();
    }

}
