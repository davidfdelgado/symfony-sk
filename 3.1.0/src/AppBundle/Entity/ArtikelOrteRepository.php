<?php

// src/AppBundle/Entity/ShopScansRepository.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class ArtikelOrteRepository extends EntityRepository
{

    public function findAllActive(){

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('o, k, a, art, akl, kl, kz, ktz, kt')
            ->from('AppBundle:ArtikelOrte', 'o')
            ->Join('o.aOKategorien', 'k', 'WITH', 'k.aKAktiv = 1')
            ->Join('k.aKArt', 'art')
            ->leftJoin('k.aKPoints', 'akl')
            ->leftJoin('akl.aklKl', 'kl')
            ->Join('k.aKArtikel', 'a', 'WITH', 'a.aArt = 2 and a.aAktiv = 1')
            ->leftjoin('k.aKZeiten', 'kz', 'WITH', 'kz.aAbDatum >= :heute')
            ->leftjoin('k.aKZeitenTabelle', 'kt', 'WITH', ':heute BETWEEN kt.aztVon and kt.aztBis or kt.aztVon > :heute')
            ->leftjoin('kt.aztZeiten', 'ktz')
            ->orderBy('o.aOId', 'ASC', 'art.aAId', 'DESC', 'k.aKName', 'ASC')
            ->setParameter('heute', date('Y-m-d'))
        ;

        $query = $qb->getQuery();

        $result = $query->getResult();

        return $result;

    }


    public function findAllByArt( $aoid = null ){

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('o, k, a, art')
            ->from('AppBundle:ArtikelOrte', 'o')
            ->Join('o.aOKategorien', 'k')
            ->Join('k.aKArt', 'art')
            ->leftJoin('k.aKArtikel', 'a')
            ->orderBy('o.aOId', 'ASC', 'art.aAId', 'DESC')
        ;

        if($aoid){
            $qb->where('o.aOId = '.$aoid);
        }

        $query = $qb->getQuery();

        $result = $query->getResult();

        foreach($result as $ort){
            foreach($ort->getAOKategorien() as $kategorien){

                if(!$ort->getAOArten()->contains( $kategorien->getAKArt() )){
                    $ort->getAOArten()->add( $kategorien->getAKArt() );
                }

                if(!$kategorien->getAKArt()->getAAKategorien()->contains( $kategorien)){
                    $kategorien->getAKArt()->getAAKategorien()->add( $kategorien);
                }
            }
        }

        dump($result);

        return $result;

    }

}