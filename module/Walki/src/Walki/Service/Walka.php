<?php
/**
 * Date: 17.11.15
 * Time: 20:27
 * @author Mariusz Filipkowski
 */

namespace Walki\Service;

class Walka{

    private $_iloscPrzesc = 0;
    /**
     * @var array
     */
    private $_komunikaty = array();
    /**
     * @var \Walki\Service\Pojedynek
     */
    private $_zawodnikA;
    /**
     * @var \Walki\Service\Pojedynek
     */
    private $_zawodnikB;
    /**
     * @var \Walki\Service\Pojedynek
     */
    private $_zawodnikOff;
    /**
     * @var \Walki\Service\Pojedynek
     */
    private $_zawodnikDef;

    /**
     * @var Techniki
     */
    private $_techniki;

    public function __construct(Pojedynek $zawodnikA,Pojedynek $zawodnikB)
    {
        $this->_zawodnikA = $zawodnikA;
        $this->_zawodnikB = $zawodnikB;
        $this->_techniki = new Techniki();
    }


    public function rozpocznijStojka(){
        try{
            $this->testStojkaOff();
        }catch (\Exception $e){
            return true;
        }
    }

    private function testStojkaOff()
    {
        $this->_sprawdzIloscPrzejsc();
        $stojkaA = $this->_zawodnikA->testStojkaOfensywy();
        $stojkaB = $this->_zawodnikB->testStojkaOfensywy();
        if($stojkaA > $stojkaB){
            $this->_zawodnikOff = $this->_zawodnikA;
            $this->_zawodnikDef = $this->_zawodnikB;
        }else{
            $this->_zawodnikOff = $this->_zawodnikB;
            $this->_zawodnikDef = $this->_zawodnikA;
        }
        $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' jest  ofensywny';
        $this->taktykaStojkaPoTestOff();

    }

    private function taktykaStojkaPoTestOff(){
        if($this->_zawodnikOff->taktykaStojkaVsParter() == 's'){
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wybrał : trzymanie walki w stójce';
            if($this->_zawodnikOff->taktykaStojkaKlinczVSDystans() == 'd'){
                $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wybrał : walka na dystans';
                $this->_taktykaWalkaDystans();
            }else{
                $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wybrał : preferowana walka klincz';
                if($this->_zawodnikDef->pobierzTaktyka()->pobierzPozwolKlinczowac() == 1){
                    $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika().' pozwolił na klincz';
                    $this->testParterOff();
                }
                //akcja Zmiana płaszczyzny walki
                /*
                 * Test (Akcja: Zmiana płaszczyzny walki)
                    #1 Klincz + Kondycja + Siła + Zręczność + 1k10
                    VS
                    #2 Klincz + Kondycja + Siła + Zręczność + 1k10

                 */
                if($this->_zawodnikOff->testStojkaPrzejscieKlincz() > $this->_zawodnikOff->testStojkaObronaPrzedPrzejsciemKlincz()){
                    $this->_zawodnikOff->dodajPunkty(4);
                    $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrał test i dalsza walka odbędzie się w klinczu';
                    $this->testKlinczOff();
                }else{
                    $this->_zawodnikDef->dodajPunkty(4);
                    $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika().' wygrał test i dalsza walka odbędzie się w stójce';
                    $this->testStojkaOff();
                }
            }
        }else{
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wybrał : dążenie do walki w parterze';
            if($this->_zawodnikDef->pobierzTaktyka()->pobierzPozwolNaObalenie() == 1){
                $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika().' pozwolił na obalenie';
                $this->testParterOff();
            }
            /*
             * TAKTYKA
                Utrzymywanie walki w stójce
                VS
                Dążenie do walki w parterze
             */
            if($this->_zawodnikOff->testStojkaObalenia() > $this->_zawodnikDef->testStojkaObronaPrzedObaleniami()){
                $this->_zawodnikOff->dodajPunkty(6);
                $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrał test i dalsza walka odbędzie się w parterze';
                $this->testParterOff();
            }else{
                $this->_zawodnikDef->dodajPunkty(6);
                $this->testStojkaOff();
            }

        }
    }


    public function pobierzKomunikaty(){
        return $this->_komunikaty;
    }

    private function _sprawdzIloscPrzejsc()
    {
        $this->_iloscPrzesc++;

        if($this->_iloscPrzesc > 20){
           throw new \Exception('Limit przejsc koniec walki');
        }
    }

