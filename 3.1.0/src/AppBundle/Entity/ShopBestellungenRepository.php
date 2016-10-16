<?php

// src/AppBundle/Entity/ShopBestellungenRepository.php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ShopBestellungenRepository extends EntityRepository
{
    public function findByWithAllInfos($nr = null){

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('b, p, k, m, py')
            ->from('AppBundle:ShopBestellungen', 'b')
            ->leftjoin('b.bPositionen', 'p')
            ->leftjoin('b.bMitteilungen', 'm')
            ->leftjoin('b.bZahlungen', 'py')
            ->join('b.bKid', 'k')
            ->Where('b.nr = :nr')
            ->setParameter('nr', $nr);

        $query = $qb->getQuery();

        $result = $query->getOneOrNullResult();
        
        return $result;
    }

    public function findVorgaenge($options = array(), $art = null){

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('b, p, k')
            ->from('AppBundle:ShopBestellungen', 'b')
            ->join('b.bPositionen', 'p')
            ->join('b.bKid', 'k')
            ->setFirstResult($options['start']);

        if($options['bart']) {
            $qb->where('b.bArt = '.$options['bart']);
        }

        if($options['order']['0']['column']){

            switch($options['order']['0']['column']){
                case 1:
                    $field = "b.bArt";
                    break;
                case 2:
                    $field = "b.bRnnr";
                    break;
                case 3:
                    $field = "b.bSumme";
                    break;
                case 4:
                    $field = "b.bCreated";
                    break;
                case 5:
                    $field = "b.bBezahlt";
                    break;
                case 6:
                    $field = "b.bBezahlArt";
                    break;
                default:
                    $field = "b.Nr";
                    break;
            }

            $dir = $options['order']['0']['dir'] ?: 'ASC';

            $qb->orderBy($field, $dir);
        } else {
            $qb->orderBy('b.nr', 'DESC');
        }
            $qb->setMaxResults($options['length']);


        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function findRnnr($rnnr, $user = null){

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('b, p, pk, ak, sc, k')
            ->from('AppBundle:ShopBestellungen', 'b')
            ->join('b.bPositionen', 'p')
            ->join('p.pTid', 'pk')
            ->join('pk.pkKategorie', 'ak')
            ->leftJoin('b.bSc', 'sc', 'WITH', 'sc.scBNr = b.nr and sc.scK = ak.aKId')
            ->join('b.bKid', 'k')
            ->Where('b.bRnnr = :rnnr')
            ->setParameter('rnnr', $rnnr );

        $query = $qb->getQuery();

        $result = $query->getOneOrNullResult();

        return $result;
    }

    public function findVorgangForCheckin($rnnr, $user = null, $kat = null){

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('b, p, pk, ak, sc, k, v')
            ->from('AppBundle:ShopBestellungen', 'b')
            ->join('b.bPositionen', 'p')
            ->join('p.pTid', 'pk')
            ->join('pk.pkKategorie', 'ak')
            ->leftJoin('b.bSc', 'sc', 'WITH', 'sc.scBNr = b.nr and sc.scK = ak.aKId')
            ->join('b.bKid', 'k')
            ->join('ak.aKAnbieterId', 'v')
            ->Where('b.bRnnr = :rnnr or b.nr = :rnnr')
            ->andWhere('b.bArt in ( 3 , 4 )')
            ->setParameter('rnnr', $rnnr );
        
        if($user) {
            
            if( $user->getAuScanAll() == true ){
                
            } elseif( $user->getAuVid() ) {
                
                
                    
            }
            
        }

        if($kat){
            $qb->andWhere('ak.aKId = '.$kat);
        }
        
        $query = $qb->getQuery();

        $result = $query->getOneOrNullResult();

        return $result;
    }
    
    public function findAllVbRechnungen(AgenturUser $user){

        $qb = $this->getEntityManager()->createQueryBuilder();
        
        $qb->select('b, do, av, py')
            ->from('AppBundle:ShopBestellungen', 'b')
            ->leftJoin('b.bDocs', 'do')
            ->join('b.bVid', 'av', 'WITH', 'av.avId = :vbid')
            ->join('b.bZahlungen', 'py', 'WITH', 'py.paytype = 1')
            ->Where('b.bArt = 3')
            ->orderBy('b.bCreated', 'DESC')
            ->setParameter('vbid', $user->getAuVid()->getAvId() )
            ;

        $query = $qb->getQuery();

        $result = $query->getResult();

        return $result;
    }

    public function findAllVbVorgaenge(AgenturUser $user){

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('b, do, av')
            ->from('AppBundle:ShopBestellungen', 'b')
            ->leftJoin('b.bDocs', 'do')
            ->join('b.bVid', 'av', 'WITH', 'av.avId = :vbid')
            ->Where('b.bArt = 4')
            ->orderBy('b.bCreated', 'DESC')
            ->setParameter('vbid', $user->getAuVid()->getAvId() )
        ;

        $query = $qb->getQuery();

        $result = $query->getResult();

        return $result;
    }


}