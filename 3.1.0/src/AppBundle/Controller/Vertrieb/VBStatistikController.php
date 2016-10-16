<?php

namespace AppBundle\Controller\Vertrieb;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VBStatistikController extends Controller
{
    /**
     * @Route("/vertrieb/statistik/umsatz", name="vb_statistik_umsatz", host="%subdomain_vertrieb%.%domain%" )
     */
    public function indexAction()
    {

        $this->denyAccessUnlessGranted('ROLE_VERTRIEB_ACCOUNT_VERMITTLER', null, 'Sie haben keinen Zugriff auf diese Seite!');
        $this->denyAccessUnlessGranted('ROLE_VERTRIEB_ADMIN', null, 'Sie haben keinen Zugriff auf diese Seite!');

        $vb = $this->getUser()->getAuVid();

        $statistik = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\AgenturVertrieb')->statistikUmsatz($vb);

        $seiteninfo = array();
        $content = "<h2>Umsatzstatistik</h2><p>Auf dieser Seite finden Sie eine Übersicht über die bisher verkauften Tickets. Sie können daher nachvollziehen, wie viele Vorgänge von welcher Leistung erstellt wurden. Ebenso haben Sie die Anzahl der gebuchten Leistung, die ausgewiesene MwSt. und die Summe. Diese Statistik wird täglich aktualisiert, sodass Sie jederzeit die Möglichkeit haben, den Umsatz zu verfolgen. 
                    <br><br>
                    Wichtig: Nur der Admin hat die Rechte diese Statistiken einzusehen.
                    </p>";
        
        return $this->render('@AppBundle/content.html.twig', array('seiteninfo' => $seiteninfo, 'content' => $content, 'statistik' => $statistik['stat'], 'chart' => $statistik['label']));
    }
}
