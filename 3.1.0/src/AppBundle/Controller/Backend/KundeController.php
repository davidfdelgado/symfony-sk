<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Entity\ShopBestellungen;
use AppBundle\Form\ShopKundeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class KundeController extends Controller
{

    /**
     * @Route("/kunde/", name="be_kunden_overview")
     */
    public function indexAction()
    {
        return $this->render('@AppBundle/table/kunden.html.twig', array('tabellen' => array()));
    }

    /**
     * @Route("/kunde/{k_id}", name="be_kunde_bearbeiten", requirements={"k_id": "\d+"} )
     */

    public function bearbeitenAction($k_id, Request $request){
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $kunde = $em->getRepository('AppBundle:ShopKunde')->findAllInfos($k_id);

        if(!$kunde) return $this->redirectToRoute('be_kunden_overview');
        
        $form = $this->createForm(ShopKundeType::class, $kunde);

        $form->handleRequest($request);
        
        if($request->isMethod('POST')){
            if($form->get('close')->isClicked()){

               return $this->redirectToRoute('be_kunden_overview');

            } elseif($form->get('speichern')->isClicked() && $form->isValid()){

                $data = $form->getData();
                $em->persist($data);
                $em->flush();
            }
        }

        return $this->render('@AppBundle/form/kunde.html.twig', ['form' => $form->createView(), 'kunde' => $kunde]);
    }
    
    /**
     * @Route("/kunde/erstellen", name="be_kunde_erstellen")
     */
    public function erstellenAction(Request $request){


        $form = $this->createForm(ShopKundeType::class);
        $form->handleRequest($request);

        if($request->isMethod('POST')){
            if($form->get('close')->isClicked()){

                return $this->redirectToRoute('be_kunden_overview');

            } elseif($form->get('speichern')->isClicked() && $form->isValid()){

                $data = $form->getData();

                $em = $this->getDoctrine()->getEntityManager();

                $em->persist($data);
                $em->flush();

                $kid = $data->getKid();

                if($kid){
                    return $this->redirectToRoute('be_kunde_bearbeiten', ['k_id' => $kid ]);
                }
            }
        }
        
        $seiteninfo = array();
        $seiteninfo['subtitle'] = "Kunde erstellen";
        $seiteninfo['title'] = "Kunden Management";

        return $this->render('@AppBundle/form/kunde.html.twig', ['seiteninfo' => $seiteninfo, 'form' => $form->createView()]);
    }

    /**
     * @Route("/kunde/{kid}/vorgang_erstellen", name="be_kunde_vorgang_erstellen", requirements={"kid": "\d+"})
     */
    public function erstelleVorgangZuKunde($kid){

        $em = $this->getDoctrine()->getEntityManager();

        $kunde = $em->getRepository('AppBundle:ShopKunde')->find($kid);

        if($kunde){

            $bestellung = new ShopBestellungen();

            $bestellung->setBKid($kunde);

            $em->persist($bestellung);
            $em->flush();

            $bestellung->createBRnnr();

            $em->persist($bestellung);
            $em->flush();

            $id = $bestellung->getNr();

            return $this->redirectToRoute('be_vorgaenge_bearbeiten', array('nr' => $id));

        } elseif($kid) {

            return $this->redirectToRoute('be_kunde_bearbeiten', array('kid' => $kid));

        } else {

            return $this->redirectToRoute('be_kunde_overview');

        }

    }
}
