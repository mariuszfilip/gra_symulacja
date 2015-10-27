<?php
/**
 * Date: 21.10.15
 * Time: 14:29
 * @author Mariusz Filipkowski
 */

namespace Klub\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity as Entity;
use Doctrine\ORM\Mapping\Table as Table;
use Doctrine\ORM\Mapping\Id as Id;
use Doctrine\ORM\Mapping\GeneratedValue as GeneratedValue;
use Doctrine\ORM\Mapping\Column as Column;

/**
 * @Entity
 * @Table(name="zawodnik")
 * @ORM\Entity(repositoryClass="Klub\Repository\ZawodnikRepository")
 */
class Zawodnik{

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id_zawodnika;


    /**
     * @Column(type="string")
     */
    private $pseudonim;


    /**
     * @Column(type="integer")
     */
    private $id_kategorii_wagowej;


    /**
     * @Column(type="integer")
     */
    private $id_stylu_bazowego;

    /**
     * @Column(type="integer")
     */
    private $id_lokalizacji;


    /**
     * @Column(type="integer");
     */
    private $wzrost;


    /**
     * @Column(type="date")
     */
    private $data_urodzenia;


    /**
     * @Column(type="datetime")
     */
    private $data_dodania;



    /**
     * @return mixed
     */
    public function pobierzIdZawodnika()
    {
        return $this->id_zawodnika;
    }

    /**
     * @return mixed
     */
    public function pobierzPseudonim()
    {
        return $this->pseudonim;
    }

    /**
     * @return mixed
     */
    public function pobierzIdKategoriiWagowej()
    {
        return $this->id_kategorii_wagowej;
    }

    /**
     * @return mixed
     */
    public function pobierzIdStyluBazowego()
    {
        return $this->id_stylu_bazowego;
    }

    /**
     * @return mixed
     */
    public function pobierzWzrost()
    {
        return $this->wzrost;
    }


    /**
     * @return mixed
     */
    public function pobierzDataDodania()
    {
        return $this->data_dodania;
    }

    /**
     * @return mixed
     */
    public function pobierzIdLokalizacji()
    {
        return $this->id_lokalizacji;
    }

    /**
     * @param mixed $id_lokalizacji
     */
    public function ustawIdLokalizacji($id_lokalizacji)
    {
        $this->id_lokalizacji = $id_lokalizacji;
    }

    /**
     * @return mixed
     */
    public function pobierzDataUrodzenia()
    {
        return $this->data_urodzenia;
    }

    /**
     * @param mixed $data_urodzenia
     */
    public function ustawDataUrodzenia($data_urodzenia)
    {
        $this->data_urodzenia = $data_urodzenia;
    }


    /**
     * @param $data
     */
    public function exchangeArray($data)
    {
        $oDate = new \DateTime("NOW");
        $this->id_zawodnika     = (isset($data['id']))     ? $data['id']     : null;
        $this->pseudonim = (isset($data['pseudonim'])) ? $data['pseudonim'] : null;
        $this->id_kategorii_wagowej = (isset($data['id_kategorii_wagowej'])) ? $data['id_kategorii_wagowej'] : null;
        $this->id_stylu_bazowego = (isset($data['id_stylu_bazowego'])) ? $data['id_stylu_bazowego'] : null;
        $this->id_lokalizacji = (isset($data['id_lokalizacji'])) ? $data['id_lokalizacji'] : null;
        $this->wzrost = (isset($data['wzrost'])) ? $data['wzrost'] : 100;
        $this->data_dodania = new \DateTime("NOW");
        $this->data_urodzenia = $oDate->modify('- 18 years');

    }
}