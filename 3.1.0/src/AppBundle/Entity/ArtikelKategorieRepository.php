<?php

// src/AppBundle/Entity/ArtieklKategorieRepository.php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ArtikelKategorieRepository extends EntityRepository
{
    public function findForTimetable($id = null){

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('k, kz, kt, ktz')
            ->from('AppBundle:ArtikelKategorie', 'k')
            ->leftjoin('k.aKZeiten', 'kz')
            ->leftjoin('k.aKZeitenTabelle', 'kt')
            ->leftjoin('kt.aztZeiten', 'ktz')
            ->Where('k.aKId = :id')
            ->setParameter('id', $id)
        ;

        $query = $qb->getQuery();

        $result = $query->getOneOrNullResult();
        
        return $result;
    }

    public function findByTimetableByArtikel($id = null){

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('k, kz, kt, ktz, a')
            ->from('AppBundle:ArtikelKategorie', 'k')
            ->leftjoin('k.aKZeiten', 'kz')
            ->leftjoin('k.aKZeitenTabelle', 'kt')
            ->leftjoin('kt.aztZeiten', 'ktz')
            ->join('k.aKArtikel', 'a')
            ->Where('a.aId = :id')
            ->setParameter('id', $id);

        $query = $qb->getQuery();

        $result = $query->getOneOrNullResult();

        return $result;
    }

    public function findAllInfos($id = null){

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('k, o, kz, kt, ktz, vt, rt')
            ->from('AppBundle:ArtikelKategorie', 'k')
            ->leftjoin('k.aKOid', 'o')
            ->leftjoin('k.aKVtext', 'vt')
            ->leftjoin('k.aKRtext', 'rt')
            ->leftjoin('k.aKZeiten', 'kz')
            ->leftjoin('k.aKZeitenTabelle', 'kt')
            ->leftjoin('kt.aztZeiten', 'ktz')
            ->Where('k.aKId = :id')
            ->setParameter('id', $id);

        $query = $qb->getQuery();

        $result = $query->getOneOrNullResult();
        dump($result);
        return $result;

    }

}