<?php
/**
 * Date: 31.10.15
 * Time: 20:04
 * @author Mariusz Filipkowski
 */

namespace Walki\View\Helper;
use Zend\View\Helper\AbstractHelper;

class Taktyka extends AbstractHelper
{
    public function __invoke()
    {
        return array(
            'stojka' => $this->_polaStojka(),
            'parter' => $this->_polaParter(),
            'klincz' => $this->_polaKlincz(),
            'stojka_grupy' => $this->_polaGrupa($this->_polaStojka()),
            'parter_grupy' => $this->_polaGrupa($this->_polaParter()),
            'klincz_grupy' => $this->_polaGrupa($this->_polaKlincz()),
        );
    }

    public function pobierzListeWszystkichPol(){
        return array_merge($this->_polaStojka(),$this->_polaParter(),$this->_polaKlincz());
    }

    private function _polaGrupa($aPola){
        $aGrupy = array();
        $i = 1;
        foreach($aPola as $klucz => $pole){
            if(count($aGrupy[$i]) == 2){
                $i++;
            }
            $aGrupy[$i][]= $pole;
        }
        return $aGrupy;
    }

    private function _polaStojka(){
        $aListaPolStojka = array(
            array('name'=>'stojka_styl_ofensywny','label'=>'Styl ofensywny','class'=>'suwak_taktyka suwak101','id_suwaka'=>'101'),
            array('name'=>'stojka_walka_z_kontry','label'=>'Walka z kontry','class'=>'suwak_taktyka suwak102','id_suwaka'=>'102'),
            array('name'=>'stojka_uderzenia_piesciami','label'=>'Uderzenia pięściami','class'=>'suwak_taktyka suwak103','id_suwaka'=>'103'),
            array('name'=>'stojka_techniki_nozne','label'=>'Techniki nożne','class'=>'suwak_taktyka suwak104','id_suwaka'=>'104'),
            array('name'=>'stojka_kopniecia','label'=>'Kopniecia','class'=>'suwak_taktyka suwak105','id_suwaka'=>'105'),
            array('name'=>'stojka_kolana','label'=>'Kolana','class'=>'suwak_taktyka suwak106','id_suwaka'=>'106'),
            array('name'=>'stojka_bardzo_mocne_uderzenia','label'=>'Bardzo mocne uderzenia','class'=>'suwak_taktyka suwak107','id_suwaka'=>'107'),
            array('name'=>'stojka_mocne_uderzenia','label'=>'Mocne uderzenia','class'=>'suwak_taktyka suwak108','id_suwaka'=>'108'),
            array('name'=>'stojka_pref_walka_klincz','label'=>'Preferowana walka w klinczu','class'=>'suwak_taktyka suwak109','id_suwaka'=>'109'),
            array('name'=>'stojka_trzym_walka_dystans','label'=>'Trzymania walki na dystans','class'=>'suwak_taktyka suwak110','id_suwaka'=>'110'),
            array('name'=>'stojka_utrzymanie_walki','label'=>'Utrzymanie walki w stójce','class'=>'suwak_taktyka suwak111','id_suwaka'=>'111'),
            array('name'=>'stojka_dozenie_parter','label'=>'Dążenie walki w parterze','class'=>'suwak_taktyka suwak112','id_suwaka'=>'112'),

        );
        return $aListaPolStojka;
    }

    private function _polaParter(){
        $aListaPolParter = array(
            array('name'=>'parter_techniki_konczace','label'=>'Techniki kończące','class'=>'suwak_taktyka suwak200','id_suwaka'=>'200'),
            array('name'=>'parter_uderzenia','label'=>'Uderzenia','class'=>'suwak_taktyka suwak201','id_suwaka'=>'201'),
            array('name'=>'parter_pref_walka_parter','label'=>'Preferowana walka w parterze','class'=>'suwak_taktyka suwak202','id_suwaka'=>'202'),
            array('name'=>'parter_dazenie_walka_klincz','label'=>'Dążenie do walki w klinczu','class'=>'suwak_taktyka suwak203','id_suwaka'=>'203'),
            array('name'=>'parter_walka_na_punkty','label'=>'Walka na punkty','class'=>'suwak_taktyka suwak204','id_suwaka'=>'204'),
            array('name'=>'parter_proba_skonczenia','label'=>'Próby skończenia przed czasem','class'=>'suwak_taktyka suwak205','id_suwaka'=>'205'),
            array('name'=>'parter_aktywna_walka','label'=>'Aktywna walka w parterze','class'=>'suwak_taktyka suwak206','id_suwaka'=>'206'),
            array('name'=>'parter_pasywna_walka','label'=>'Pasywna walka w parterze','class'=>'suwak_taktyka suwak207','id_suwaka'=>'207'),
            array('name'=>'parter_uderzenia_lokciami','label'=>'Uderzenia łokciami','class'=>'suwak_taktyka suwak208','id_suwaka'=>'208'),
            array('name'=>'parter_ground_pound','label'=>'Ground&pound','class'=>'suwak_taktyka suwak209','id_suwaka'=>'209'),

        );
        return $aListaPolParter;
    }

    private function _polaKlincz(){
        $aListaPolKlincz = array(
            array('name'=>'klincz_trzymanie_walki','label'=>'Trzymanie walki w klinczu','class'=>'suwak_taktyka suwak300','id_suwaka'=>'300'),
            array('name'=>'klincz_zrywanie_klinczu','label'=>'Zrywanie klinczu','class'=>'suwak_taktyka suwak301','id_suwaka'=>'301'),
            array('name'=>'klincz_utrzymanie_walki','label'=>'Utrzymanie walki w klinczu','class'=>'suwak_taktyka suwak302','id_suwaka'=>'302'),
            array('name'=>'klincz_dazenie_do_walki_parter','label'=>'Dążenie do walki w parterze','class'=>'suwak_taktyka suwak303','id_suwaka'=>'303'),
            array('name'=>'klincz_proba_skonczenia_przez_uderzenia','label'=>'Próba skończenia walki przez uderzenia','class'=>'suwak_taktyka suwak304','id_suwaka'=>'304'),
            array('name'=>'klincz_punktowanie','label'=>'Punktowanie(brudny boks)','class'=>'suwak_taktyka suwak305','id_suwaka'=>'305'),
            array('name'=>'klincz_uderzenia_kolanami','label'=>'Uderzenia kolanami','class'=>'suwak_taktyka suwak306','id_suwaka'=>'306'),
            array('name'=>'klincz_uderzenia_lokciami','label'=>'Uderzenia łokciami','class'=>'suwak_taktyka suwak307','id_suwaka'=>'307'),
            array('name'=>'klincz_bardzo_mocne_uderzenia','label'=>'Bardzo mocne uderzenia','class'=>'suwak_taktyka suwak308','id_suwaka'=>'308'),
            array('name'=>'klincz_mocne_uderzenia','label'=>'Mocne uderzenia','class'=>'suwak_taktyka suwak309','id_suwaka'=>'309'),
        );
        return $aListaPolKlincz;

    }
}



