<?php

// src/AppBundle/Entity/ShopScansRepository.php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class ShopSessionRepository extends EntityRepository
{

    public function findSession($sid){

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('s, w, pk')
            ->from('AppBundle:ShopSession', 's')
            ->leftJoin('s.sWarenkorb', 'w')
            ->leftJoin('w.wcArtikelnummer', 'pk')
            ->Where('s.sSession = :session')

            ->setParameter('session', $sid)
        ;

        $query = $qb->getQuery();

        $result = $query->getOneOrNullResult();

        return $result;

    }

}