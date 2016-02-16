<?php
/**
 * Date: 21.10.15
 * Time: 18:52
 * @author Mariusz Filipkowski
 */

namespace Klub\Form;

use Zend\Form\Form;
use Zend\Db\Adapter\AdapterInterface;

class ZawodnikForm extends Form{

    public function __construct(AdapterInterface $dbAdapter,\Klub\View\Helper\Stylebazowe $style)
    {
        $this->adapter =$dbAdapter;
        parent::__construct('zawodnik');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'pseudonim',
            'type' => 'Text',
            'options' => array(
                'label' => 'Pseudonim',
            ),
        ));
        $aLista = $style->pobierz();

        $this->add(
            array(
                'type' => 'Zend\Form\Element\Radio',
                'name' => 'id_stylu_bazowego',
                'options' => array(
                    'value_options' => $aLista,
                ),
                'attributes' => array(
                    'id'=>"fcaptcha-id"
                )
            )
        );


        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'id_kategorii_wagowej',
            'tabindex' =>2,
            'options' => array(
                'label' => 'Kategoria wagowa',
                'empty_option' => 'Wybierz',
                'value_options' =>  $this->getOptionsForSelect('s_kategorie_wagowe'),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'id_lokalizacji',
            'tabindex' =>2,
            'options' => array(
                'label' => 'Lokalizacja',
                'empty_option' => 'Wybierz',
                'value_options' => $this->getOptionsForSelect('lokalizacja_panstwa'),
            ),

        ));

        $this->add(array(
            'name' => 'wzrost',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Zapisz zawodnika',
                'id' => 'submitbutton',
            ),
        ));
    }

    private function getOptionsForSelect($sNazwa)
    {
        $dbAdapter = $this->adapter;
        $sql       = 'SELECT id,nazwa  FROM '.$sNazwa.' where status=1 ORDER BY nazwa desc';
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['id']] = $res['nazwa'];
        }
        return $selectData;
    }
}