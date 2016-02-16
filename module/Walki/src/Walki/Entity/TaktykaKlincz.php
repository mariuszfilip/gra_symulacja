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
 * @Table(name="taktyka_klincz")
 * @ORM\Entity(repositoryClass="Walki\Repository\TaktykaKlinczRepository")
 */
class TaktykaKlincz extends EntityAbstract{



    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id_taktyki_klincz;

    /**
     * @Column(type="integer")
     */
    protected $klincz_trzymanie_walki;

    /**
     * @Column(type="integer")
     */
    protected $klincz_zrywanie_klinczu;

    /**
     * @Column(type="integer")
     */
    protected $klincz_utrzymanie_walki;

    /**
     * @Column(type="integer")
     */
    protected $klincz_dazenie_do_walki_parter;

    /**
     * @Column(type="integer")
     */
    protected $klincz_proba_skonczenia_przez_uderzenia;

    /**
     * @Column(type="integer")
     */
    protected $klincz_punktowanie;

    /**
     * @Column(type="integer")
     */
    protected $klincz_uderzenia_kolanami;

    /**
     * @Column(type="integer")
     */
    protected $klincz_uderzenia_lokciami;


    /**
     * @Column(type="integer")
     */
    protected $klincz_bardzo_mocne_uderzenia;


    /**
     * @Column(type="integer")
     */
    protected $klincz_mocne_uderzenia;


    /**
     * @return mixed
     */
    public function pobierzKlinczTrzymanieWalki()
    {
        return $this->klincz_trzymanie_walki;
    }

    /**
     * @param mixed $klincz_trzymanie_walki
     */
    public function ustawKlinczTrzymanieWalki($klincz_trzymanie_walki)
    {
        $this->klincz_trzymanie_walki = $klincz_trzymanie_walki;
    }

    /**
     * @return mixed
     */
    public function pobierzKlinczZrywanieKlinczu()
    {
        return $this->klincz_zrywanie_klinczu;
    }

    /**
     * @param mixed $klincz_zrywanie_klinczu
     */
    public function ustawKlinczZrywanieKlinczu($klincz_zrywanie_klinczu)
    {
        $this->klincz_zrywanie_klinczu = $klincz_zrywanie_klinczu;
    }

    /**
     * @return mixed
     */
    public function pobierzKlinczUtrzymanieWalki()
    {
        return $this->klincz_utrzymanie_walki;
    }

    /**
     * @param mixed $klincz_utrzymanie_walki
     */
    public function ustawKlinczUtrzymanieWalki($klincz_utrzymanie_walki)
    {
        $this->klincz_utrzymanie_walki = $klincz_utrzymanie_walki;
    }

    /**
     * @return mixed
     */
    public function pobierzKlinczDazenieDoWalkiParter()
    {
        return $this->klincz_dazenie_do_walki_parter;
    }

    /**
     * @param mixed $klincz_dazenie_do_walki_parter
     */
    public function ustawKlinczDazenieDoWalkiParter($klincz_dazenie_do_walki_parter)
    {
        $this->klincz_dazenie_do_walki_parter = $klincz_dazenie_do_walki_parter;
    }

    /**
     * @return mixed
     */
    public function pobierzKlinczProbaSkonczeniaPrzezUderzenia()
    {
        return $this->klincz_proba_skonczenia_przez_uderzenia;
    }

    /**
     * @param mixed $klincz_proba_skonczenia_przez_uderzenia
     */
    public function ustawKlinczProbaSkonczeniaPrzezUderzenia($klincz_proba_skonczenia_przez_uderzenia)
    {
        $this->klincz_proba_skonczenia_przez_uderzenia = $klincz_proba_skonczenia_przez_uderzenia;
    }

    /**
     * @return mixed
     */
    public function pobierzKlinczPunktowanie()
    {
        return $this->klincz_punktowanie;
    }

    /**
     * @param mixed $klincz_punktowanie
     */
    public function ustawKlinczPunktowanie($klincz_punktowanie)
    {
        $this->klincz_punktowanie = $klincz_punktowanie;
    }

    /**
     * @return mixed
     */
    public function pobierzKlinczUderzeniaKolanami()
    {
        return $this->klincz_uderzenia_kolanami;
    }

    /**
     * @param mixed $klincz_uderzenia_kolanami
     */
    public function ustawKlinczUderzeniaKolanami($klincz_uderzenia_kolanami)
    {
        $this->klincz_uderzenia_kolanami = $klincz_uderzenia_kolanami;
    }

    /**
     * @return mixed
     */
    public function pobierzKlinczUderzeniaLokciami()
    {
        return $this->klincz_uderzenia_lokciami;
    }

    /**
     * @param mixed $klincz_uderzenia_lokciami
     */
    public function ustawKlinczUderzeniaLokciami($klincz_uderzenia_lokciami)
    {
        $this->klincz_uderzenia_lokciami = $klincz_uderzenia_lokciami;
    }

    /**
     * @return mixed
     */
    public function pobierzKlinczBardzoMocneUderzenia()
    {
        return $this->klincz_bardzo_mocne_uderzenia;
    }

    /**
     * @param mixed $klincz_bardzo_mocne_uderzenia
     */
    public function ustawKlinczBardzoMocneUderzenia($klincz_bardzo_mocne_uderzenia)
    {
        $this->klincz_bardzo_mocne_uderzenia = $klincz_bardzo_mocne_uderzenia;
    }

    /**
     * @return mixed
     */
    public function pobierzKlinczMocneUderzenia()
    {
        return $this->klincz_mocne_uderzenia;
    }

    /**
     * @param mixed $klincz_mocne_uderzenia
     */
    public function ustawKlinczMocneUderzenia($klincz_mocne_uderzenia)
    {
        $this->klincz_mocne_uderzenia = $klincz_mocne_uderzenia;
    }

    /**
     * @return mixed
     */
    public function pobierzIdTaktykiKlincz()
    {
        return $this->id_taktyki_klincz;
    }

    /**
     * @param mixed $id_taktyki_klincz
     */
    public function ustawIdTaktykiKlincz($id_taktyki_klincz)
    {
        $this->id_taktyki_klincz = $id_taktyki_klincz;
    }




}