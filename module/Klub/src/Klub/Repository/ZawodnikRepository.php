<?php
/**
 * Date: 21.10.15
 * Time: 14:31
 * @author Mariusz Filipkowski
 */

namespace Klub\Repository;
use \Doctrine\ORM\EntityRepository;

class ZawodnikRepository extends EntityRepository{


    public function getZawodnik($idZawodnika){
        return $this->find($idZawodnika);
    }

    public function dodajZawodnika(\Klub\Entity\Zawodnik $zawodnik){

        $this->getEntityManager()->persist($zawodnik);
        $this->getEntityManager()->flush();

        return true;
    }

    public function pobierzZawodnikowUzytkownika($idUzytkownika){
        return $this->findBy(array('id_uzytkownika'=>$idUzytkownika));
    }

    public function pobierzZawodnika($idZawodnika){
        return $this->findBy(array('id_zawodnika'=>$idZawodnika));
    }

    public function zapisz(\Klub\Entity\Zawodnik $zawodnik)
    {
        $this->getEntityManager()->persist($zawodnik);
        $this->getEntityManager()->flush();
    }

    public function pobierz($idZawodnika){
        return $this->findOneBy(array('id_zawodnika'=>$idZawodnika));
    }

    public function pobierzIlosc($idUzytkownika){
        $oZawodnicy = $this->findBy(array('id_uzytkownika'=>$idUzytkownika));
        return count($oZawodnicy);
    }

}