    private function _taktykaWalkaDystans()
    {
        $silaUderzenia = $this->_zawodnikOff->taktykaStojkaBardzoMocneUderzeniaVSMocneUderzenia();
        $typUderzenia = $this->_zawodnikOff->taktykaStojkaPiesciNogi();

        if($typUderzenia == 'n'){
            $this->_taktykaTechnikiNozne($typUderzenia,$silaUderzenia);
        }else{
            $this->_taktykaUderzeniePiesciami($typUderzenia,$silaUderzenia);

        }


    }

    private function _zmianaZawodnikaOff()
    {
        $zawodnik1 = $this->_zawodnikOff;
        $zawodnik2 = $this->_zawodnikDef;

        $this->_zawodnikOff = $zawodnik2;
        $this->_zawodnikDef = $zawodnik1;

    }

    public function podsumowanie(){
        $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika().' zdobył '.$this->_zawodnikDef->pobierzIloscPunktow().' punkty;';
        $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' zdobył '.$this->_zawodnikOff->pobierzIloscPunktow().' punkty;';
    }

    private function _taktykaUderzeniePiesciami($typUderzenia,$silaUderzenia)
    {
        /**
         * TEST(Akcja: Kontratak)
        1# Kontratak + Eksplozywność + Kondycja +1k10
        VS
        2# Kontratak+ Balans + Kondycja + 1k10/1k12 [Mocne uderzenia/Bardzo mocne uderzenia]
         */

        if($this->_zawodnikDef->testStojkaKontratakObrona() > $this->_zawodnikOff->testStojkaKontratakAtak($silaUderzenia)){
            $this->_zmianaZawodnikaOff();
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrał akcja : Kontratak oraz przejął inicjatywę';
            /**
             * TEST(Akcja: Uderzenia)
            1# Uderzenia + Siła + Kondycja + 1k10
            VS
            2# Obrona + Siła + Kondycja + 1k10
             */
            if($this->_zawodnikOff->testStojkaUderzeniaAtak('m') > $this->_zawodnikDef->testStojkaUderzeniaObrona()){
                $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrał akcja : Uderzenia';
                $this->_zawodnikOff->dodajPunkty(2);
            }else{
                $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika().' obronił akcja : Uderzenia';
                $this->_zawodnikDef->dodajPunkty(2);
            }
            $this->testStojkaOff();

        }else{
            if($this->_zawodnikOff->pobierzTaktyka()->pobierzParter() == 1){
                $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wybrał : walka w parterze';
                $this->testParterOff();
            }
            /**
             *
             * TEST(Akcja: Uderzenia lub Kopnięcia)
            1# Uderzenia/Kopnięcia + Siła + Kondycja + 1k10/1k13
            VS

            2# Obrona + Siła + Kondycja + 1k10
             */

        }
        if($typUderzenia == 'p'){
            $wynik = $this->_zawodnikOff->testStojkaUderzeniaAtak($silaUderzenia);
        }else{
            $wynik = $this->_zawodnikOff->testStojkaUderzeniaKopnieciaAtak($silaUderzenia);
        }

        if($wynik > $this->_zawodnikDef->testStojkaUderzeniaObrona()){
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrał akcja : Uderzenia';
            $this->_zawodnikOff->dodajPunkty(2);
        }else{
            $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika().' obronił akcja : Uderzenia';
            $this->_zawodnikDef->dodajPunkty(2);
        }

        $this->testStojkaOff();
    }

    private function _taktykaTechnikiNozne($typUderzenia, $silaUderzenia)
    {
        $akcja = $this->_zawodnikOff->taktykaStojkaKolanaVsKopniecia();

        /*
         *
         * TEST (Akcja: Kontratak)
            1# Kontratak + Eksplozywność + Kondycja + 1k10
            VS

            2# Kontratak + Balans + Kondycja + 1k13/1k15/1k17 [Mocne uderzenia/Bardzo mocne uderzenia/Kolana]
         */

        if($this->_testStojkaKontratakTechnikiNozne($typUderzenia,$akcja,$akcja)){
                /*
                 * TEST (Akcja: Kopnięcia/Kolana)
                    1# Kopnięcia/Kolana + Siła + Kondycja + 1k10
                    VS

                    2# Obrona + Siła+ Kondycja + 1k10
                 */

            $this->_testStojkaKopnieciaLubKolana($typUderzenia);

            $this->testStojkaOff();

        }else{
            $this->_zmianaZawodnikaOff();
            if($this->_zawodnikOff->pobierzTaktyka()->pobierzObaleniaPoCiosie() > $this->_zawodnikOff->pobierzTaktyka()->pobierzUderzeniaPoCiosie()){
                $this->testParterOff();
            }else{
                $this->testStojkaOff();
            }
        }



    }

