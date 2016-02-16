<?php
/**
 * Date: 31.10.15
 * Time: 20:04
 * @author Mariusz Filipkowski
 */

namespace Klub\View\Helper;
use Zend\View\Helper\AbstractHelper;

class Stylebazowe extends AbstractHelper
{
    public function __invoke()
    {
        return $this->_pobierzStyle();
    }

    public function pobierz(){
        $aStyle = $this->_pobierzStyle();
        $aLista = array();
        foreach($aStyle as $aMin){
            $aLista[]=   array(
                'value' => $aMin['id'],
                'label'=> $aMin['nazwa'],
                'label_attributes' => array(
                    'id' => 'option'.$aMin['id'],
                    'class'=>'label_dodaj_zawodnika'
                ),
            );
        }
        return $aLista;
    }

    private function _pobierzStyle(){
        $aMiniaturki = array(
            array('id'=>'1','plik'=>'BJJ.jpg','nazwa'=>'Submission fighting'),
            array('id'=>'2','plik'=>'Box.jpg','nazwa'=>'Boks'),
            array('id'=>'3','plik'=>'MuayThai.jpg','nazwa'=>'Muay thai'),
            array('id'=>'4','plik'=>'Zapasy.png','nazwa'=>'Zapasy'),


        );
        return $aMiniaturki;
    }
}



