<?php

namespace AppBundle\Controller\Scan;

use AppBundle\Entity\ShopScans;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SCIndexController extends Controller
{
    /**
     * @Route("/", name="sc_index", host="%subdomain_scan%.%domain%")
     */
    public function indexAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_SCANNER', null, 'Sie haben keinen Zugriff auf diese Seite!');

        $rn = $request->query->get('nr');
        $vorgang = null;
        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder()
            ->add('rn', TextType::class, ['attr' => ['placeholder' => 'Vorgangsnummer'], 'label' => 'Vorgangsnummer'])
            ->add('check', SubmitType::class, ['attr' => ['class' => 'btn btn-block btn-primary fa fa-search'], 'label' => ' überprüfen'])
            ->getForm()
            ;
        $form->handleRequest($request);

        if($request->isMethod('POST') || $rn){

            $rn = $form->get('rn')->getData() ?: $rn;
            $user = $this->getUser();

            $vorgang = $em->getRepository('AppBundle\Entity\ShopBestellungen')->findVorgangForCheckin($rn, $user);

        }




        if($vorgang){

            $vorgang->getBKategorien();

            if( ($vorgang->getBArt() == 3 && $vorgang->getBbezahlt() ) || $vorgang->getBArt() == 4 ){

            } else {

            }

        }

        dump($vorgang);

        $seiteninfo = array();
        $seiteninfo['hide'] = true;

        return $this->render('@AppBundle/Scan/index-scan.html.twig', array('seiteninfo'=> $seiteninfo, 'vorgang' => $vorgang, 'form' => $form->createView()) );
    }


    /**
     * @Route("/checkin/{nr}/{kat}/{datum}", name="sc_checkin", host="%subdomain_scan%.%domain%", defaults={"datum": ""})
     */
    public function checkinAction($nr, $kat, $datum, Request $request){

        if(!$nr || !$kat)  return $this->redirectToRoute('sc_index', ['nr' => $nr]);

        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $vorgang = $em->getRepository('AppBundle\Entity\ShopBestellungen')->findVorgangForCheckin($nr, $user, $kat);


        if($vorgang) {
            $vorgang->readyToCheckin();
        }

        $kategorie = $vorgang->getBKategorien()->first();

        $form = $this->createFormBuilder()
            ->add('kategorie', HiddenType::class, ['data' =>  $kategorie->getAKId() ])
            ->add('checkin', SubmitType::class, ['attr' => ['class' => 'btn btn-success btn-block fa fa-check-square-o'], 'label' => ' Leistung einchecken'])
            ->getForm();
        ;

        $form->handleRequest($request);
        $new_message = "";
        $checkedinn = false;
        if($request->isMethod('POST')){

            $kid = $form->get('kategorie')->getData();

            if($form->isSubmitted()){
                if($kategorie->getAKId() == $kid){
                    if(!$kategorie->scan) {

                        $new_scan = new ShopScans();
                        $new_scan->setScAu($user);
                        $new_scan->setScBNr($vorgang);
                        $new_scan->setScK($kategorie);
                        $new_scan->setScScanned(new \DateTime('now'));

                        $em->persist($new_scan);
                        $em->flush();
                        $checkedinn = true;
                        $new_message = "<center><i class='fa fa-4x fa-check'></i><br> Die Leistung wurde erfolgreich eingecheckt</center>";
                    }
                }
            }
        }

        return $this->render('@AppBundle/Scan/checkin-scan.html.twig', array('seiteninfo' => array('title' => ' ', 'subtitle' => ' '), 'vorgang' => $vorgang, 'checkedinn' => $checkedinn, 'message' => $new_message, 'form' => $form->createView()) );
    }

    /**
     * @Route("/historie", name="sc_historie", host="%subdomain_scan%.%domain%")
     */
    public function historieAction(Request $request)
    {
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $historie = $em->getRepository('AppBundle\Entity\AgenturUser')->findScanHistorie($user);

        return $this->render('@AppBundle/Scan/historie-scan.html.twig', array('seiteninfo' => array('title' => ' ', 'subtitle' => ' '), 'historie' => $historie));

    }
}
