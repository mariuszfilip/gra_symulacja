<?php
/**
 * Date: 26.10.15
 * Time: 19:25
 * @author Mariusz Filipkowski
 */

namespace Klub\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ZawodnikFilter implements InputFilterAwareInterface
{
    public $id;
    public $artist;
    public $title;
    protected $inputFilter;                       // <-- Add this variable


    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'pseudonim',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 18,
                        ),
                    ),
                    array('name' => 'Regex',
                          'options'=>array(
                            'pattern' => '/[a-zA-Z]/',
                            'messages' => array(
                                \Zend\Validator\Regex::INVALID => 'Nie można wprowadzać cyfr, znaków specjalnych po za "-" ani przekleństw.',
                                \Zend\Validator\Regex::NOT_MATCH => 'Nie można wprowadzać cyfr, znaków specjalnych po za "-" ani przekleństw.'
                            )
                        )
                    )
                ),

            ));



            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }



}
