<?php

namespace AppBundle\Controller\Vertrieb;

use AppBundle\Entity\AgenturUser;
use AppBundle\Form\AgenturUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VBBenutzerController extends Controller
{
    /**
     * @Route("/vertrieb/benutzer/", name="vb_benutzer")
     */
    public function indexAction()
    {

        $this->denyAccessUnlessGranted('ROLE_VERTRIEB_ADMIN', null, 'Sie haben keinen Zugriff auf diese Seite!');
        
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->getUser();

        $vertrieb = $em->getRepository('AppBundle\Entity\AgenturVertrieb')->findByWithAllInfos( $user->getAuVid()->getAvId() );

        return $this->render('@AppBundle/Vertrieb/benutzer_vb.html.twig', [
            'vb' => $vertrieb
        ]);
    }

    /**
     * @Route("/vertrieb/benutzer/erstellen", name="vb_benutzer_erstellen")
     * @Route("/vertrieb/benutzer/{auid}", name="vb_benutzer_bearbeiten", requirements={"auid": "\d+"} )
     * @Route("/vertrieb/benutzer/{egal}", name="vb_benutzer_ungueltig" )
     */
    public function bearbeitenAction(Request $request, $auid = null, $egal = null)
    {

        if($egal) return $this->redirectToRoute('vb_benutzer');

        $em = $this->getDoctrine()->getManager();

        $benutzer = null; // der zu bearbeitende Benutzer
        $user = $this->getUser(); // der eigene Benutzer

        if($auid) $benutzer = $em->getRepository('AppBundle\Entity\AgenturUser')->find($auid);
        if($user != $benutzer){
            $this->denyAccessUnlessGranted('ROLE_VERTRIEB_ADMIN', null, 'Es ist Ihnen nicht erlaubt, fremde Profile zu betrachten!');
        }

        // Wenn der aktuelle Benutzer nicht dem selber selben VerttriebsId gehört wird abgebrochen...

        if((!$benutzer && $auid) || ($benutzer && $user->getAuVid() != $benutzer->getAuVid()) && ($benutzer->getAuArt() > $user->getAuArt() && $benutzer != $user)) return $this->redirectToRoute('vb_benutzer');

        $form = $this->createForm(AgenturUserType::class, $benutzer);

        $form->handleRequest($request);

        if($request->isMethod('POST')){

            if($form->get('abbruch')->isClicked()) {

                return $this->redirectToRoute('vb_benutzer');

            } elseif($form->isValid()){

                if($form->get('speichern')->isClicked()){
                    $benutzer = $form->getData();

                    if(!$benutzer->getAuId()){
                        $benutzer->setAuVid($user->getAuVid());
                    } else {
                    }


                    $em->persist($benutzer);
                    $em->flush();

                }

            }
        }

        $seiteninfo = array();
        $seiteninfo['subtitle'] = "Benutzer erstellen/bearbeiten";
        $seiteninfo['title'] = "User Management";

        return $this->render('@AppBundle/content.html.twig', array('formular' => $form->createView(), 'seiteninfo' => $seiteninfo));
    }
}
