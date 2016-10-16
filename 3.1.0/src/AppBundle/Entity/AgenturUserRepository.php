<?php

// src/AppBundle/Entity/AgenturUserRepository.php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

class AgenturUserRepository extends EntityRepository implements UserLoaderInterface
{
    public function findFullInfosBy($bn){

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('au, av')
            ->from('AppBundle:AgenturUser', 'au')
            ->join('au.auVid', 'av')
            ->Where('au.auBn = :bn')
            ->setParameter('bn', $bn );


        $query = $qb->getQuery();

        $result = $query->getOneOrNullResult();


        return $result;

    }

    public function loadUserByUsername($username)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('au, av')
            ->from('AppBundle:AgenturUser', 'au')
            ->join('au.auVid', 'av')
            ->Where('au.auBn = :bn')
            ->setParameter('bn', $username );


        $query = $qb->getQuery();

        $result = $query->getOneOrNullResult();


        return $result;
    }

    public function findScanHistorie(AgenturUser $agenturUser)
    {

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('sc, b, k')
            ->from('AppBundle:ShopScans', 'sc')
            ->join('sc.scBNr', 'b')
            ->join('sc.scK', 'k')
            ->Where('sc.scAu = :user')
            ->setParameter('user', $agenturUser)
            ->setMaxResults(25)
            ->orderBy('sc.scScanned', 'DESC')
        ;


        $query = $qb->getQuery();

        $result = $query->getResult();


        return $result;

    }
}