    /**
     * @param $typUderzenia
     * @return bool
     */
    private function _testStojkaKontratakTechnikiNozne($typUderzenia,$akcja,$technika)
    {
        $aTechnika = $this->_techniki->pobierzTechnike($akcja,$technika,$typUderzenia);

        //ToDo dokonczyc
        return $this->_zawodnikOff->testKontratakAtakTechnikiNozne($aTechnika)
        > $this->_zawodnikDef->testKontratakObronaTechnikiNozne();
    }

    private function _testStojkaKopnieciaLubKolana($typUderzenia)
    {
        if($this->_zawodnikOff->testStojkaUderzeniaKopnieciaAtak($typUderzenia) > $this->_zawodnikDef->testStojkaUderzeniaObrona()){
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrał akcja : Kopniecia/Uderzenia';
            $this->_zawodnikOff->dodajPunkty(2);
        }else{
            $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika().' wygrał akcja : Kopniecia/Uderzenia';
            $this->_zawodnikOff->dodajPunkty(2);
        }

    }



    private function testParterOff()
    {
        $this->_sprawdzIloscPrzejsc();
        $this->_komunikaty[] = 'Rozpoczęcie walki w parterze.';
        if($this->_zawodnikDef->testParterOfensywy() > $this->_zawodnikOff->testParterOfensywy()){
            $this->_zmianaZawodnikaOff();
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrał test i teraz jest ofensywny.';
        }else{
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' pozostaje zawodnikem ofensynym.';
        }
        $this->_taktykaParterAktywnaVsPasywna();

    }

    private function testKlinczOff()
    {
        $this->_sprawdzIloscPrzejsc();
        $this->_komunikaty[] = 'klincz start';

        /*
         * Test (Akcja: Inicjatywa)
            #1 Klincz + Kondycja+ Siła + 1k10
            VS
            #2 Klincz + Kondycja + Siła + 1k10
         */

        if($this->_zawodnikDef->testKlinczOfensywy() > $this->_zawodnikOff->testKlinczOfensywy()){
            $this->_zmianaZawodnikaOff();
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrał test i teraz jest ofensywny.';
        }else{
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' pozostaje zawodnikem ofensynym.';
        }

        $this->_taktykaKlinczTrzymanieWalkiVSZrywanie();
    }

