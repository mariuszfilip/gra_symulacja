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
 * @Table(name="umiejetnosci_defensywne_zawodnika")
 * @ORM\Entity(repositoryClass="Klub\Repository\ZawodnikRepository")
 */
class UmiejetnosciDefensywne extends EntityAbstract{

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
    protected $stojka_obrona;

    /**
     * @Column(type="integer")
     */
    protected $stojka_obrona_przed_obaleniami;

    /**
     * @Column(type="integer")
     */
    protected $stojka_klincz;

    /**
     * @Column(type="integer")
     */
    protected $stojka_kontratak;

    /**
     * @Column(type="integer")
     */
    protected $parter_def_grapping;

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
    public function pobierzStojkaObrona()
    {
        return $this->stojka_obrona;
    }

    /**
     * @param mixed $stojka_obrona
     */
    public function ustawStojkaObrona($stojka_obrona)
    {
        $this->stojka_obrona = $stojka_obrona;
    }

    /**
     * @return mixed
     */
    public function pobierzStojkaObronaPrzedObaleniami()
    {
        return $this->stojka_obrona_przed_obaleniami;
    }

    /**
     * @param mixed $stojka_obrona_przed_obaleniami
     */
    public function ustawStojkaObronaPrzedObaleniami($stojka_obrona_przed_obaleniami)
    {
        $this->stojka_obrona_przed_obaleniami = $stojka_obrona_przed_obaleniami;
    }

    /**
     * @return mixed
     */
    public function pobierzStojkaKlincz()
    {
        return $this->stojka_klincz;
    }

    /**
     * @param mixed $stojka_klincz
     */
    public function ustawStojkaKlincz($stojka_klincz)
    {
        $this->stojka_klincz = $stojka_klincz;
    }

    /**
     * @return mixed
     */
    public function pobierzStojkaKontratak()
    {
        return $this->stojka_kontratak;
    }

    /**
     * @param mixed $stojka_kontratak
     */
    public function ustawStojkaKontratak($stojka_kontratak)
    {
        $this->stojka_kontratak = $stojka_kontratak;
    }

    /**
     * @return mixed
     */
    public function pobierzParterDefGrapping()
    {
        return $this->parter_def_grapping;
    }

    /**
     * @param mixed $parter_def_grapping
     */
    public function ustawParterDefGrapping($parter_def_grapping)
    {
        $this->parter_def_grapping = $parter_def_grapping;
    }
}