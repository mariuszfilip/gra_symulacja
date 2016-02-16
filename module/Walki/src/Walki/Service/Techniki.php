<?php
/**
 * Date: 21.11.15
 * Time: 14:38
 * @author Mariusz Filipkowski
 */

namespace Walki\Service;


/**
 * Class Techniki
 * @package Walki\Service
 */
class Techniki{


    /**
     * @param $akcja
     * @param $technika
     * @param $typ_uderzenia
     * @return mixed
     * @throws \Exception
     */
    public function pobierzTechnike($akcja,$technika,$typ_uderzenia){
        $aAkcje = $this->pobierzAkcje();
        if(array_key_exists($akcja,$aAkcje)){
            if(array_key_exists($technika,$aAkcje[$akcja])){
                return array_rand($aAkcje[$akcja][$technika],1);
            }
        }
      throw new \Exception('Brak definicji techniki');

    }


    /**
     * @return array
     */
    private function pobierzAkcje(){
        return array(
            'kolana' =>
                array('kolana'=> array(
                    array('nazwa'=>'Latające kolano','ilosc_punktow'=>2,'ilosc_punktow_obrona'=>2,'losowac_od'=>1,'losowac_do'=>17),
                    array('nazwa'=>'Kolano w głowę','ilosc_punktow'=>2,'ilosc_punktow_obrona'=>2,'losowac_od'=>1,'losowac_do'=>17),
                    array('nazwa'=>'Naciągniecie głowy na kolano','ilosc_punktow'=>2,'ilosc_punktow_obrona'=>2,'losowac_od'=>1,'losowac_do'=>17),
                )),
                array('proba_skonczenia_walki'=> array(
                    array('nazwa'=>'Kolano w tylów','ilosc_punktow'=>2,'ilosc_punktow_obrona'=>2,'losowac_od'=>1,'losowac_do'=>12),
                    array('nazwa'=>'Kolano w nogi','ilosc_punktow'=>2,'ilosc_punktow_obrona'=>2,'losowac_od'=>1,'losowac_do'=>12),
                    array('nazwa'=>'Kolano w głowę','ilosc_punktow'=>2,'ilosc_punktow_obrona'=>2,'losowac_od'=>1,'losowac_do'=>12)
                )),
            'kopniecia'=>array(
                array('kopniecia'=> array(
                    array('nazwa'=>'High kick','ilosc_punktow'=>2,'ilosc_punktow_obrona'=>2,'losowac_od'=>1,'losowac_do'=>15),
                    array('nazwa'=>'Kopnięcie obrotowe','ilosc_punktow'=>2,'ilosc_punktow_obrona'=>2,'losowac_od'=>1,'losowac_do'=>15),
                    array('nazwa'=>'Low kick','ilosc_punktow'=>2,'ilosc_punktow_obrona'=>2,'losowac_od'=>1,'losowac_do'=>13),
                    array('nazwa'=>'Front kick','ilosc_punktow'=>2,'ilosc_punktow_obrona'=>2,'losowac_od'=>1,'losowac_do'=>13),
                    array('nazwa'=>'Middle kick','ilosc_punktow'=>2,'ilosc_punktow_obrona'=>2,'losowac_od'=>1,'losowac_do'=>13),
                )),

            )
        );

    }

}

