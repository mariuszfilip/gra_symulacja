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
use Klub\Entity\Zawodnik;

/**
 * @Entity
 * @Table(name="atrybuty_zawodnika")
 * @ORM\Entity(repositoryClass="Klub\Repository\ZawodnikRepository")
 */
class Atrybuty extends EntityAbstract{

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer")
     * @ORM\OneToOne(targetEntity="Klub\Entity\Zawodnik")
     * @ORM\JoinColumn(name="id_zawodnika", referencedColumnName="id_zawodnika", nullable=false)
     */
    protected $id_zawodnika;


    /**
     * @Column(type="integer")
     */
    protected $sila;

    /**
     * @Column(type="integer")
     */
    protected $zrecznosc;

    /**
     * @Column(type="integer")
     */
    protected $eksplozywnosc;

    /**
     * @Column(type="integer")
     */
    protected $balans;

    /**
     * @Column(type="integer")
     */
    protected $kondycja;

    /**
     * @Column(type="integer")
     */
    protected $zdrowie;

    /**
     * @return mixed
     */
    public function pobierzSila()
    {
        return $this->sila;
    }

    /**
     * @param mixed $sila
     */
    public function ustawSila($sila)
    {
        $this->sila = $sila;
    }

    /**
     * @return mixed
     */
    public function pobierzIdZawodnika()
    {
        return $this->id_zawodnika;
    }

    /**
     * @param mixed $id_zawodnika
     */
    public function ustawIdZawodnika($id_zawodnika)
    {
        $this->id_zawodnika = $id_zawodnika;
    }

    /**
     * @return mixed
     */
    public function pobierzZrecznosc()
    {
        return $this->zrecznosc;
    }

    /**
     * @param mixed $zrecznosc
     */
    public function ustawZrecznosc($zrecznosc)
    {
        $this->zrecznosc = $zrecznosc;
    }

    /**
     * @return mixed
     */
    public function pobierzEksplozywnosc()
    {
        return $this->eksplozywnosc;
    }

    /**
     * @param mixed $eksplozywnosc
     */
    public function ustawEksplozywnosc($eksplozywnosc)
    {
        $this->eksplozywnosc = $eksplozywnosc;
    }

    /**
     * @return mixed
     */
    public function pobierzBalans()
    {
        return $this->balans;
    }

    /**
     * @param mixed $balans
     */
    public function ustawBalans($balans)
    {
        $this->balans = $balans;
    }

    /**
     * @return mixed
     */
    public function pobierzKondycja()
    {
        return $this->kondycja;
    }

    /**
     * @param mixed $kondycja
     */
    public function ustawKondycja($kondycja)
    {
        $this->kondycja = $kondycja;
    }

    /**
     * @return mixed
     */
    public function pobierzZdrowie()
    {
        return $this->zdrowie;
    }

    /**
     * @param mixed $zdrowie
     */
    public function ustawZdrowie($zdrowie)
    {
        $this->zdrowie = $zdrowie;
    }


}