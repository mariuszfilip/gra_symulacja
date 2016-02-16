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

    private function czyMozliweDodanieZawodnika(){
        $limit = 2; // Todo to bedzie brane z ustawien , obecnie ograniczenie domyslne
        if($this->_service->pobierzIlosc($this->zfcUserAuthentication()->getIdentity()->getId()) <= $limit){
            return true;
        }
        return false;
    }

    public function indexAction()
    {
        try{
            $aZawodnicy = $this->_service->pobierzZawodnikowUzytkownika($this->zfcUserAuthentication()->getIdentity()->getId());


        }catch (\Exception $e){
            var_dump($e->getMessage());
        }
        return array('zawodnicy'=>$aZawodnicy);
    }

    public function dodajAction()
    {
        if(!$this->czyMozliweDodanieZawodnika()){
            $this->flashMessenger()->addMessage('Brak możliwości dodania zawodnika. Limit został osiągnięty!');
            return $this->redirect()->toRoute('zawodnik');
        }
        try{
            $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $style = $this->getServiceLocator()->get('Klub\StyleBazowe');

            $oFormZawodnik = new ZawodnikForm($dbAdapter,$style);
            $oFormZawodnikFilter = new ZawodnikFilter();

            $request = $this->getRequest();
            if ($request->isPost()) {
                $zawodnik = new Zawodnik();
                $oFormZawodnik->setInputFilter($oFormZawodnikFilter->getInputFilter());
                $oFormZawodnik->setData($request->getPost());

                if ($oFormZawodnik->isValid()) {
                    $zawodnik->exchangeArray($oFormZawodnik->getData());
                    $zawodnik->ustawIdUzytkownika($this->zfcUserAuthentication()->getIdentity()->getId());
                    $this->_service->dodajZawodnika($zawodnik);
                    $this->flashMessenger()->addMessage('Zawodnik '.$zawodnik->pobierzPseudonim().' został dodany.');
                    return $this->redirect()->toRoute('zawodnik');
                }
            }
        }catch (\Exception $e){
            var_dump($e->getMessage());
        }
        return array('form' => $oFormZawodnik);

    }
    public function umiejetnosciAction(){
        $id_zawodnika = $this->getEvent()->getRouteMatch()->getParam('id_zawodnika',null);

        $oZawodnicy = $this->_service->pobierzZawodnika($id_zawodnika);
        return array('zawodnik' => $oZawodnicy, 'flashMessages' => $this->flashMessenger()->getMessages());
    }
}
