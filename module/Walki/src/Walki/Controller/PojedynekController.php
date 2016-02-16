<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Walki\Controller;

use Walki\Repository\TaktykaRepository;
use Klub\Repository\ZawodnikRepository;
use Walki\Service\Walka;
use Zend\Mvc\Controller\AbstractActionController;
use Walki\Service\Pojedynek;

/**
 * Class PojedynekController
 * @package Walki\Controller
 */
class PojedynekController extends AbstractActionController
{


    /**
     * @var ZawodnikRepository
     */
    private $_repositoryZawodnik;
    /**
     * @var TaktykaRepository
     */
    private $_repositoryTaktyka;


    /**
     * PojedynekController constructor.
     * @param ZawodnikRepository $repositoryZawodnik
     * @param TaktykaRepository $repositoryTaktyka
     */
    public function __construct(ZawodnikRepository $repositoryZawodnik , TaktykaRepository $repositoryTaktyka){
        $this->_repositoryZawodnik = $repositoryZawodnik;
        $this->_repositoryTaktyka = $repositoryTaktyka;
    }

    /**
     *
     */
    public function indexAction()
    {
        $zawodnikB = $this->_repositoryZawodnik->pobierz(3);
        $taktykaB = $this->_repositoryTaktyka->znajdzPoIdTaktyki(1);

        $zawodnikA = $this->_repositoryZawodnik->pobierz(4);
        $taktykaA = $this->_repositoryTaktyka->znajdzPoIdTaktyki(2);

        $pojedynek1 = new Pojedynek($zawodnikA,$taktykaA);

        $pojedynek2 = new Pojedynek($zawodnikB,$taktykaB);


        $walka = new Walka($pojedynek1,$pojedynek2);

        $walka->rozpocznijStojka();
        $walka->podsumowanie();


        return array('komunikaty' => implode('<br/>',$walka->pobierzKomunikaty()));





    }

}
