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
 * @Table(name="umiejetnosci_ofensywne_zawodnika")
 * @ORM\Entity(repositoryClass="Klub\Repository\ZawodnikRepository")
 */
class UmiejetnosciOfensywne extends EntityAbstract{
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
    protected $stojka_kopniecia;

    /**
     * @Column(type="integer")
     */
    protected $stojka_kolana;

    /**
     * @Column(type="integer")
     */
    protected $stojka_klincz;

    /**
     * @Column(type="integer")
     */
    protected $stojka_obalenia;

    /**
     * @Column(type="integer")
     */
    protected $stojka_uderzenia;

    /**
     * @Column(type="integer")
     */
    protected $parter_groundpound;

    /**
     * @Column(type="integer")
     */
    protected $parter_submission;


    /**
     * @Column(type="integer")
     */
    protected $parter_lokcie;


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
    public function pobierzStojkaKopniecia()
    {
        return $this->stojka_kopniecia;
    }

    /**
     * @param mixed $stojka_kopniecia
     */
    public function ustawStojkaKopniecia($stojka_kopniecia)
    {
        $this->stojka_kopniecia = $stojka_kopniecia;
    }

    /**
     * @return mixed
     */
    public function pobierzStojkaKolana()
    {
        return $this->stojka_kolana;
    }

    /**
     * @param mixed $stojka_kolana
     */
    public function ustawStojkaKolana($stojka_kolana)
    {
        $this->stojka_kolana = $stojka_kolana;
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
    public function pobierzStojkaObalenia()
    {
        return $this->stojka_obalenia;
    }

    /**
     * @param mixed $stojka_obalenia
     */
    public function ustawStojkaObalenia($stojka_obalenia)
    {
        $this->stojka_obalenia = $stojka_obalenia;
    }

    /**
     * @return mixed
     */
    public function pobierzStojkaUderzenia()
    {
        return $this->stojka_uderzenia;
    }

    /**
     * @param mixed $stojka_uderzenia
     */
    public function ustawStojkaUderzenia($stojka_uderzenia)
    {
        $this->stojka_uderzenia = $stojka_uderzenia;
    }

    /**
     * @return mixed
     */
    public function pobierzParterGroundpound()
    {
        return $this->parter_groundpound;
    }

    /**
     * @param mixed $parter_groundpound
     */
    public function ustawParterGroundpound($parter_groundpound)
    {
        $this->parter_groundpound = $parter_groundpound;
    }

    /**
     * @return mixed
     */
    public function pobierzParterSubmission()
    {
        return $this->parter_submission;
    }

    /**
     * @param mixed $parter_submission
     */
    public function ustawParterSubmission($parter_submission)
    {
        $this->parter_submission = $parter_submission;
    }

    /**
     * @return mixed
     */
    public function pobierzParterLokcie()
    {
        return $this->parter_lokcie;
    }

    /**
     * @param mixed $parter_lokcie
     */
    public function ustawParterLokcie($parter_lokcie)
    {
        $this->parter_lokcie = $parter_lokcie;
    }


}