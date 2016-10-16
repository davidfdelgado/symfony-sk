<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Entity\ShopBestellungen;
use AppBundle\Form\ShopBestellungenBEType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VorgaengeController extends Controller
{
    /**
     * @Route("/vorgaenge/alle/", name="be_vorgaenge_alle")
     * @Route("/vorgaenge/anfragen", name="be_vorgaenge_anfragen", defaults={"bart": 1})
     * @Route("/vorgaenge/angebote", name="be_vorgaenge_angebote", defaults={"bart": 2})
     * @Route("/vorgaenge/rechnungen", name="be_vorgaenge_rechnungen", defaults={"bart": 3})
     */
    public function indexAction($bart = null)
    {


        $optionen = array();
        $optionen['von'] = 200;
        $optionen['max'] = 200;
        $optionen['order_by'] = 'b_id';

        // $alle = $this->getDoctrine()->getEntityManager()->getRepository('AppBundle:ShopBestellungen')->findVorgaenge($optionen);

        $alle = array();

        return $this->render('@AppBundle/table/vorgaenge.html.twig', array('vorgaenge' => $alle, 'bart' => $bart));
    }

    /**
     * @Route("/vorgaenge/bearbeiten/{nr}/", name="be_vorgaenge_bearbeiten", requirements={"nr": "\d+"} )
     */
    public function bearbeitenAction($nr, Request $request)
    {
        $vorgang = $this->getDoctrine()->getEntityManager()->getRepository('AppBundle:ShopBestellungen')->findByWithAllInfos($nr);

        $form = $this->createForm(ShopBestellungenBEType::class, $vorgang);
        $form->handleRequest($request);

        if($vorgang){

            $vorgang->getBKategorien();

        } else {
            $this->redirectToRoute('be_vorgaenge_alle');
        }

        return $this->render('@AppBundle/form/vorgang.html.twig', array('vorgang' => $vorgang, 'form' => $form->createView()));
    }
}
