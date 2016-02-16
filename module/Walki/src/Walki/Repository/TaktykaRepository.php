<?php
/**
 * Date: 21.10.15
 * Time: 14:31
 * @author Mariusz Filipkowski
 */

namespace Walki\Repository;
use \Doctrine\ORM\EntityRepository;

class TaktykaRepository extends EntityRepository{

    public function dodaj(\Walki\Entity\Taktyka $zawodnik){

        $this->getEntityManager()->persist($zawodnik);
        $this->getEntityManager()->flush();
        return $zawodnik;
    }

    public function zapisz(\Walki\Entity\Taktyka $zawodnik){

        $this->getEntityManager()->merge($zawodnik);
        $this->getEntityManager()->flush();
        return $zawodnik;
    }

    public function pobierzTaktykiUzytkownika($idUzytkownika){
        return $this->findBy(array('id_uzytkownika'=>$idUzytkownika));
    }

    public function znajdzPoIdTaktyki($idTaktyki){
        return $this->findOneBy(array('id_taktyki'=>$idTaktyki));
    }

}