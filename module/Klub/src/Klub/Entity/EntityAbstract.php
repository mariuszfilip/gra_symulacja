<?php
/**
 * Date: 07.11.15
 * Time: 16:41
 * @author Mariusz Filipkowski
 */
namespace Klub\Entity;
abstract class EntityAbstract{


    /**
     * @author Mariusz Filipkowski
     * @desc Przepisuje z array do obiektu
     * @param $array
     */
    public function from_array($array)
    {
        foreach(get_object_vars($this) as $attrName => $attrValue){
            $str= ltrim ($attrName);
            if(array_key_exists($str,$array)){
                $this->{$attrName} = $array[$str];
            }
        }

    }


    /**
     * @author Mariusz Filipkowski
     * @return array
     */
    public function toArray()
    {
        $aDane = array();
        foreach(get_object_vars($this) as $attrName => $attrValue){
            $str= ltrim ($attrName);
            $aDane[$str]= $attrValue;
        }
        return $aDane;

    }

    public function zwieksz($nazwa,$wartosc)
    {
        if(property_exists($this, $nazwa)){
            $this->$nazwa = $this->$nazwa+$wartosc;
        }
    }

    public function zwiekszWszystkie($wartosc)
    {
        foreach(get_object_vars($this) as $attrName => $attrValue){
            if(property_exists($this, $attrName) && $attrName != 'id_zawodnika'){
                $this->$attrName = $this->$attrName+$wartosc;
            }
        }
    }
}