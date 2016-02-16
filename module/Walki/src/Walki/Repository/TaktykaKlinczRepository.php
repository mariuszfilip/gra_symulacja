<?php
/**
 * Date: 21.10.15
 * Time: 14:31
 * @author Mariusz Filipkowski
 */

namespace Walki\Repository;
use \Doctrine\ORM\EntityRepository;

class TaktykaKlinczRepository extends EntityRepository{

    public function zapisz(\Walki\Entity\TaktykaKlincz $zawodnik){

        $this->getEntityManager()->persist($zawodnik);
        $this->getEntityManager()->flush();

        return true;
    }

}