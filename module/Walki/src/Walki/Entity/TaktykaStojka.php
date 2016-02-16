<?php
/**
 * Date: 21.10.15
 * Time: 14:29
 * @author Mariusz Filipkowski
 */

namespace Walki\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity as Entity;
use Doctrine\ORM\Mapping\Table as Table;
use Doctrine\ORM\Mapping\Id as Id;
use Doctrine\ORM\Mapping\GeneratedValue as GeneratedValue;
use Doctrine\ORM\Mapping\Column as Column;
use Walki\Entity\EntityAbstract;

/**
 * @Entity
 * @Table(name="taktyka_stojka")
 * @ORM\Entity(repositoryClass="Walki\Repository\TaktykaStojkaRepository")
 */
class TaktykaStojka extends EntityAbstract{

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id_taktyki_stojka;


    /**
     * @Column(type="integer")
     */
    protected $stojka_styl_ofensywny;


    /**
     * @Column(type="integer")
     */
    protected $stojka_walka_z_kontry;

    /**
     * @Column(type="integer")
     */
    protected $stojka_uderzenia_piesciami;


    /**
     * @Column(type="integer")
     */
    protected $stojka_techniki_nozne;

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
    protected $stojka_bardzo_mocne_uderzenia;

    /**
     * @Column(type="integer")
     */
    protected $stojka_mocne_uderzenia;

    /**
     * @Column(type="integer")
     */
    protected $stojka_pref_walka_klincz;


    /**
     * @Column(type="integer")
     */
    protected $stojka_trzym_walka_dystans;

    /**
     * @Column(type="integer")
     */
    protected $stojka_utrzymanie_walki;

    /**
     * @Column(type="integer")
     */
    protected $stojka_dozenie_parter;

    /**
     * @return mixed
     */
    public function pobierzIdTaktykiStojka()
    {
        return $this->id_taktyki_stojka;
    }

    /**
     * @param mixed $id_taktyki_stojka
     */
    public function ustawIdTaktykiStojka($id_taktyki_stojka)
    {
        $this->id_taktyki_stojka = $id_taktyki_stojka;
    }

    /**
     * @return mixed
     */
    public function pobierzStojkaStylOfensywny()
    {
        return $this->stojka_styl_ofensywny;
    }

    /**
     * @param mixed $stojka_styl_ofensywny
     */
    public function ustawStojkaStylOfensywny($stojka_styl_ofensywny)
    {
        $this->stojka_styl_ofensywny = $stojka_styl_ofensywny;
    }

    /**
     * @return mixed
     */
    public function pobierzStojkaWalkaZKontry()
    {
        return $this->stojka_walka_z_kontry;
    }

    /**
     * @param mixed $stojka_walka_z_kontry
     */
    public function ustawStojkaWalkaZKontry($stojka_walka_z_kontry)
    {
        $this->stojka_walka_z_kontry = $stojka_walka_z_kontry;
    }

    /**
     * @return mixed
     */
    public function pobierzStojkaUderzeniaPiesciami()
    {
        return $this->stojka_uderzenia_piesciami;
    }

    /**
     * @param mixed $stojka_uderzenia_piesciami
     */
    public function ustawStojkaUderzeniaPiesciami($stojka_uderzenia_piesciami)
    {
        $this->stojka_uderzenia_piesciami = $stojka_uderzenia_piesciami;
    }

    /**
     * @return mixed
     */
    public function pobierzStojkaTechnikiNozne()
    {
        return $this->stojka_techniki_nozne;
    }

    /**
     * @param mixed $stojka_techniki_nozne
     */
    public function ustawStojkaTechnikiNozne($stojka_techniki_nozne)
    {
        $this->stojka_techniki_nozne = $stojka_techniki_nozne;
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
    public function pobierzStojkaBardzoMocneUderzenia()
    {
        return $this->stojka_bardzo_mocne_uderzenia;
    }

    /**
     * @param mixed $stojka_bardzo_mocne_uderzenia
     */
    public function ustawStojkaBardzoMocneUderzenia($stojka_bardzo_mocne_uderzenia)
    {
        $this->stojka_bardzo_mocne_uderzenia = $stojka_bardzo_mocne_uderzenia;
    }

    /**
     * @return mixed
     */
    public function pobierzStojkaMocneUderzenia()
    {
        return $this->stojka_mocne_uderzenia;
    }

    /**
     * @param mixed $stojka_mocne_uderzenia
     */
    public function ustawStojkaMocneUderzenia($stojka_mocne_uderzenia)
    {
        $this->stojka_mocne_uderzenia = $stojka_mocne_uderzenia;
    }

    /**
     * @return mixed
     */
    public function pobierzStojkaPrefWalkaKlincz()
    {
        return $this->stojka_pref_walka_klincz;
    }

    /**
     * @param mixed $stojka_pref_walka_klincz
     */
    public function ustawStojkaPrefWalkaKlincz($stojka_pref_walka_klincz)
    {
        $this->stojka_pref_walka_klincz = $stojka_pref_walka_klincz;
    }

    /**
     * @return mixed
     */
    public function pobierzStojkaTrzymWalkaDystans()
    {
        return $this->stojka_trzym_walka_dystans;
    }

    /**
     * @param mixed $stojka_trzym_walka_dystans
     */
    public function ustawStojkaTrzymWalkaDystans($stojka_trzym_walka_dystans)
    {
        $this->stojka_trzym_walka_dystans = $stojka_trzym_walka_dystans;
    }

    /**
     * @return mixed
     */
    public function pobierzStojkaUtrzymanieWalki()
    {
        return $this->stojka_utrzymanie_walki;
    }

    /**
     * @param mixed $stojka_utrzymanie_walki
     */
    public function ustawStojkaUtrzymanieWalki($stojka_utrzymanie_walki)
    {
        $this->stojka_utrzymanie_walki = $stojka_utrzymanie_walki;
    }

    /**
     * @return mixed
     */
    public function pobierzStojkaDozenieParter()
    {
        return $this->stojka_dozenie_parter;
    }

    /**
     * @param mixed $stojka_dozenie_parter
     */
    public function ustawStojkaDozenieParter($stojka_dozenie_parter)
    {
        $this->stojka_dozenie_parter = $stojka_dozenie_parter;
    }




}