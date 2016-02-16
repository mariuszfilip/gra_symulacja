<?php
/**
 * Date: 07.11.15
 * Time: 12:49
 * @author Mariusz Filipkowski
 */
namespace Walki\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class TaktykaForm extends Form{

    public function __construct(\Walki\View\Helper\Taktyka $taktyka)
    {
        parent::__construct('taktyka');

        $this->add(array(
            'name' => 'id_taktyki',
            'type' => 'Hidden',
        ));


        $this->add(array(
            'name' => 'id_taktyki_parter',
            'type' => 'Hidden',
        ));


        $this->add(array(
            'name' => 'id_taktyki_stojka',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'id_taktyki_klincz',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'nazwa',
            'type' => 'text',
            'attributes'=>array(
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Nazwa',
            )
        ));


        $aListaPol = $taktyka->pobierzListeWszystkichPol();

        foreach($aListaPol as $aPole){
            $this->add(array(
                'name' => $aPole['name'],
                'type' => 'Text',
                'options' => array(
                    'label' => $aPole['label'],
                ),
                'attributes' => array(
                    'class' => $aPole['class'],
                    'size'=>2,
                    'readonly' => 2
                )

            ));
        }
        $this->add(array(
            'name' => 'pozwol_klinczowac',
            'type' => 'checkbox',
            'options' => array(
                'use_hidden_element' => true,
                'label' => 'Pozwól klinczować',
                'checked_value' => 1,
                'unchecked_value' => 0,
            ),
        ));

        $this->add(array(
            'name' => 'pozwol_na_obalenie',
            'type' => 'checkbox',
            'options' => array(
                'use_hidden_element' => true,
                'label' => 'Pozwól na obalenie',
                'checked_value' => 1,
                'unchecked_value' => 0,
            ),
        ));

        $this->add(array(
            'name' => 'pozwol_zerwac',
            'type' => 'checkbox',
            'options' => array(
                'use_hidden_element' => true,
                'label' => 'Pozwól na zerwanie',
                'checked_value' => 1,
                'unchecked_value' => 0,
            ),
        ));

        $this->add(array(
            'name' => 'zostan_stojka',
            'type' => 'checkbox',
            'options' => array(
                'use_hidden_element' => true,
                'label' => 'Zostań w stójce',
                'checked_value' => 1,
                'unchecked_value' => 0,
            ),
        ));

        $this->add(array(
            'name' => 'obalenia_po_ciosie',
            'type' => 'checkbox',
            'options' => array(
                'use_hidden_element' => true,
                'label' => 'Obalenia po ciosie',
                'checked_value' => 1,
                'unchecked_value' => 0,
            ),
        ));
        $this->add(array(
            'name' => 'uderzenia_po_ciosie',
            'type' => 'checkbox',
            'options' => array(
                'use_hidden_element' => true,
                'label' => 'Uderzenia po ciosie',
                'checked_value' => 1,
                'unchecked_value' => 0,
            ),
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
}