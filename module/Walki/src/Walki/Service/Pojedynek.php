<?php
/**
 * Date: 17.11.15
 * Time: 19:50
 * @author Mariusz Filipkowski
 */

namespace Walki\Service;

use Walki\Entity\Taktyka;
use Klub\Entity\Zawodnik;

/**
 * Class Pojedynek
 * @package Walki\Service
 */
class Pojedynek{


    /**
     * @var int
     */
    private $_iloscPunktow = 0;

    /**
     * @var Zawodnik
     */
    private $_zawodnik;


    /**
     * @var Taktyka
     */
    private $_taktyka;



    /**
     * Pojedynek constructor.
     * @param Zawodnik $zawodnik
     * @param Taktyka $taktyka
     */
    public function __construct(Zawodnik $zawodnik , Taktyka $taktyka)
    {
        $this->_zawodnik = $zawodnik;
        $this->_taktyka = $taktyka;
    }


    /**
     * stojka - test czy zawodnik bedzie ofensywny
     */
    public function testStojkaOfensywy(){
        return $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja() + rand(1, 10) +
        (($this->_taktyka->pobierzStojka()->pobierzStojkaStylOfensywny()/100)*10);
    }


    /**
     * stojka (atak) ->test obalenia
     */
    public function testStojkaObalenia(){
        return $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzStojkaObalenia()+
        rand(1, 10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
            $this->_zawodnik->pobierzAtrybuty()->pobierzZrecznosc()+
            $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();
    }

    /**
     * stojka (obrona) ->test obrona przed obaleniami
     */
    public function testStojkaObronaPrzedObaleniami(){
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaObronaPrzedObaleniami()+rand(1, 15)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzZrecznosc()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();
    }

    /**
     * stojka (klincz) ->próba przejscia do klincza
     */
    public function testStojkaPrzejscieKlincz(){
        return $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzStojkaKlincz()+
        rand(1, 10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzZrecznosc()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();
    }

    /**
     * stojka (klincz) ->próba przejscia do klincza
     */
    public function testStojkaObronaPrzedPrzejsciemKlincz(){
        return $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzStojkaKlincz()+
        rand(1, 10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzZrecznosc()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();
    }


    public function testStojkaUderzeniaAtak($sila){
        if($sila == 'bm'){
            $max = 13;
        }else{
            $max = 10;
        }
        return $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzStojkaUderzenia()+
        rand(1, $max)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzBalans()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();
    }


    /**
     * @return mixed
     */
    public function testStojkaUderzeniaObrona(){
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaObrona()+
        rand(1, 10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();
    }

    /**
     * @return mixed
     */
    public function testStojkaKontratakAtak($sila){
        if($sila == 'bm'){
            $max = 12;
        }else{
            $max = 10;
        }

        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaKontratak()+
        rand(1, $max)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzZrecznosc()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();
    }

    /**
     * @return mixed
     */
    public function testStojkaKontratakObrona(){
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaKontratak()+
        rand(1, 10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzEksplozywnosc()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();
    }

    public function testStojkaUderzeniaKopnieciaAtak($sila)
    {
        if($sila == 'bm'){
            $max = 13;
        }else{
            $max = 10;
        }
        return $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzStojkaKopniecia()+
        rand(1, $max)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzBalans()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();
    }

    /**
     *
     *  TAKTYKA
            Utrzymywanie walki w stójce
            VS
            Dążenie do walki w parterze
     *
     */
    public function taktykaStojkaVSParter(){

        if($this->_taktyka->pobierzStojka()->pobierzStojkaUtrzymanieWalki() > $this->_taktyka->pobierzStojka()->pobierzStojkaDozenieParter()){
            return 's';
        }
        return 'p';
    }


    /**
     * TAKTYKA
            Preferowana walka w klinczu
            VS
            Trzymanie walki na dystans
     *
     * @return string
     */
    public function taktykaStojkaKlinczVSDystans(){
        if($this->_taktyka->pobierzStojka()->pobierzStojkaPrefWalkaKlincz() > $this->_taktyka->pobierzStojka()->pobierzStojkaTrzymWalkaDystans()){
            return 'k';
        }
        return 'd';
    }

    /**
     * @return string
     */
    public function taktykaStojkaBardzoMocneUderzeniaVSMocneUderzenia(){
        if($this->_taktyka->pobierzStojka()->pobierzStojkaBardzoMocneUderzenia() > $this->_taktyka->pobierzStojka()->pobierzStojkaMocneUderzenia()){
            return 'bm';
        }
        return 'm';
    }

    /**
     * @return string
     */
    public function taktykaStojkaPiesciNogi(){
        if($this->_taktyka->pobierzStojka()->pobierzStojkaUderzeniaPiesciami() > $this->_taktyka->pobierzStojka()->pobierzStojkaTechnikiNozne()){
            return 'p';
        }
        return 'n';
    }

    /**
     * @return mixed
     */
    public function pobierzPseudonimZawodnika(){
        return $this->_zawodnik->pobierzPseudonim();
    }

    /**
     * @return Zawodnik
     */
    public function pobierzZawodnik()
    {
        return $this->_zawodnik;
    }

    /**
     * @param Zawodnik $zawodnik
     */
    public function ustawZawodnik($zawodnik)
    {
        $this->_zawodnik = $zawodnik;
    }

    /**
     * @return Taktyka
     */
    public function pobierzTaktyka(){
        return $this->_taktyka;
    }

    /**
     * @param $iloscPkt
     */
    public function dodajPunkty($iloscPkt){
        $this->_iloscPunktow += (int)$iloscPkt;
    }

    /**
     * @return int
     */
    public function pobierzIloscPunktow()
    {
        return $this->_iloscPunktow;
    }

    public function taktykaStojkaKolanaVsKopniecia()
    {
        if($this->_taktyka->pobierzStojka()->pobierzStojkaKolana() > $this->_taktyka->pobierzStojka()->pobierzStojkaKopniecia()){
                return 'kolana';
        }
        return 'kopniecia';
    }


    public function testKontratakAtakTechnikiNozne($aTechnika)
    {

        //Kontratak + Balans + Kondycja + 1k13/1k15/1k17 [Mocne uderzenia/Bardzo mocne uderzenia/Kolana]
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaKontratak()+
        rand($aTechnika['losowac_od'], $aTechnika['losowac_do'])+
        $this->_zawodnik->pobierzAtrybuty()->pobierzEksplozywnosc()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();
    }

    public function testKontratakObronaTechnikiNozne()
    {
        //Kontratak + Eksplozywność + Kondycja + 1k10
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaKontratak()+
        rand(1, 10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzEksplozywnosc()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();

    }

    public function testParterOfensywy()
    {
        return $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzParterSubmission()+
        rand(1,10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzZrecznosc();

    }

    /*
     *  2# Def.grappling + 1k10 + Siła + Kondycja + Zręczność
     */
    public function testParterKonratak()
    {
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzParterDefGrapping()+rand(1,10)+$this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja()+$this->_zawodnik->pobierzAtrybuty()->pobierzZrecznosc();
    }
    /*
     *  1# Submission + 1k10 + Wzrost_zawodnika*0.4 + Siła + Kondycja + Zręczność
     */
    public function testParterKontrolaPozycjiAtak()
    {
        return $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzParterSubmission()+
        rand(1,10)+
        ($this->_zawodnik->pobierzWzrost()*0.4)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzZrecznosc();

    }
    /*
     * 2# Def.grappling + 1k10 + Wzrost_zawodnika*0.4 + Siła + Kondycja + Zręczność
     */
    public function testParterKontrolaPozycjiObrona()
    {
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzParterDefGrapping()+
        rand(1,10)+
        ($this->_zawodnik->pobierzWzrost()*0.4)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzZrecznosc();
    }
    /*
     *  2# Obrona + 1k10 + Siła + Kondycja
     */
    public function testParterObrona()
    {
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaObrona()+
        rand(1,10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();

    }
    /*
     * 1# Ground&Pound + 1k10 + Siła + Kondycja
     */
    public function testParterGroundPoundAtak()
    {
        return $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzParterGroundpound()+
        rand(1,10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();

    }
    /*
     * 1# Łokcie + Uderzenia + 1k10 + Siła + Kondycja + Eksplozywność
     */
    public function testParterKontratakLokcie()
    {
        return $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzParterLokcie()+
        rand(1,10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzEksplozywnosc();
    }
    /*
     * 2# Obrona + Uderzenia + 1k15 + Siła + Kondycja + Balans
     */
    public function testParterObronaKontratakLokcie()
    {
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaObrona()+
        $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzStojkaUderzenia()+
        rand(1,15)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzBalans();
    }
    /*
     * 1# Łokcie + 1k10 + Siła + Kondycja
     */
    public function testParterLokcieAtak()
    {
        return $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzParterLokcie()+
        rand(1,10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();

    }
    /*
     * 2# Obrona + 1k10 + Siła + Kondycja
     */
    public function testObronaLokcie()
    {
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaObrona()+
        rand(1,15)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();
    }

    /*
     1# Submission + 1k10 + Wzrost_zawodnika*0.4 + Zręczność + Kondycja
 */
    public function testParterTechnikiKonczaceKontratak()
    {
        return $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzParterSubmission()+
        rand(1,10)+
        ($this->_zawodnik->pobierzWzrost()*0.4)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzZrecznosc();

    }

    /*
     2# Def.grappling + 1k15 + Wzrost_zawodnika*0.4 + Zręczność + Kondycja
 */
    public function testParterTechnikiKonczaceKontratakObrona($max)
    {
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzParterDefGrapping()+
        rand(1,$max)+
        ($this->_zawodnik->pobierzWzrost()*0.4)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzZrecznosc();
    }

    /*
     *    #2 Klincz + Kondycja + Siła + 1k10
     */
    public function testKlinczOfensywy()
    {
        return $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzStojkaKlincz()+
        rand(1,10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja();

    }
    /*
     *  1# Obalenia + 1k10 + Siła + Kondycja + Klincz
     */
    public function testKlinczObalenia()
    {
        return $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzStojkaObalenia()+
        $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzStojkaKlincz()+
        rand(1,10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila();

    }
    /*
     * 2# Obr.przed.obaleniami + 1k15 + Siła + Kondycja + Klincz
     */
    public function testKlinczObronaPrzedObaleniami()
    {
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaObronaPrzedObaleniami()+
        $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaKlincz()+
        rand(1,15)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila();
    }
    /*
     * #1 Klincz + Kontratak + Kondycja + Eksplozywność + 1k10
     */
    public function testKlinczKontratak()
    {
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaKlincz()+
        $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaKontratak()+
        rand(1,10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzEksplozywnosc();
    }
    /*
     *  #2 Klincz + Kontratak + Kondycja + Balans + 1k10
     */
    public function testKlinczKontratakObrona()
    {
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaKlincz()+
        $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaKontratak()+
        rand(1,10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzBalans();
    }

    /*
     * 1# Klincz + 1k10 + Siła + Kondycja + Uderzenia
     */

    public function testKlinczUderzeniaGlowaTulow()
    {
        return $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzStojkaKlincz()+
        $this->_zawodnik->pobierzUmiejetnosciOf()->pobierzStojkaUderzenia()+
        rand(1,10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila();

    }
    /*
     * 2# Klincz +1k10 + Siła + Kondycja + Obrona
     */
    public function testKlinczObronaUderzenia()
    {
        return $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaKlincz()+
        $this->_zawodnik->pobierzUmiejetnoscDef()->pobierzStojkaObrona()+
        rand(1,10)+
        $this->_zawodnik->pobierzAtrybuty()->pobierzKondycja()+
        $this->_zawodnik->pobierzAtrybuty()->pobierzSila();
    }


}