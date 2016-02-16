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
 * @Table(name="taktyka_parter")
 * @ORM\Entity(repositoryClass="Walki\Repository\TaktykaParterRepository")
 */
class TaktykaParter extends EntityAbstract{

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id_taktyki_parter;


    /**
     * @Column(type="integer")
     */
    protected $parter_techniki_konczace;

    /**
     * @Column(type="integer")
     */
    protected $parter_uderzenia;


    /**
     * @Column(type="integer")
     */
    protected $parter_pref_walka_parter;

    /**
     * @Column(type="integer")
     */
    protected $parter_dazenie_walka_klincz;

    /**
     * @Column(type="integer")
     */
    protected $parter_walka_na_punkty;

    /**
     * @Column(type="integer")
     */
    protected $parter_proba_skonczenia;

    /**
     * @Column(type="integer")
     */
    protected $parter_aktywna_walka;

    /**
     * @Column(type="integer")
     */
    protected $parter_pasywna_walka;

    /**
     * @Column(type="integer")
     */
    protected $parter_uderzenia_lokciami;


    /**
     * @Column(type="integer")
     */
    protected $parter_ground_pound;

    /**
     * @return mixed
     */
    public function pobierzIdTaktykiParter()
    {
        return $this->id_taktyki_parter;
    }

    /**
     * @param mixed $id_taktyki_parter
     */
    public function ustawIdTaktykiParter($id_taktyki_parter)
    {
        $this->id_taktyki_parter = $id_taktyki_parter;
    }

    /**
     * @return mixed
     */
    public function pobierzParterTechnikiKonczace()
    {
        return $this->parter_techniki_konczace;
    }

    /**
     * @param mixed $parter_techniki_konczace
     */
    public function ustawParterTechnikiKonczace($parter_techniki_konczace)
    {
        $this->parter_techniki_konczace = $parter_techniki_konczace;
    }

    /**
     * @return mixed
     */
    public function pobierzParterUderzenia()
    {
        return $this->parter_uderzenia;
    }

    /**
     * @param mixed $parter_uderzenia
     */
    public function ustawParterUderzenia($parter_uderzenia)
    {
        $this->parter_uderzenia = $parter_uderzenia;
    }

    /**
     * @return mixed
     */
    public function pobierzParterPrefWalkaParter()
    {
        return $this->parter_pref_walka_parter;
    }

    /**
     * @param mixed $parter_pref_walka_parter
     */
    public function ustawParterPrefWalkaParter($parter_pref_walka_parter)
    {
        $this->parter_pref_walka_parter = $parter_pref_walka_parter;
    }

    /**
     * @return mixed
     */
    public function pobierzParterDazenieWalkaKlincz()
    {
        return $this->parter_dazenie_walka_klincz;
    }

    /**
     * @param mixed $parter_dazenie_walka_klincz
     */
    public function ustawParterDazenieWalkaKlincz($parter_dazenie_walka_klincz)
    {
        $this->parter_dazenie_walka_klincz = $parter_dazenie_walka_klincz;
    }

    /**
     * @return mixed
     */
    public function pobierzParterWalkaNaPunkty()
    {
        return $this->parter_walka_na_punkty;
    }

    /**
     * @param mixed $parter_walka_na_punkty
     */
    public function ustawParterWalkaNaPunkty($parter_walka_na_punkty)
    {
        $this->parter_walka_na_punkty = $parter_walka_na_punkty;
    }

    /**
     * @return mixed
     */
    public function pobierzParterProbaSkonczenia()
    {
        return $this->parter_proba_skonczenia;
    }

    /**
     * @param mixed $parter_proba_skonczenia
     */
    public function ustawParterProbaSkonczenia($parter_proba_skonczenia)
    {
        $this->parter_proba_skonczenia = $parter_proba_skonczenia;
    }

    /**
     * @return mixed
     */
    public function pobierzParterAktywnaWalka()
    {
        return $this->parter_aktywna_walka;
    }

    /**
     * @param mixed $parter_aktywna_walka
     */
    public function ustawParterAktywnaWalka($parter_aktywna_walka)
    {
        $this->parter_aktywna_walka = $parter_aktywna_walka;
    }

    /**
     * @return mixed
     */
    public function pobierzParterPasywnaWalka()
    {
        return $this->parter_pasywna_walka;
    }

    /**
     * @param mixed $parter_pasywna_walka
     */
    public function ustawParterPasywnaWalka($parter_pasywna_walka)
    {
        $this->parter_pasywna_walka = $parter_pasywna_walka;
    }

    /**
     * @return mixed
     */
    public function pobierzParterUderzeniaLokciami()
    {
        return $this->parter_uderzenia_lokciami;
    }

    /**
     * @param mixed $parter_uderzenia_lokciami
     */
    public function ustawParterUderzeniaLokciami($parter_uderzenia_lokciami)
    {
        $this->parter_uderzenia_lokciami = $parter_uderzenia_lokciami;
    }

    /**
     * @return mixed
     */
    public function pobierzParterGroundPound()
    {
        return $this->parter_ground_pound;
    }

    /**
     * @param mixed $parter_ground_pound
     */
    public function ustawParterGroundPound($parter_ground_pound)
    {
        $this->parter_ground_pound = $parter_ground_pound;
    }



}