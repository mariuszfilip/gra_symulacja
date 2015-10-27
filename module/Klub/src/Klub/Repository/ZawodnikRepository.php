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
        return $this->find('\Klub\Entity\Zawodnik',$idZawodnika);
    }

    public function dodajZawodnika(\Klub\Entity\Zawodnik $zawodnik){

        $this->getEntityManager()->persist($zawodnik);
        $this->getEntityManager()->flush();

        return true;
    }

}