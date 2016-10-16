<?php

// src/AppBundle/Entity/ArtikelRepository.php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class ArtikelRepository extends EntityRepository
{
    public function findArtikel($options){

        
        $suche = explode(' ', $options);

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('a, k, o')
            ->from('AppBundle:Artikel', 'a')
            ->join('a.aKid', 'k')
            ->join('k.aKOid', 'o')
            ->setMaxResults(10)
            ->Where('a.aAktiv = 1')
            ->andWhere('a.aArt = 0')
        ;

        foreach($suche as $s){
            $qb->andWhere("a.aName LIKE '%".$s."%' or k.aKName LIKE '%".$s."%'");
        }

        $query = $qb->getQuery();
        $q = $query->getResult();
        return $q;
    }
}