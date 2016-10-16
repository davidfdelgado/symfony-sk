<?php

namespace AppBundle\Controller\Vertrieb;

use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class RechnungenController extends Controller
{
    /**
     *
     * @Route("/vertrieb/rechnungen", name="vb_rechnungen")
     */
    public function indexAction()
    {

        $this->denyAccessUnlessGranted('ROLE_VERTRIEB_ADMIN', null, 'Sie haben keinen Zugriff auf diese Seite!');
        $em = $this->getDoctrine();
        $user = $this->getUser();

        $rechnungen = $em->getRepository('AppBundle\Entity\ShopBestellungen')->findAllVbRechnungen($user);

        $rns = new ArrayCollection();
        $rns->offen = new ArrayCollection();
        $rns->bezahlt = new ArrayCollection();
        foreach($rechnungen as $rn){
            if($rn->getBBezahlt()){
                $rns->bezahlt->add($rn);
            } else {
                $rns->offen->add($rn);
            }
        }

        return $this->render('@AppBundle/Vertrieb/rechnungen_vb.html.twig', [
            'rechnungen' => $rns
        ]);
    }
}
