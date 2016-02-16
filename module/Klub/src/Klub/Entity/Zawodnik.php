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
use Klub\Entity\Atrybuty;

/**
 * @Entity
 * @Table(name="zawodnik")
 * @ORM\Entity(repositoryClass="Klub\Repository\ZawodnikRepository")
 */
class Zawodnik extends EntityAbstract{

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id_zawodnika;


    /**
     * @Column(type="string")
     */
    protected $pseudonim;


    /**
     * @Column(type="integer")
     */
    protected $id_kategorii_wagowej;


    /**
     * @Column(type="integer")
     */
    protected $id_stylu_bazowego;

    /**
     * @Column(type="integer")
     */
    protected $id_lokalizacji;


    /**
     * @Column(type="integer");
     */
    protected $wzrost;


    /**
     * @Column(type="date")
     */
    protected $data_urodzenia;


    /**
     * @Column(type="datetime")
     */
    protected $data_dodania;

    /**
     * @Column(type="integer")
     */
    protected $id_uzytkownika =0;

    /**
     * @ORM\OneToOne(targetEntity="Klub\Entity\Atrybuty")
     * @ORM\JoinColumn(name="id_zawodnika", referencedColumnName="id_zawodnika")
     **/
    protected $atrybuty;

    /**
     * @ORM\OneToOne(targetEntity="Klub\Entity\UmiejetnosciOfensywne")
     * @ORM\JoinColumn(name="id_zawodnika", referencedColumnName="id_zawodnika")
     **/
    protected $umiejetnosci_of;


    /**
     * @ORM\OneToOne(targetEntity="Klub\Entity\UmiejetnosciDefensywne")
     * @ORM\JoinColumn(name="id_zawodnika", referencedColumnName="id_zawodnika")
     **/
    protected $umiejetnosc_def;

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
     * @return mixed
     */
    public function pobierzIdUzytkownika()
    {
        return $this->id_uzytkownika;
    }

    /**
     * @param mixed $id_uzytkownika
     */
    public function ustawIdUzytkownika($id_uzytkownika)
    {
        $this->id_uzytkownika = $id_uzytkownika;
    }

    /**
     * @return Atrybuty
     */
    public function pobierzAtrybuty()
    {
        return $this->atrybuty;
    }

    /**
     * @param mixed $atrybuty
     */
    public function ustawAtrybuty($atrybuty)
    {
        $this->atrybuty = $atrybuty;
    }

    /**
     * @return UmiejetnosciOfensywne
     */
    public function pobierzUmiejetnosciOf()
    {
        return $this->umiejetnosci_of;
    }

    /**
     * @param mixed $umiejetnosci_of
     */
    public function ustawUmiejetnosciOf($umiejetnosci_of)
    {
        $this->umiejetnosci_of = $umiejetnosci_of;
    }

    /**
     * @return UmiejetnosciDefensywne
     */
    public function pobierzUmiejetnoscDef()
    {
        return $this->umiejetnosc_def;
    }

    /**
     * @param mixed $umiejetnosc_def
     */
    public function ustawUmiejetnoscDef($umiejetnosc_def)
    {
        $this->umiejetnosc_def = $umiejetnosc_def;
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
        $this->wzrost = rand(160,210);
        $this->data_dodania = new \DateTime("NOW");
        $this->data_urodzenia = $oDate->modify('- 18 years');

    }
}