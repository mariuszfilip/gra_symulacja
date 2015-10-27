<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Klub\Controller;

use Klub\Form\ZawodnikFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Klub\Form\ZawodnikForm;
use Klub\Entity\Zawodnik;
use Klub\Repository\ZawodnikRepository;

class ZawodnikController extends AbstractActionController
{

    /**
     * @var ZawodnikRepository
     */
    private $_service;


    public function __construct(ZawodnikRepository $service){
            $this->_service = $service;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function dodajAction()
    {
        try{
            $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $oFormZawodnik = new ZawodnikForm($dbAdapter);
            $oFormZawodnikFilter = new ZawodnikFilter();

            $request = $this->getRequest();
            if ($request->isPost()) {
                $zawodnik = new Zawodnik();
                $oFormZawodnik->setInputFilter($oFormZawodnikFilter->getInputFilter());
                $oFormZawodnik->setData($request->getPost());

                if ($oFormZawodnik->isValid()) {
                    $zawodnik->exchangeArray($oFormZawodnik->getData());

                    $this->_service->dodajZawodnika($zawodnik);

                    // Redirect to list of albums
                    return $this->redirect()->toRoute('zawodnik');
                }
            }
        }catch (\Exception $e){
            var_dump($e->getMessage());
        }
        return array('form' => $oFormZawodnik);

    }
}
