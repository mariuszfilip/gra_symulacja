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

    public function __construct(AdapterInterface $dbAdapter)
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

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'id_stylu_bazowego',
            'tabindex' =>2,
            'options' => array(
                'label' => 'Styl bazowy',
                'empty_option' => 'Wybierz',
                'value_options' => $this->getOptionsForSelect('s_style_bazowe;'),
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'id_kategorii_wagowej',
            'tabindex' =>2,
            'options' => array(
                'label' => 'Kategoria wagowa',
                'empty_option' => 'Wybierz',
                'value_options' =>  $this->getOptionsForSelect('s_kategorie_wagowe'),
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'id_lokalizacji',
            'tabindex' =>2,
            'options' => array(
                'label' => 'Lokalizacja',
                'empty_option' => 'Wybierz',
                'value_options' => $this->getOptionsForSelect('s_kategorie_wagowe'),
            )
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
        $sql       = 'SELECT id,nazwa  FROM '.$sNazwa.' where status=1 ORDER BY kolejnosc desc';
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['id']] = $res['nazwa'];
        }
        return $selectData;
    }
}