    private function _taktykaParterAktywnaVsPasywna()
    {
        if($this->_czyParterPasywnaWalka()){
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wybiera taktykę pasywnej walki.';
            /*
             * TEST (Akcja: Kontratak)
                1# Submission + 1k10 + Siła + Kondycja + Zręczność
                VS

                2# Def.grappling+1k10 + Siła + Kondycja + Zręczność
             */


            if($this->_zawodnikOff->testParterOfensywy() > $this->_zawodnikDef->testParterKonratak()){
                $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrywa test: Kontratak.';
                //Todo dodaj punkty
                /*
                 * TEST (Akcja: Pasywna walka w parterze)
                        1# Submission + 1k10 + Siła + Kondycja + Zręczność
                        VS

                        2# Def.grappling + 1k10 + Siła + Kondycja + Zręczność
                 */
                if($this->_zawodnikOff->testParterOfensywy() > $this->_zawodnikDef->testParterKonratak()){
                    $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrywa test: Pasywna walka w parterze.';
                    //Todo dodaj punkty
                }else{
                    $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika().' wygrywa test: Pasywna walka w parterze.';
                    //Todo dodaj punkty
                }
                $this->_komunikaty[] = 'Interwencja sędziego';
                $this->testParterOff();

            }else{
                //Todo dodaj punkty
                $this->_zmianaZawodnikaOff();
                $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrał kontratak i przejmuje ofensywę.';
                $this->_taktykaParterAktywnaVsPasywna();

            }
        }else{
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wybiera taktykę : aktywna walka w parterze.';
            /*
             * TAKTYKA
                Preferowana walka w parterze
                VS
                Dążenie do walki w klinczu
             */
            if($this->_czyParterPreferowanaWalka()){
                $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wybiera taktykę : preferowana walka w parterze.';

                /*
                 * TAKTYKA
                    Walka na punkty
                    VS
                    Próby skończenia przed czasem
                 */
                if($this->_czyParterWalkaNaPunkty()){
                        /*
                         * TEST (Akcja: Kontrola pozycji)
                            1# Submission + 1k10 + Wzrost_zawodnika*0.4 + Siła + Kondycja + Zręczność
                            VS
                            2# Def.grappling + 1k10 + Wzrost_zawodnika*0.4 + Siła + Kondycja + Zręczność
                         */

                    if($this->_zawodnikOff->testParterKontrolaPozycjiAtak() > $this->_zawodnikDef->testParterKontrolaPozycjiObrona()){
                        $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrywa test : Kontrola pozycji.';

                    }else{
                        $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika().' wygrywa test : Kontrola pozycji.';
                    }
                    $this->testStojkaOff();

                }else{
                    $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wybiera taktykę : próby skończenia przed czasem.';
                    /*
                     * TAKTYKA
                        Techniki kończące
                        VS
                        Uderzenia
                     */
                    if($this->_czyParterTechnikiKonczace()){
                        $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wybiera taktykę : techniki kończące.';

                        $this->_testParterKontratakTechnikiKonczace();
                        $this->_testParterTechnikiKonczace();


                    }else{
                        if($this->_czyParterTaktykaGroundPound()){
                            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wybiera taktykę : ground&pound.';
                            /*
                            *TEST (Akcja: Ground&pound)
                                   1# Ground&Pound + 1k10 + Siła + Kondycja
                                   VS
                                   2# Obrona + 1k10 + Siła + Kondycja
                            */
                            if($this->_zawodnikOff->testParterGroundPoundAtak() > $this->_zawodnikDef->testParterObrona()){
                                //Todo dodaj punkty
                                $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrywa test : Ground&pound.';

                            }else{
                                //Todo dodaj punkty
                                $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika().' wygrywa test : Ground&pound.';
                            }
                            $this->testParterOff();
                        }else{
                            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wybiera taktykę : uderzenia łokciami.';
                            $this->_testParterKontratakLokcie();
                            $this->_testParterAkcjaLokcieWParterze();
                            $this->testParterOff();
                        }
                    }
                }


            }else{
                $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wybiera taktykę : dążenie do walki w klinczu.';
                if($this->_zawodnikOff->pobierzTaktyka()->pobierzPozwolKlinczowac()){
                    $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wybrał taktykę : pozwól klinczować.';
                    $this->testKlinczOff();
                }

                /*
                 * TEST (Akcja: Zmiana płaszczyzny walki)
                        1# Submission + 1k10 + Siła + Kondycja + Zręczność
                        VS
                        2# Def.grappling + 1k10 + Siła + Kondycja + Zręczność
                 */
                if($this->_zawodnikOff->testParterOfensywy() > $this->_zawodnikDef->testParterKonratak()){
                    $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrywa test:  Zmiana płaszczyzny walki.';
                    //Todo dodaj punkty
                }else{
                    $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika().' wygrywa test:  Zmiana płaszczyzny walki.';
                    //Todo dodaj punkty
                }

                //Todo interwencja sędziego
                $this->testKlinczOff();
            }

        }

    }

    /**
     * @return bool
     */
    private function _czyParterPasywnaWalka()
    {
        return $this->_zawodnikOff->pobierzTaktyka()->pobierzParter()->pobierzParterPasywnaWalka() >
        $this->_zawodnikOff->pobierzTaktyka()->pobierzParter()->pobierzParterAktywnaWalka();
    }

    /**
     * @return bool
     */
    private function _czyParterPreferowanaWalka()
    {
        return $this->_zawodnikOff->pobierzTaktyka()->pobierzParter()->pobierzParterPrefWalkaParter() >
        $this->_zawodnikOff->pobierzTaktyka()->pobierzParter()->pobierzParterDazenieWalkaKlincz();
    }

    /**
     * @return bool
     */
    private function _czyParterWalkaNaPunkty()
    {
        return $this->_zawodnikOff->pobierzTaktyka()->pobierzParter()->pobierzParterWalkaNaPunkty() >
        $this->_zawodnikOff->pobierzTaktyka()->pobierzParter()->pobierzParterProbaSkonczenia();
    }

    /**
     * @return bool
     */
    private function _czyParterTechnikiKonczace()
    {
        return $this->_zawodnikOff->pobierzTaktyka()->pobierzParter()->pobierzParterTechnikiKonczace() >
        $this->_zawodnikOff->pobierzTaktyka()->pobierzParter()->pobierzParterUderzenia();
    }

    private function _czyParterTaktykaGroundPound()
    {
        return $this->_zawodnikOff->pobierzTaktyka()->pobierzParter()->pobierzParterGroundPound() >
        $this->_zawodnikOff->pobierzTaktyka()->pobierzParter()->pobierzParterUderzeniaLokciami();
    }

