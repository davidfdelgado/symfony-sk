<?php

// src/AppBundle/Entity/ShopBestellungenRepository.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Validator\Constraints\DateTime;

class AgenturVertriebRepository extends EntityRepository
{
    public function findByWithAllInfos($id = null){

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('av, au')
            ->from('AppBundle:AgenturVertrieb', 'av')
            ->join('av.avUsers', 'au')
            ->Where('av.avId = :id')
            ->setParameter('id', $id);

        $query = $qb->getQuery();

        $result = $query->getOneOrNullResult();
        
        return $result;
    }

    public function StatistikUmsatz(AgenturVertrieb $vb){

        $manager = $this->getEntityManager();
        $conn = $manager->getConnection();

        $native_query = "SELECT date_format(b_created,'%Y') as jahr, date_format(b_created,'%m') as monat, date_format(b_created,'%M') as monat_label, a_k_id, a_k_name, max(p_bezeichnung) as bezeichnung, p_preis, max(p_mwst) as mwst, count(p_anzahl) as anzahl, sum(p_anzahl * p_preis) as summe FROM SHOP_Bestellungen JOIN SHOP_Position as p on p_bid = nr JOIN SHOP_Position_Artikelnummern as pk on p_tid = pk_artikelnummer JOIN ARTIKEL_Kategorie as k on a_k_id = pk_kategorie JOIN AGENTUR_User on b_user = au_id WHERE b_art < 90 and au_vid = ".$vb->getAvId()." GROUP BY jahr, monat, monat_label, a_k_id, p_tid, p_preis ORDER BY jahr DESC, monat DESC, anzahl DESC, a_k_id";

        $result = $conn->query($native_query)->fetchAll();

        $return = array();

        $labels = array();
        foreach($result as $r){
            if(!array_key_exists($r['jahr'], $return)){
                $return[$r['jahr']]['beschreibung'] = "Umsätze für ";
                $return[$r['jahr']]['bezeichnung'] = $r['jahr'];
                $return[$r['jahr']]['color'] = rand(0,255).",".rand(0,255).",".rand(0,255);
                $return[$r['jahr']]['monate'] = array();
            }

            if(!array_key_exists($r['monat'], $labels)){
                $labels[$r['monat']] = array('key' => $r['monat'], 'content' => $r['monat_label']);
            }

            if(!array_key_exists($r['monat'], $return[$r['jahr']]['monate'])){
                $return[$r['jahr']]['monate'][$r['monat']]['bezeichnung'] = $r['monat'];
                $return[$r['jahr']]['monate'][$r['monat']]['beschreibung'] = $r['monat'];
                $return[$r['jahr']]['monate'][$r['monat']]['statistik'] = $r['monat'];
                $return[$r['jahr']]['monate'][$r['monat']]['statistik_summe'] = 0;
                $return[$r['jahr']]['monate'][$r['monat']]['statistik_bezeichnung'] = "Eingebuchte Tickets";
                $return[$r['jahr']]['monate'][$r['monat']]['kategorien'] = array();
            }

            if(!array_key_exists($r['a_k_id'], $return[$r['jahr']]['monate'][$r['monat']]['kategorien'])) {
                $return[$r['jahr']]['monate'][$r['monat']]['kategorien'][$r['a_k_id']]['bezeichnung'] = $r['a_k_name'];
                $return[$r['jahr']]['monate'][$r['monat']]['kategorien'][$r['a_k_id']]['statistik'] = 0;
                $return[$r['jahr']]['monate'][$r['monat']]['kategorien'][$r['a_k_id']]['statistik_summe'] = 0;
                $return[$r['jahr']]['monate'][$r['monat']]['kategorien'][$r['a_k_id']]['tickets'] = array();
            }
            $return[$r['jahr']]['monate'][$r['monat']]['statistik'] += $r['anzahl'];
            $return[$r['jahr']]['monate'][$r['monat']]['statistik_summe'] += $r['summe'];
            $return[$r['jahr']]['monate'][$r['monat']]['kategorien'][$r['a_k_id']]['tickets'][] = $r;
            $return[$r['jahr']]['monate'][$r['monat']]['kategorien'][$r['a_k_id']]['statistik'] += $r['anzahl'];
            $return[$r['jahr']]['monate'][$r['monat']]['kategorien'][$r['a_k_id']]['statistik_summe'] += $r['summe'];
        }
        array_multisort($labels);
        $statistik = array();
        $statistik['label'] = $labels;
        $statistik['stat'] = $return;
        dump($return);
        return $statistik;
    }

    public function findVertrieb(AgenturUser $agenturUser){

        $qb = $this->getEntityManager()->createQueryBuilder();

        $id = $agenturUser->getAuVid()->getAvId();

        $qb->select('av, au, b')
            ->from('AppBundle:AgenturVertrieb', 'av')
            ->join('av.avUsers', 'au')
            ->join('au.auVorgaenge', 'b', 'WITH', 'b.bArt in (4)')
            ->Where('av.avId = :id');

        if(!$agenturUser->getAuArt() == 4) {
            $qb->andWhere('au.auId = '.$agenturUser->getAuId());
        }
        $qb->setParameter('id', $id);

        $qb->OrderBy('b.bBooked', 'DESC');


        $query = $qb->getQuery();

        $result = $query->getResult();

        return $result;
    }

    public function findVertriebOverview(AgenturUser $agenturUser){

        $result = $this->findVertrieb($agenturUser);

            $overview = new ArrayCollection();
            $overview->users = new ArrayCollection();

            $overview->monate = new ArrayCollection();

            $overview->vorgaenge = new ArrayCollection();

        foreach($result as $v){
            foreach($v->getAvUsers() as $u){
                $overview->users->offsetSet($u->getAuId(), $u);

                foreach($u->getAuVorgaenge() as $v){
                    $booked = $v->getBCreated()->format('Ym');


                    if(!$overview->monate->containsKey( $booked )){
                        $overview->monate->set( $booked, new ArrayCollection() );
                        $overview->monate->offsetGet($booked)->datum = $v->getBCreated();
                    }

                    $overview->monate->offsetGet($booked)->add($v);
                    $overview->vorgaenge->add($v);

                }
            }
        }

        return $overview;


    }

    public function findAllVbVorgaenge(AgenturUser $agenturUser = null, AgenturUser $user = null, $datum = null){

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('b, p, pk, au')
            ->from('AppBundle:ShopBestellungen', 'b')
            ->join('b.bUser', 'au')
            ->join('b.bPositionen', 'p')
            ->join('p.pTid', 'pk')
            ->Where('au.auVid = :vid')
            ->andWhere('b.bArt in (4, 97, 98)')
            ->orderBy('b.bCreated', 'DESC')
            ->setParameter('vid', $agenturUser->getAuVid() );

        if($user){
            $qb->andWhere('au.auId = :au')
            ->setParameter('au', $user->getAuId());

        }

        if($datum && key_exists('datum', $datum)){

            $von = new \DateTime($datum->datum->format('Y-m')."-01");
            $bis = new \DateTime($von->format('Y-m-d ')." +1 Month -1 Day");

            $qb->andWhere("b.bCreated between '".$von->format('Y-m-d')."' and '".$bis->format('Y-m-d')."'");
        }

        $query = $qb->getQuery();

        $result = $query->getResult();


        return $result;
    }

}