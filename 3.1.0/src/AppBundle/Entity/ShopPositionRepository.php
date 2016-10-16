<?php

// src/AppBundle/Entity/ShopPositionRepository.php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class ShopPositionRepository extends EntityRepository
{
    public function findAllScanedPositions(AgenturUser $agenturUser, $type = null){

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('p, b, pk, sc')
            ->from('AppBundle:ShopPosition', 'p')
            ->join('p.pBid', 'b')
            ->join('AppBundle:ShopPositionArtikelnummern', 'pk', 'WITH', 'pk.pkArtikelnummer = p.pTid')
            ->join('AppBundle:ShopScans', 'sc', 'WITH', 'sc.scBNr = p.pBid')
            ->join('sc.scAu', 'au')
            ->Where('au.auVid = :auVid')
            ->orderBy('sc.scScanned', 'ASC')
            ->setParameter('auVid', $agenturUser->getAuVid());

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('AppBundle:ShopPosition', 'p');
        $rsm->addJoinedEntityResult('AppBundle:ShopBestellungen' , 'b', 'p', 'pBid');

        $query2 = $this->getEntityManager()->createNativeQuery("SELECT p.*, b.* FROM SHOP_Position as p JOIN SHOP_Bestellungen as b on b.nr = p.p_bid JOIN SHOP_Position_Artikelnummern as pk on pk_artikelnummer = p_tid JOIN SHOP_Scans as sc on sc_b_nr = p_bid and sc_k_id = pk_kategorie JOIN AGENTUR_User as au on au_id = sc_au_id WHERE au_vid = ? ORDER BY sc_scanned DESC LIMIT 100", $rsm);
        $query2->setParameter(1, $agenturUser->getAuVid());

//        $q = $query2->getResult();

        $query = $qb->getQuery();
        $q = $query->getResult();

        return $q;
    }

    public function findByKategory($bnr, $kat){

        if(!$bnr || !$kat) return false;

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('p, b, pk, sc')
            ->from('AppBundle:ShopPosition', 'p')
            ->join('p.pBid', 'b')
            ->join('p.pTid', 'pk', 'WITH', 'pk.pkArtikelnummer = p.pTid and pk.pkKategorie = :kat')
            ->leftjoin('AppBundle:ShopScans', 'sc', 'WITH', 'sc.scBNr = p.pBid')
            ->leftjoin('sc.scAu', 'au')
            ->Where('b.nr = :nr')
            ->setParameter('nr', $bnr)
            ->setParameter('kat', $kat)
        ;

        $query = $qb->getQuery();
        $q = $query->getResult();

        return $q;

    }
}