    private function _testParterKontratakLokcie()
    {
        /*
           * TEST (Akcja: Kontratak)
              1# Łokcie + Uderzenia + 1k10 + Siła + Kondycja + Eksplozywność
              VS
              2# Obrona + Uderzenia + 1k15 + Siła + Kondycja + Balans
           */
        if($this->_zawodnikOff->testParterKontratakLokcie() > $this->_zawodnikDef->testParterObronaKontratakLokcie()){
            //Todo dodaj punkty
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrywa test : Kontratak Łokcie.';

        }else{
            //Todo dodaj punkty
            $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika().' wygrywa test : Kontratak Łokcie.';
        }

    }

    private function _testParterAkcjaLokcieWParterze()
    {
        /*
         * TEST (Akcja: Łokcie w parterze)
            1# Łokcie + 1k10 + Siła + Kondycja
            VS
            2# Obrona + 1k10 + Siła + Kondycja
         */
        if($this->_zawodnikOff->testParterLokcieAtak() > $this->_zawodnikDef->testObronaLokcie()){
            //Todo dodaj punkty
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika().' wygrywa test : Łokcie w parterze.';

        }else{
            //Todo dodaj punkty
            $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika().' wygrywa test : Łokcie w parterze.';
        }


    }

    private function _testParterKontratakTechnikiKonczace()
    {
        /*
         TEST (Akcja: Kontratak)
             1# Submission + 1k10 + Wzrost_zawodnika*0.4 + Zręczność + Kondycja
               VS
             2# Def.grappling + 1k15 + Wzrost_zawodnika*0.4 + Zręczność + Kondycja
        */
        if ($this->_zawodnikOff->testParterTechnikiKonczaceKontratak()
            > $this->_zawodnikDef->testParterTechnikiKonczaceKontratakObrona(15)
        ) {
            //Todo dodaj punkty
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika()
                . ' wygrywa test : Kontratak techniki kończące.';

        } else {
            //Todo dodaj punkty
            $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika()
                . ' wygrywa test : Kontratak techniki kończące. Staje się zawodnikem ofensywnym';
            $this->_zmianaZawodnikaOff();
            $this->testParterOff();
        }
    }

    private function _testParterTechnikiKonczace()
    {
        /*
                                 * TEST (Akcja: Techniki kończące)
                                1# Submission + 1k10 + Wzrost_zawodnika*0.4 + Zręczność + Kondycja
                                VS

                                2# Def.grappling + 1k10 + Wzrost_zawodnika*0.4 + Zręczność + Kondycja
                                 */

        if ($this->_zawodnikOff->testParterTechnikiKonczaceKontratak()
            > $this->_zawodnikDef->testParterTechnikiKonczaceKontratakObrona(10)){
            //Todo dodaj punkty
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika() . ' wygrywa test : Techniki kończące.';
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika() . ' wygrywa walkę przez nokaut.';
            throw new \Exception('Walk zakończona');

        } else {
            //Todo dodaj punkty
            $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika() . ' wygrywa test : Techniki kończące.';
        }

        $this->testParterOff();
    }

