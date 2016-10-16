<?php

namespace AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends Controller
{

    /**
     * @Route("/ajax/tabellen/vorgaenge", name="ajax_vorgaenge")
     */
    public function ajaxVorgaengeAction(Request $request)
    {

        $options = array();
        $options['draw']	=	$request->get('draw');
        $options['start']	=	$request->get('start');
        $options['length']	=	$request->get('length');
        $options['order']	=	$request->get('order');
        $options['search']	=	$request->get('search')['value'];
        $options['bart']	=	$request->get('bart');

        $vorgaenge = $this->getDoctrine()->getRepository('AppBundle:ShopBestellungen')->findVorgaenge($options);
        $json_send = array();

        foreach($vorgaenge as $v){
            $json_send[] = array(
                $v->getNr(),
                $v->getBArtLabel(),
                $v->getBRnnr(),
                number_format($v->getBSumme(), 2, ',', '.'),
                $v->getBCreated()->format('d.m.Y H:i'),
                $v->getBBezahltLabel(),
                $v->getBBezahlArtLabel(),
                '<a href="'.$this->get('router')->generate('be_vorgaenge_bearbeiten', array('nr' => $v->getNr())).'" class="btn btn-sm"><i class="fa fa-gear"></i></a>'
            );

        }



        $json = array('draw' => $options['draw'], 'recordsTotal' => sizeof($vorgaenge), 'recordsFiltered' => sizeof($vorgaenge), 'data' => $json_send);

        return new JsonResponse($json);
    }

    /**
     * @Route("/ajax/tabellen/kunden", name="ajax_kunden")
     */
    public function ajaxKundenAction(Request $request)
    {

        $options = array();
        $options['draw']	=	$request->get('draw');
        $options['start']	=	$request->get('start');
        $options['length']	=	$request->get('length');
        $options['order']	=	$request->get('order');
        $options['search']	=	$request->get('search')['value'];

        $kunden = $this->getDoctrine()->getRepository('AppBundle:ShopKunde')->findKunden($options);
        $json_send = array();

        foreach($kunden->results as $k){
            $json_send[] = array(
                $k->getKId(),
                $k->getKFirma(),
                $k->getKVorname(),
                $k->getKNachname(),
                $k->getKEmail(),
                $k->getKTelefonnummer(),
                '<a href="'.$this->get('router')->generate('be_kunde_bearbeiten', array('k_id' => $k->getKid())).'" class="btn btn-sm"><i class="fa fa-gear"></i></a>'
            );

        }


        $json = array('draw' => $options['draw'], 'recordsTotal' => $kunden->max, 'recordsFiltered' => $kunden->max, 'data' => $json_send);

        return new JsonResponse($json);
    }


    /**
     * @Route("/ajax/suche/tickets", name="ajax_suche_tickets")
     */
    public function ajaxSucheTicketsAction(Request $request)
    {

        $options = $request->get('q') ?: "";

        $tickets = $this->getDoctrine()->getRepository('AppBundle:Artikel')->findArtikel($options);
        $json_send = array();

        foreach($tickets as $k){
            $array = array(
                'id' => $k->getAId(),
                'tid' => $k->getAKid()->getAKOid()->getAONameKurz()."-".$k->getAKid()->getAKNameKurz()."-".$k->getAArtikelnummer(),
                'name' => $k->getAName(),
                'ort' => $k->getAKid()->getAKOid()->getAOName(),
                'kategorie' => $k->getAKid()->getAKName()
            );

            $json_send[] = $array;
        }


        return new JsonResponse(array('total_count' => sizeof($json_send), 'incomplete_results' => false, 'items' => $json_send));
    }
}
