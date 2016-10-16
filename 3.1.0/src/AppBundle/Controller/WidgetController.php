<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AgenturUser;
use AppBundle\Entity\ShopBestellungen;
use AppBundle\Entity\ShopScans;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WidgetController extends Controller
{
    /**
     * @Route("/widget/einchecken", name="wg_einchecken")
     */
    public function eincheckenAction()
    {
        return $this->render('@AppBundle/Widgets/check_qr.html.twig');
    }

    /**
     * @Route("/widget/einchecken/ajax", name="wg_einchecken_ajax");
     */
    public function eincheckenAjaxAction(Request $request){

        $bnr = $request->query->get('s');
        $user = $this->getUser();

        /**
         * var ShopBestellungen
         */
        $vorgang = $this->getDoctrine()->getRepository('AppBundle\Entity\ShopBestellungen')->findRnnr($bnr, $user);

        $kategorien = array();

        $content = "";

        if($vorgang){
            foreach($vorgang->getBPositionen() as $position){

                $kat = $position->getPTid()->getPkKategorie();

                if(!key_exists($kat->getAKId(), $kategorien)){
                    $kategorien[$kat->getAKId()]['vid'] = $kat->getAkAnbieterId();
                    $kategorien[$kat->getAKId()]['pos'] = array();
                }

                $kategorien[$kat->getAKId()]['pos'][] = $position;

            }
        } else {

            $content = '<tr><td align=\'center\'><p>Kein Vorgang gefunden unter der Nummer "'.$bnr.'"</p></td></tr>';

        }

        $rowspan = false;

        // Output
        foreach($kategorien as $kat_id => $kats){

            if($kats['vid'] == $user->getAuVid()->getAvId()){

                foreach($kats['pos'] as $pos){

                    $content .= "<tr>";
                        $content .= "<td>".$pos->getPBezeichnung()."</td>";
                        $content .= "<td>x</td>";
                        $content .= "<td>".$pos->getPAnzahl()."</td>";

                        if(!$rowspan){

                            $content .= "<td rowspan='".sizeof($kats['pos'])."'>";
                            if(!$vorgang->getBBezahlt() && $vorgang->getBArt() != 4){

                                $content .= "<i>Die Rechnung/Voucher wurde noch nicht bezahlt...</i>";

                            } elseif($pos->getPSc()){ // wurde bereits eingescant

                                $content .= "<i>";

                                $interval = $pos->getPSc()->getScScanned()->diff(new \DateTime('Now'));

                                $int = $interval->y + $interval->m + $interval->d + $interval->h;

                                if($int == 0 && $interval->i <= 5){

                                    $content .= "Erfolgreich eingecheckt!";

                                } else {
                                    $content .= "Dieses Ticket wurde bereits eingelöst ";

                                    if($pos->getPSc() ){

                                        $content .= "<br> am ".$pos->getPSc()->getScScanned()->format('d.m.Y H:i') ;
                                    }

                                    if($pos->getPSc()->getScAu() === $user){

                                        $content .= "<br> von Ihnen";

                                    } else {

                                        $content .= "<br> von ".$pos->getPSc()->getScAu()->getAuVorname()." ".$pos->getPSc()->getScAu()->getAuNachname();

                                    }

                                }

                                $content .= "</i>";

                            } else { // kann eingescannt werden
                                $content .= "<button type='submit' style='width:100%;' name='kat_checkin' class='btn btn-success btn-sm btn-flat' data-bnr='".$vorgang->getNr()."' data-kat='".$kat_id."'' class='button'>einchecken</button>";
                            }

                            $content .= "</td>";

                            $rowspan = true;
                        }
                    $content .= "</tr>";
                }

                $rowspan = false;

            } else{

                $content .= "<tr><td colspan='4'><p>Diese Tickets können nicht von Ihnen eingelöst werden.</p></td></tr>";

            }

        }

        $response = new Response();
        $response->setContent($content);

        return $response;
    }

    /**
     * @Route("/widget/einchecken/vorgang/", name="wg_einchecken_kategorie")
     */
    public function eincheckenVorgangKat(Request $request){
       
        $vorgang = $request->query->get('b');
        $kategorie = $request->query->get('k');

        $user = $this->getUser();

        $antwort = array('success'=> false, 'content' => '');

        $em = $this->getDoctrine()->getEntityManager();
        $positionen = $em->getRepository('AppBundle:ShopPosition')->findByKategory($vorgang, $kategorie);

        if(sizeof($positionen)){
            $pos = $positionen[0];

            if($user->getAuScanAll() || $user->getAuVid()->getAvId() == $pos->getPTid()->getPkKategorie()->getKId()){

                if(!$pos->getPSc()){

                    if($pos->getPDatum()){

                        $diff = $pos->getPDatum()->diff(new \DateTime());

                        if($diff->days > 0){

                            $scan = new ShopScans();
                            $scan->setScBNr($pos->getPBid());
                            $scan->setScK($pos->getPTid()->getPkKategorie());
                            $scan->setScAu($user);
                            $scan->setScScanned(new \DateTime('now'));
                            $scan->setScAnzahl(0);


                            $em->persist($scan);
                            $em->flush();

                            if($scan->getScId()){
                                $antwort['success'] = true;
                                $antwort['content'] = "Erfolgreich eingescannt";
                            }

                        } else {
                            $antwort['content'] = "Kann noch nicht eingelöst werden";
                        }

                    }

                } else {
                    $antwort['content'] = "Wurde bereits eingescannt";
                }
            } else {

                $antwort['content'] = "Diese Leistung kann von Ihnen nicht eingescannt werden.";

            }

        } else {

            $antwort['content'] = "Keine Positionen zum einscannen";

        }

        return New JsonResponse($antwort);
        
    }

    /**
     * @Route("/widget/zeiten/{a_k_id}", name="widget_zeitentabelle", requirements={"a_k_id" = "\d+"})
     */
    public function zeitenAction($a_k_id){

        $zeitentabelle = new ArrayCollection();

        $em     =   $this->getDoctrine()->getManager();
        $kategorie = $em->getRepository('AppBundle\Entity\ArtikelKategorie')->findForTimetable($a_k_id);

        $helper = $this->get('appbundle.helper.widget');
        $zeiten = null;
        if($kategorie){
            $zeiten = $helper->ZeitenWandler($kategorie);
        }

        return $this->render('@AppBundle/Widgets/zeitentabelle.html.twig', [
            'zeiten' => $zeiten, 'kategorie' => $kategorie,
        ]);

    }

    public function vertriebUebersichtAction(Request $request){

        $user = $this->getUser();

        $em     =   $this->getDoctrine()->getManager();

        $overview = $em->getRepository('AppBundle\Entity\AgenturVertrieb')->findVertriebOverview($user);

        return $this->render('@AppBundle/Widgets/vertriebUebersicht.html.twig', [
            'uebersicht' => $overview,
        ]);

    }


    /**
     * @Route("/widget/pdf/", name="widget_generate_pdf", )
     */
    public function pdfGenerateAction(Request $request)
    {
        $path = $request->query->get('path');

        $html = $this->renderView('@AppBundle/Pdf/rechnung.html.twig');

        dump($path, $html);


        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );
    }
}
