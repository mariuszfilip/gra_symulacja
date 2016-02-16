<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Klub\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Klub\Entity\Zawodnik;
use Klub\Repository\ZawodnikRepository;

class TreningController extends AbstractActionController
{

    /**
     * @var ZawodnikRepository
     */
    private $_service;


    public function __construct(ZawodnikRepository $service){
        $this->_service = $service;
    }


    public function listaAction()
    {
    }

    public function dodajAction()
    {

        $id_zawodnika = $this->getEvent()->getRouteMatch()->getParam('id_zawodnika',null);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $aPost = $request->getPost();

            /**
             * @var \Klub\Entity\Zawodnik $zawodnik
             */
            $zawodnik = $this->_service->getZawodnik($id_zawodnika);

            switch ($aPost['id_rodzaju_treningu']) {
                case 1:
                    //cardio
                   $zawodnik->pobierzAtrybuty()->zwieksz('kondycja',3);
                    break;
                case 2:
                    //crosfit
                    $zawodnik->pobierzAtrybuty()->zwieksz('kondycja',1);
                    $zawodnik->pobierzAtrybuty()->zwieksz('eksplozywnosc',3);
                    break;
                case 3:
                    //silowania
                    $zawodnik->pobierzAtrybuty()->zwieksz('sila',3);
                    break;
                case 4:
                    //muay thai
                    $zawodnik->pobierzUmiejetnosciOf()->zwieksz('stojka_uderzenia',3);
                    $zawodnik->pobierzUmiejetnosciOf()->zwieksz('stojka_kopniecia',3);
                    $zawodnik->pobierzUmiejetnosciOf()->zwieksz('stojka_kolana',3);
                    $zawodnik->pobierzUmiejetnosciOf()->zwieksz('stojka_klincz',3);
                    $zawodnik->pobierzUmiejetnosciDef()->zwieksz('stojka_obrona',3);
                    $zawodnik->pobierzUmiejetnosciDef()->zwieksz('stojka_kontratak',3);
                    break;
                case 5:
                    //bjj
                    $zawodnik->pobierzUmiejetnosciOf()->zwieksz('parter_submission',3);
                    $zawodnik->pobierzUmiejetnosciOf()->zwieksz('parter_groundpound',3);
                    $zawodnik->pobierzUmiejetnosciOf()->zwieksz('stojka_obalenia',3);
                    $zawodnik->pobierzUmiejetnoscDef()->zwieksz('stojka_obrona_przed_obaleniami',3);
                    $zawodnik->pobierzUmiejetnoscDef()->zwieksz('parter_def_grapping',3);
                    break;
                case 6:
                    //zapasy
                    $zawodnik->pobierzUmiejetnosciOf()->zwieksz('stojka_obalenia',3);
                    $zawodnik->pobierzUmiejetnosciOf()->zwieksz('parter_groundpound',3);
                    $zawodnik->pobierzUmiejetnosciOf()->zwieksz('stojka_klincz',3);

                    $zawodnik->pobierzUmiejetnoscDef()->zwieksz('stojka_obrona_przed_obaleniami',3);
                    $zawodnik->pobierzUmiejetnoscDef()->zwieksz('parter_def_grapping',3);
                    $zawodnik->pobierzAtrybuty()->zwieksz('sila',3);
                    //klincz siatka
                    break;
                case 7:
                    //trening przekrojowy
                    $zawodnik->pobierzAtrybuty()->zwieksz('kondycja',1);
                    $zawodnik->pobierzUmiejetnoscDef()->zwiekszWszystkie(1);
                    $zawodnik->pobierzUmiejetnosciOf()->zwiekszWszystkie(1);
                    break;
                case 8:
                    //boks
                    $zawodnik->pobierzUmiejetnosciOf()->zwieksz('stojka_uderzenia',3);
                    $zawodnik->pobierzUmiejetnosciOf()->zwieksz('stojka_klincz',3);
                    $zawodnik->pobierzUmiejetnoscDef()->zwieksz('stojka_obrona',3);
                    $zawodnik->pobierzUmiejetnoscDef()->zwieksz('stojka_kontratak',3);
                    //Balans
                    break;
                default:
                    echo 'brak zdefiniowanego treningu';
                    exit();
                    break;
            }
            $this->_service->zapisz($zawodnik);


            return $this->redirect()->toRoute('zawodnik');

        }

        return array('id_zawodnika' => $id_zawodnika);

    }

    public function rodzajeAction(){

        $id_grupy_treningu = $this->getEvent()->getRouteMatch()->getParam('id_grupy_treningu',null);

        $rodzajeTreningow = $this->getServiceLocator()->get('Klub\RodzajeTreningow');
        $aRodzaje = $rodzajeTreningow->pobierzRodzajeGrupy($id_grupy_treningu);
        $result = new JsonModel(
            $aRodzaje
        );

        return $result;
    }

}
