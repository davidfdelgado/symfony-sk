<?php

namespace AppBundle\Controller\Vertrieb;

use AppBundle\Form\ShopBestellungenVBType;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TicketAuswahlController extends Controller
{
    /**
     * @Security("has_role('ROLE_VERTRIEB_ACCOUNT_VERMITTLER')")
     * @Route("/tickets/auswahl", name="vb_ticket_auswahl")
     */
    public function auswahlAction()
    {

        $em = $this->getDoctrine()->getManager();

        $orte = $em->getRepository('AppBundle\Entity\ArtikelOrte')->findAllActive();
        dump($orte);

        foreach($orte as $o){
            $o->arten = new ArrayCollection();

            foreach($o->getAOKategorien() as $kategorien){

                $art = $kategorien->getAKArt();

                if(!$o->arten->contains($art)){
                    $o->arten->add($art);

                    $art->kategorien = new ArrayCollection();
                }

                if(!$art->kategorien->contains($kategorien)){

                    $art->kategorien->add($kategorien);

                }
            }
        }


        return $this->render('@AppBundle/Warenkorb/ticket_overview.html.twig', array('destinationen' => $orte));
    }

    /**
     *@Route("/tickets/buchen", name="vb_ticket_buchen")
     */
    public function buchenAction(Request $request)
    {

        $this->denyAccessUnlessGranted('ROLE_VERTRIEB_ACCOUNT_VERMITTLER', null, 'Sie haben keinen Zugriff auf diese Seite!');

        $em = $this->getDoctrine()->getManager();

        $session_id = $request->cookies->get('PHPSESSID');
        $session = $em->getRepository('AppBundle\Entity\ShopSession')->findSession($session_id);
        $originalWarenkorb = new ArrayCollection();

        foreach($session->getSWarenkorb() as $w){
            $originalWarenkorb->add($w);
        }
        if(!$session || $session->getSWarenkorb()->count() == 0) return $this->redirectToRoute('vb_ticket_auswahl');

        $form = $this->createForm(ShopBestellungenVBType::class);
        $form->handleRequest($request);

        $user = $this->getUser();

        if($request->isMethod('POST')){

            if($form->getClickedButton()->getName() == "abbruch"){
                return $this->redirectToRoute('vb_ticket_auswahl');
            } elseif($form->getClickedButton()->getName() == "erstellen"){

                if($form->isValid()){

                    $vorgang = $form->getData();
                    $vorgang->setBUser($user);
                    $vorgang->setBArt(4);
                    $vorgang->transformWarenkorb( $session );

                    $em->persist($vorgang);
                    $em->flush();
                    $em->persist($vorgang);

                    foreach($originalWarenkorb as $w){
                        if(!$session->getSWarenkorb()->contains($w)){
                            $em->remove($w);
                        }
                    }
                    $em->flush();

                    if($vorgang->getNr()) {
                        return $this->redirectToRoute('vb_ticket_bearbeiten', ['nr' => $vorgang->getNr()]);
                    }

                }
            }
            
        }

        return $this->render('@AppBundle/Vertrieb/rechnung_erstellen.html.twig', array('erstellen' => $form->createView()));
    }
    
}
