<?php

// src/AppBundle/Entity/ShopKundeRepository.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ShopKundeRepository extends EntityRepository
{

    public function findKunden($options = array()){

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qbmax = clone $qb;

        $qb->select('k')
            ->from('AppBundle:ShopKunde', 'k');

        $qbmax->select('count(k.kId)')
            ->from('AppBundle:ShopKunde', 'k');

        if($options['order']['0']['column'] && 1==1){
            switch($options['order']['0']['column']){
                case 1:
                    $field = "k.kFirma";
                    break;
                case 2:
                    $field = "k.kVorname";
                    break;
                case 3:
                    $field = "k.kNachname";
                    break;
                case 4:
                    $field = "k.kEmail";
                    break;
                default:
                    $field = "k.kId";
                    break;
            }

            $dir = $options['order']['0']['dir'] ?: 'ASC';

            $qb->orderBy($field, $dir);
        } else {
            $qb->orderBy('k.kId', 'DESC');
        }

        $qb->where('k.kId > 0');
        $qbmax->where('k.kId > 0');

        if($options['search']){

            $array = explode(" ", $options['search']);

            foreach ($array as $search){

            $qb
                ->andWhere("k.kId LIKE '%".$search."%' or k.kFirma LIKE '%".$search."%' or k.kVorname LIKE '%".$search."%' or k.kNachname LIKE '%".$search."%' or k.kEmail LIKE '%".$search."%' or k.kTelefonnummer LIKE '%".$search."%'")
                ;

            $qbmax
                ->andWhere("k.kId LIKE '%".$search."%' or k.kFirma LIKE '%".$search."%' or k.kVorname LIKE '%".$search."%' or k.kNachname LIKE '%".$search."%' or k.kEmail LIKE '%".$search."%' or k.kTelefonnummer LIKE '%".$search."%'")
                ;
            }

        }

            $qb->setFirstResult($options['start']);
            $qb->setMaxResults($options['length']);


        $querymax =$qbmax->getQuery();

        $query = $qb->getQuery();

        $result = New ArrayCollection();

        $maxResult = $querymax->getOneOrNullResult();
        $result->max = $maxResult[1];
        $result->results = $query->getResult();


        return $result;
    }

    public function findAllInfos($id){
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('k')
            ->from('AppBundle:ShopKunde', 'k')
            ->where('k.kId = :id')
            ->setParameter('id', $id);
        ;

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();

    }



}