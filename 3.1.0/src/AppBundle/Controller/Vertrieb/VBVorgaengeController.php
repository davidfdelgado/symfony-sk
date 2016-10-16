<?php

namespace AppBundle\Controller\Vertrieb;

use AppBundle\Entity\AgenturUser;
use AppBundle\Form\ShopBestellungenVBType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class VBVorgaengeController extends Controller
{
    /**
     * @Route("/vertrieb/vorgaenge/", name="vb_vorgaenge")
     */
    public function indexAction(Request $request)
    {

        $user       = $this->getUser();
        $em         = $this->getDoctrine()->getManager();
        $au         = null;
        $datum      = null;
        $overview   = $em->getRepository('AppBundle\Entity\AgenturVertrieb')->findVertriebOverview($user);
        //$overview = array('monate' => array('asd' => 1, '22' => 3), 'users' => array());

        $form = $this->createFormBuilder()
            ->add('monate', ChoiceType::class,  array('label' => 'Zeitraum', 'attr' => [], 'choices' => $overview->monate, 'choice_label' => function($index) { return $index->datum->format('F'); }, 'group_by' => function($val, $key){ return $val->datum->format('Y'); }, 'placeholder' => 'Gesamter Zeitraum'))
            ->add('users', EntityType::class,  array('class' => 'AppBundle\Entity\AgenturUser','mapped' => false, 'label' => 'Benutzer', 'attr' => [], 'choices' => $overview->users, 'choice_label' => function($user) { return $user->getAuVorname()." ".$user->getAuNachname(); }, 'group_by' => function($user){ if($user->getAuStatus() == true){ return "aktiv"; } else { return "inaktiv";} }, 'placeholder' => 'Alle Benutzer'))
            ->add('aktuallisieren', SubmitType::class,  array('label' => ' Aktuallisieren', 'attr' => ['class' => 'small-box-footer btn btn-block fa fa-refresh']))
            ->getForm();

        $form->handleRequest($request);

        if($request->isMethod('POST')){
            $au = $form->get('users')->getData();
            $datum = $form->get('monate')->getData();
        }
        
        $vorgaenge = $em->getRepository('AppBundle\Entity\AgenturVertrieb')->findAllVbVorgaenge($user, $au, $datum);

        $sammlung = new ArrayCollection();
        $sammlung->year = new ArrayCollection();
        $sammlung->year->summe = 0;
        $sammlung->month = new ArrayCollection();
        $sammlung->month->summe = 0;
        $sammlung->today = new ArrayCollection();
        $sammlung->today->summe = 0;

        foreach($vorgaenge as $v){

            if($v->getBCreated()->format('Y') == date('Y')){
                if($v->getBCreated()->format('m') == date('m')) {
                    if($v->getBCreated()->format('d') == date('d')) {
                        if($v->getBArt() == 4) $sammlung->today->summe += $v->getBSumme();
                        $sammlung->today->add($v);

                    }

                    if($v->getBArt() == 4) $sammlung->month->summe += $v->getBSumme();
                    $sammlung->month->add($v);

                }

                if($v->getBArt() == 4) $sammlung->year->summe += $v->getBSumme();
                $sammlung->year->add($v);

            }

            $sammlung->add($v);
        }


        return $this->render('@AppBundle/Vertrieb/vorgaenge_vb.html.twig', array('vorgaenge' => $sammlung, 'abfrage' => $overview, 'form' => $form->createView()));
    }

    /**
     *@Route("/vertrieb/vorgaenge/bearbeiten/{nr}", name="vb_ticket_bearbeiten")
     */
    public function bearbeitenAction($nr, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $vorgang = $em->getRepository('AppBundle\Entity\ShopBestellungen')->findByWithAllInfos($nr);
        $user = $this->getUser();

        if(!$vorgang || $vorgang->getBUser()->getAuVid() != $user->getAuVid()){

            return $this->redirectToRoute('vb_ticket_auswahl');

        }

        $form = $this->createForm(ShopBestellungenVBType::class, $vorgang);
        $form->handleRequest($request);

        $user = $this->getUser();
        $message = array();

        if($request->isMethod('POST')){
            if($form->getClickedButton()->getConfig()->getName() == "abbruch") {

                return $this->redirectToRoute('vb_vorgaenge');

            } elseif($form->getClickedButton()->getConfig()->getName() == "stornieren") {

                $vorgang->storno();
                $em->persist($vorgang);
                $em->flush();

                return $this->redirectToRoute('vb_vorgaenge');

            } elseif($form->getClickedButton()->getConfig()->getName() == "sentMail"){

                if($form->isValid()) {
                    $sentTo = $form->get('sentToMail')->getData();

                    dump($sentTo);
                }

            } elseif($form->getClickedButton()->getConfig()->getName() == "erstellen"){

                if($form->isValid()){

                    $em->persist($vorgang);
                    $em->flush();

                    $message['success'][] = "Vorgang wurde gespeichert!";

                }

            }

        }

        return $this->render('@AppBundle/Vertrieb/rechnung_erstellen.html.twig', array('erstellen' => $form->createView(), 'message' => $message));
    }
}