    private function _taktykaKlinczTrzymanieWalkiVSZrywanie()
    {
        if ($this->_zawodnikOff->pobierzTaktyka()->pobierzKlincz()->pobierzKlinczTrzymanieWalki() >
            $this->_zawodnikOff->pobierzTaktyka()->pobierzKlincz()->pobierzKlinczZrywanieKlinczu()
        ) {
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika()
                . '  wybiera taktykę : Trzymanie walki w klinczu';

            /*
             * TAKTYKA
                Utrzymanie walki w klinczu
                VS
                Dążenie do walki w parterze
             */
            if ($this->_zawodnikOff->pobierzTaktyka()->pobierzKlincz()->pobierzKlinczUtrzymanieWalki() >
                $this->_zawodnikOff->pobierzTaktyka()->pobierzKlincz()->pobierzKlinczDazenieDoWalkiParter()
            ) {

                $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika()
                    . '  wybiera taktykę : Utrzymanie walki w klinczu';

                /*
                 * TAKTYKA
                    Próba skończenia walki przez uderzenia
                    VS
                    Punktowanie (brudny boks)
                 */

                if ($this->_zawodnikOff->pobierzTaktyka()->pobierzKlincz()->pobierzKlinczProbaSkonczeniaPrzezUderzenia()
                    >
                    $this->_zawodnikOff->pobierzTaktyka()->pobierzKlincz()->pobierzKlinczPunktowanie()
                ) {
                    /*
                     * TAKTYKA
                        Mocne uderzenia
                        VS
                        Bardzo mocne uderzenia
                     */
                    $uderzenia = 'bm';
                    if ($this->_zawodnikOff->pobierzTaktyka()->pobierzKlincz()->pobierzKlinczMocneUderzenia() >
                        $this->_zawodnikOff->pobierzTaktyka()->pobierzKlincz()->pobierzKlinczBardzoMocneUderzenia()
                    ) {
                        $uderzenia = 'm';
                    }
                    /*
                    * TEST (Akcja: Kontratak)
                       #1 Klincz + Kontratak + Kondycja + Eksplozywność + 1k10
                       VS

                       #2 Klincz + Kontratak + Kondycja + Balans + 1k10
                    */
                    if ($this->_zawodnikOff->testKlinczKontratak() > $this->_zawodnikDef->testKlinczKontratakObrona()) {
                        //Todo dodaj punkty
                        $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika()
                            . '  wygrywa test kontratak.';

                        /*
                         * TEST (Akcja: Uderzenia w głowę/Uderzenia w tułów)
                            1# Klincz + 1k10 + Siła + Kondycja + Uderzenia
                            VS

                            2# Klincz +1k10 + Siła + Kondycja + Obrona
                         */
                        if ($this->_zawodnikOff->testKlinczUderzeniaGlowaTulow() > $this->_zawodnikDef->testKlinczObronaUderzenia()) {
                            //Todo dodaj punkty
                            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika()
                                . '  wygrywa test Uderzenia w głowę/Uderzenia w tułów';

                        }else{
                            //Todo dodaj punkty
                            $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika()
                                . '  broni  Uderzenia w głowę/Uderzenia w tułów';
                        }
                        $this->testKlinczOff();

                    } else {
                        //ToDo dodaj punkty
                        $this->_zmianaZawodnikaOff();
                        $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika()
                            . '  broni test kontratak.Przejmuje inicjatywę.';

                        $this->_taktykaKlinczTrzymanieWalkiVSZrywanie();
                    }

                } else {
                    /*
                     * TEST (Akcja: Brudny boks)
                        1# Klincz + 1k10 + Siła + Kondycja
                        VS

                        2# Klincz + 1k10 + Siła+ Kondycja
                     */
                }

            } else {
                $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika()
                    . '  wybiera taktykę : Dążenie do walki w parterze';
                if ($this->_zawodnikDef->pobierzTaktyka()->pobierzPozwolNaObalenie() == 1) {
                    $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika()
                        . '  wybiera taktykę : Pozwól na zerwanie klinczu';
                    $this->testParterOff();
                }
                /*
                 * TEST (Akcja: Obalenia)
                    1# Obalenia + 1k10 + Siła + Kondycja + Klincz
                    VS

                    2# Obr.przed.obaleniami + 1k15 + Siła + Kondycja + Klincz
                 */
                if ($this->_zawodnikOff->testKlinczObalenia()
                    > $this->_zawodnikDef->testKlinczObronaPrzedObaleniami()
                ) {
                    $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika() . ' wygrał test: Obalenia.';
                    $this->testParterOff();
                } else {
                    $this->_komunikaty[] = $this->_zawodnikDef->pobierzPseudonimZawodnika() . ' wygrał test: Obalenia.';
                    $this->testKlinczOff();
                }
            }


        } else {
            $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika()
                . '  wybiera taktykę : Zrywanie klinczu';
            if ($this->_zawodnikDef->pobierzTaktyka()->pobierzPozwolZerwac()) {
                $this->testStojkaOff();
            }

            /*
             * Test (Akcja: Zmiana płaszczyzny walki)
                #1 Klincz + Kondycja+ Siła + 1k10
                VS
                #2 Klincz + Kondycja + Siła + 1k10
             */
            if ($this->_zawodnikOff->testKlinczOfensywy() > $this->_zawodnikDef->testKlinczOfensywy()) {
                $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika()
                    . ' wygrał test : Zmiana płaszczyzny walki';
                //Todo dodaj punkty
                $this->testStojkaOff();
            } else {
                $this->_komunikaty[] = $this->_zawodnikOff->pobierzPseudonimZawodnika()
                    . ' wygrał test : Zmiana płaszczyzny walki';
                //Todo dodaj punkty
                $this->testKlinczOff();
            }
        }
    }

}