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
use Walki\Entity\TaktykaStojka;
use Walki\Entity\TaktykaKlincz;
use Walki\Entity\TaktykaParter;
/**
 * @Entity
 * @Table(name="taktyka_ewidencja")
 * @ORM\Entity(repositoryClass="Walki\Repository\TaktykaRepository")
 */
class Taktyka extends EntityAbstract{

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id_taktyki;


    /**
     * @Column(type="integer")
     */
    protected $id_uzytkownika;

    /**
     * @Column(type="integer")
     */
    protected $id_walki;

    /**
     * @Column(type="integer")
     */
    protected $pozwol_klinczowac;

    /**
     * @Column(type="integer")
     */
    protected $pozwol_na_obalenie;

    /**
     * @Column(type="integer")
     */
    protected $pozwol_zerwac;

    /**
     * @Column(type="integer")
     */
    protected $zostan_stojka;

    /**
     * @Column(type="integer")
     */
    protected $obalenia_po_ciosie;

    /**
     * @Column(type="integer")
     */
    protected $uderzenia_po_ciosie;
    /**
     * @Column(type="string")
     */
    protected $nazwa;


    /**
     * @Column(type="datetime")
     */
    private $data_dodania;

    /**
     * @ORM\OneToOne(targetEntity="Walki\Entity\TaktykaKlincz",  cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id_taktyki_klincz", referencedColumnName="id_taktyki_klincz")
     **/
    private $klincz;


    /**
     * @ORM\OneToOne(targetEntity="Walki\Entity\TaktykaStojka",  cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id_taktyki_stojka", referencedColumnName="id_taktyki_stojka")
     **/
    private $stojka;

    /**
     * @ORM\OneToOne(targetEntity="Walki\Entity\TaktykaParter",  cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id_taktyki_parter", referencedColumnName="id_taktyki_parter")
     **/
    private $parter;

    /**
     * @return mixed
     */
    public function pobierzIdTaktyki()
    {
        return $this->id_taktyki;
    }

    /**
     * @param mixed $id_taktyki
     */
    public function ustawIdTaktyki($id_taktyki)
    {
        $this->id_taktyki = $id_taktyki;
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
     * @return mixed
     */
    public function pobierzIdWalki()
    {
        return $this->id_walki;
    }

    /**
     * @param mixed $id_walki
     */
    public function ustawIdWalki($id_walki)
    {
        $this->id_walki = $id_walki;
    }

    /**
     * @return mixed
     */
    public function pobierzNazwa()
    {
        return $this->nazwa;
    }

    /**
     * @param mixed $nazwa
     */
    public function ustawNazwa($nazwa)
    {
        $this->nazwa = $nazwa;
    }

    /**
     * @return TaktykaKlincz
     */
    public function pobierzKlincz()
    {
        return $this->klincz;
    }

    /**
     * @param mixed $klincz
     */
    public function ustawKlincz($klincz)
    {
        $this->klincz = $klincz;
    }

    /**
     * @return TaktykaStojka
     */
    public function pobierzStojka()
    {

        return $this->stojka;
    }

    /**
     * @param mixed $stojka
     */
    public function ustawStojka($stojka)
    {
        $this->stojka = $stojka;
    }

    /**
     * @return TaktykaParter
     */
    public function pobierzParter()
    {
        return $this->parter;
    }

    /**
     * @param mixed $parter
     */
    public function ustawParter($parter)
    {
        $this->parter = $parter;
    }

    /**
     * @return mixed
     */
    public function pobierzDataDodania()
    {
        return $this->data_dodania;
    }

    /**
     * @param mixed $data_dodania
     */
    public function ustawDataDodania($data_dodania)
    {
        $this->data_dodania = $data_dodania;
    }

    /**
     * @return mixed
     */
    public function pobierzPozwolKlinczowac()
    {
        return $this->pozwol_klinczowac;
    }

    /**
     * @param mixed $pozwol_klinczowac
     */
    public function ustawPozwolKlinczowac($pozwol_klinczowac)
    {
        $this->pozwol_klinczowac = $pozwol_klinczowac;
    }

    /**
     * @return mixed
     */
    public function pobierzPozwolNaObalenie()
    {
        return $this->pozwol_na_obalenie;
    }

    /**
     * @param mixed $pozwol_na_obalenie
     */
    public function ustawPozwolNaObalenie($pozwol_na_obalenie)
    {
        $this->pozwol_na_obalenie = $pozwol_na_obalenie;
    }

    /**
     * @return mixed
     */
    public function pobierzPozwolZerwac()
    {
        return $this->pozwol_zerwac;
    }

    /**
     * @param mixed $pozwol_zerwac
     */
    public function ustawPozwolZerwac($pozwol_zerwac)
    {
        $this->pozwol_zerwac = $pozwol_zerwac;
    }

    /**
     * @return mixed
     */
    public function pobierzZostanStojka()
    {
        return $this->zostan_stojka;
    }

    /**
     * @param mixed $zostan_stojka
     */
    public function ustawZostanStojka($zostan_stojka)
    {
        $this->zostan_stojka = $zostan_stojka;
    }

    /**
     * @return mixed
     */
    public function pobierzObaleniaPoCiosie()
    {
        return $this->obalenia_po_ciosie;
    }

    /**
     * @param mixed $obalenia_po_ciosie
     */
    public function ustawObaleniaPoCiosie($obalenia_po_ciosie)
    {
        $this->obalenia_po_ciosie = $obalenia_po_ciosie;
    }

    /**
     * @return mixed
     */
    public function pobierzUderzeniaPoCiosie()
    {
        return $this->uderzenia_po_ciosie;
    }

    /**
     * @param mixed $uderzenia_po_ciosie
     */
    public function ustawUderzeniaPoCiosie($uderzenia_po_ciosie)
    {
        $this->uderzenia_po_ciosie = $uderzenia_po_ciosie;
    }


}