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

class TaktykiController extends AbstractActionController
{

    /**
     * @var TaktykaRepository
     */
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
    public function zarzadzajAction()
    {
        $idTaktyki = $this->getEvent()->getRouteMatch()->getParam('id_taktyki',null);
        $taktyka = $this->getServiceLocator()->get('Walki\Taktyki');
        $oFormTaktyka = new TaktykaForm($taktyka);

        $request = $this->getRequest();
        if ($request->isPost()) {
            if($idTaktyki > 0){
                $taktyka = $this->_service->znajdzPoIdTaktyki($idTaktyki);
            }else{
                $taktyka = new Taktyka();
                $taktykaKlincz = new TaktykaKlincz();
                $taktykaStojka = new TaktykaStojka();
                $taktykaParter = new TaktykaParter();
                $taktyka->ustawKlincz($taktykaKlincz);
                $taktyka->ustawParter($taktykaParter);
                $taktyka->ustawStojka($taktykaStojka);
            }
            $oFormTaktyka->setData($request->getPost());

            if ($oFormTaktyka->isValid()) {
                $taktyka->from_array($oFormTaktyka->getData());
                $taktyka->pobierzParter()->from_array($oFormTaktyka->getData());
                $taktyka->pobierzStojka()->from_array($oFormTaktyka->getData());
                $taktyka->pobierzKlincz()->from_array($oFormTaktyka->getData());
                $taktyka->ustawIdUzytkownika($this->zfcUserAuthentication()->getIdentity()->getId());
                $this->_service->dodaj($taktyka);


                return $this->redirect()->toRoute('taktyki',array('controller'=>'taktyki','action'=>'lista'));
            }
        }

        if(!is_null($idTaktyki) && $idTaktyki > 0){
            /**
             * @var Taktyka $oTaktyka
             */
            $oTaktyka = $this->_service->znajdzPoIdTaktyki($idTaktyki);
            $aDane = array_merge(
                $oTaktyka->toArray(),
                $oTaktyka->pobierzKlincz()->toArray(),
                $oTaktyka->pobierzParter()->toArray(),
                $oTaktyka->pobierzStojka()->toArray()
            );
            $oFormTaktyka->setData($aDane);


        }
        //var_dump($oFormTaktyka->get('id_taktyki')->getValue());
        return array('form' => $oFormTaktyka);

    }

    public function listaAction()
    {
        $oLista = $this->_service->pobierzTaktykiUzytkownika($this->zfcUserAuthentication()->getIdentity()->getId());
        return array('lista_taktyk'=>$oLista);

    }

}
