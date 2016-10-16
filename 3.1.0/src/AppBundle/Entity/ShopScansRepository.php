<?php

// src/AppBundle/Entity/ShopScansRepository.php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class ShopScansRepository extends EntityRepository
{
    public function findAllScanedPositions(AgenturUser $agenturUser, $type = null){

        $qb = $this->getEntityManager()->createQueryBuilder();

//        $qb->select('p, b, pk, sc')
//            ->from('AppBundle:ShopScans', 'sc')
//            ->join('sc.scAu', 'au')
//            ->join('sc.scBNr', 'b')
//            ->join('b.bPositionen', 'p')
//            ->join('p.pTid', 'pk')
//            ->Where('au.auVid = :auVid')
//            ->orderBy('sc.scScanned', 'ASC')
//            ->setParameter('auVid', $agenturUser->getAuVid());

        $qb->select('p, b, pk, sc, DATE_FORMAT(DATE_ADD(sc.sc_scanned, INTERVAL -5 DAY))')
            ->from('AppBundle:ShopPosition', 'p')
            ->join('p.pBid', 'b')
            ->join('p.pTid', 'pk')
            ->join('b.bSc', 'sc')
            ->join('sc.scAu', 'au')
            ->Where('au.auVid = :auVid')
            ->orderBy('sc.scScanned', 'DESC')
            ->setParameter('auVid', $agenturUser->getAuVid())
        //    ->setMaxResults(100)
        ;

        $native_query = "SELECT k.a_k_id, k.a_k_name, sum(p_anzahl) as anzahl, DATE_FORMAT(DATE_ADD(sc_scanned, INTERVAL -5 DAY), '%Y') as jahr, DATE_FORMAT(DATE_ADD(sc_scanned, INTERVAL -5 DAY), '%m') as monat,xa_bezeichnung, xa_netto, xa_mwst, p_bezeichnung FROM SHOP_Position as p JOIN SHOP_Bestellungen as b on p_bid = nr JOIN SHOP_Position_Artikelnummern as pk on pk_artikelnummer = p_tid LEFT JOIN SHOP_Kosten_Arten as ko on xa_id = pk_xa_id JOIN SHOP_Scans as s on pk_kategorie = sc_k_id and nr = sc_b_nr JOIN ARTIKEL_Kategorie as k on sc_k_id = a_k_id LEFT JOIN AGENTUR_User as u on sc_au_id = au_id WHERE a_k_anbieter_id = 60 and au_vid = 60 GROUP BY jahr, monat, a_k_id, p_tid, p_bezeichnung ORDER BY jahr DESC, monat DESC, p_bezeichnung DESC";
       /*
         $rsm = new ResultSetMapping();
        $rsm->addEntityResult('AppBundle:ShopKategorie', 'k');
        $rsm->addFieldResult('k', 'a_k_id', 'id');
        $rsm->addFieldResult('k', 'name', 'name');
       $nqr = $this->getEntityManager()->createNativeQuery($native_query, $rsm);

       */


        $manager = $this->getEntityManager();
        $conn = $manager->getConnection();

        $result= $conn->query($native_query)->fetchAll();

        // $nqr->setParameter('vid', $agenturUser->getAuVid());

        // $rsm->addEntityResult('AppBundle:ShopPosition', 'p');
         // $rsm->addJoinedEntityResult('AppBundle:ShopBestellungen' , 'b', 'p', 'pBid');

//        $q = $query2->getResult();

        // $query = $qb->getQuery();
        // $q = $query->getArrayResult();

        return $result;
    }
}