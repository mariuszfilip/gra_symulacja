<?php
/**
 * Date: 31.10.15
 * Time: 20:04
 * @author Mariusz Filipkowski
 */

namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;

class Miniaturkihelper extends AbstractHelper
{
    public function __invoke()
    {
        return $this->_pobierzMiniaturki();
    }

    public function pobierz(){
        $aMiniaturki = $this->_pobierzMiniaturki();
        $aLista = array();
        foreach($aMiniaturki as $aMin){
            $aLista[]=   array(
                'value' => $aMin['id'],
                'label_attributes' => array(
                    'id' => 'option'.$aMin['id'],
                ),
            );
        }
        return $aLista;
    }


    private function _pobierzMiniaturki(){
        $aMiniaturki = array(
            array('id'=>'1','plik'=>'1.PNG'),
            array('id'=>'2','plik'=>'2.PNG'),
            array('id'=>'3','plik'=>'3.PNG'),
            array('id'=>'4','plik'=>'4.PNG'),
            array('id'=>'5','plik'=>'5.PNG'),
            array('id'=>'6','plik'=>'6.PNG'),
            array('id'=>'7','plik'=>'7.PNG'),


        );
        return $aMiniaturki;
    }
}



