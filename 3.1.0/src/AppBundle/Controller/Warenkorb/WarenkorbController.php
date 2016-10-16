<?php

namespace AppBundle\Controller\Warenkorb;

use AppBundle\Entity\Artikel;
use AppBundle\Entity\ShopSession;
use AppBundle\Entity\ShopWarenkorb;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class WarenkorbController extends Controller
{

    /**
     * @Route("/warenkorb/widget", name="wc_widget")
     * @Route("/warenkorb/index", name="wc_index")
     */
    public function widgetAction(Request $request)
    {
        $index = false;
        if($request->attributes->get('_route') == "wc_index"){
            $index = true;
        }

        $em = $this->getDoctrine()->getManager();

        $session_id = $request->cookies->get('PHPSESSID');
        $session = $em->getRepository('AppBundle\Entity\ShopSession')->findSession($session_id);

        if(!$session) {

            $session = new ShopSession();
            $session->setSSession($session_id);

            $em = $this->getDoctrine()->getManager();

            $em->persist($session);
            $em->flush();
            
        }

        $html = $this->render('@AppBundle/Warenkorb/wc_widget.html.twig', array('warenkorb' => $session, 'index' => $index))->getContent();
        $json = array('success' => true, 'warenkorb_size' => $session->getSTicketsAnzahl(), 'html' => $html);

        $response = new JsonResponse();
        $response->setData($json);

        return $response;
    }

    /**
     * @Route("/warenkorb/overview", name="wc_overview")
     */
    public function overviewAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $session_id = $request->cookies->get('PHPSESSID');
        $session = $em->getRepository('AppBundle\Entity\ShopSession')->findSession($session_id);

        return $this->render('@AppBundle/Warenkorb/wc_overview.html.twig', array('warenkorb' => $session));

    }

    /**
     * @Route("/warenkorb/rein_json", name="wc_rein_json")
     */
    public function reinJsonAction(Request $request)
    {
        $insert = false;
        $insert_date = false;
        $insert_date_force = false;
        $times = false;
        $opens = false;
        /**
         * @var EntityManager
         */
        $em = $this->getDoctrine()->getManager();

        $session_id = $request->cookies->get('PHPSESSID');
        $session = $em->getRepository('AppBundle\Entity\ShopSession')->findSession($session_id);

        $JS = json_decode($request->query->get('JSON'));

        if(is_object($JS)){

            $t_id       =   $JS->tickets;
            $t_kid      =   $JS->kategorie;
            $t_anzahl   =   $JS->anzahl;

            $t_datum    =   $JS->datum->set === true ? $JS->datum->val : "";
            if($t_datum) $t_datum = new \DateTime($t_datum);
            $t_time     =   $JS->zeit->set === true ? $JS->zeit->val : "";

            $t_del      =   "";

        } else {

            $t_id       =   $request->query->get('tid');
            $t_kid      =   $request->query->get('kid');
            $t_anzahl   =   $request->query->get('an');

            $t_datum    =   $request->query->get('da');
            if($t_datum) $t_datum = new \DateTime($t_datum);
            $t_time     =   $request->query->get('tm');

            $t_del     =   $request->query->get('del');
        }




        $json = array("success" => false);

        if( ($t_id && $t_anzahl > 0 ) || $t_kid) {

            if($t_kid){
                $kategorie = $em->getRepository("AppBundle\Entity\ArtikelKategorie")->findForTimetable($t_kid);
            } else {
                $kategorie = $em->getRepository("AppBundle\Entity\ArtikelKategorie")->findByTimetableByArtikel($t_id);
            }

            $waren_tickets = new ArrayCollection();

            if($t_id){

                foreach($t_id as $anf_ticket){

                    $artikel = $em->getRepository("AppBundle\Entity\Artikel")->find($anf_ticket->id);

                    $waren_ticket = $session->getSWarenkorb()->filter( function ($t) use ($artikel) { if($t->getWcAId() == $artikel){ return true; }})->first();

                    if(!$waren_ticket) {

                        $waren_ticket = new ShopWarenkorb();
                        $waren_ticket->setWcSId($session);
                        $waren_ticket->setWcAId($artikel);
                        $waren_ticket->setWcName($artikel->getAKid()->getAKName() ." ". $artikel->getAName());
                        $waren_ticket->setWcNameEn($artikel->getAKid()->getAKNameEn() ." ". $artikel->getANameEn());
                        $waren_ticket->setWcArtikelnummer($em->getReference('AppBundle\Entity\ShopPositionArtikelnummern', $artikel->getAFullArtikelnummer()));
                        $waren_ticket->setWcPreis($artikel->getAPreis());

                    }
                    $waren_ticket->setWcMenge( $anf_ticket->an );
//                    $waren_ticket->setWcMenge( $waren_ticket->getWcMenge() + $anf_ticket->an );

                    $waren_tickets->add( $waren_ticket );

                }

            }

            if( $kategorie->getAKAktiv() ){

                if($kategorie->isDateRequired()){

                    $today = new \DateTime();

                    if($t_datum instanceof \DateTime){

                        $diff = $t_datum->diff($today);

                        if($diff->invert == 1 || $diff->days === 0 ){ // Entweder in der Zukunft oder am selben Tag
                            foreach($waren_tickets as $wc_t){
                                if($wc_t instanceof ShopWarenkorb){
                                    $wc_t->setWcDatum($t_datum);
                                }
                            }

                            if($kategorie->isDateBookable($t_datum)){

                                $time = $kategorie->isTimeForDateRequired();

                                if($time){

                                    if($t_time){ // Wenn Uhrzeit übermittelt wurde, dann wird es in Warenkorb-ticket geschrieben

                                        $time_set = false;

                                        foreach($time as $t) {

                                            if($t['time'] == $t_time && !$time_set){

                                                $t_datum->setTime(substr($t_time, 0, 2), substr($t_time, 3, 2));
                                                $json['success'] = true;

                                                $time_set = true;

                                            } elseif(!$time_set) {

                                                $json['message'] = 'Uhrzeit ist nicht buchbar';

                                            }

                                        }

                                    } else {

                                        if(sizeof($time) > 0){

                                            $json['message'] = 'missing_time';
                                            $json['times'] = $kategorie->zeiten;

                                        } else {

                                            $t_datum->setTime(substr(reset($time)['time'], 0, 2), substr(reset($time)['time'], 3, 2));
                                            $json['times'] = $kategorie->zeiten;
                                        }

                                    }

                                } else {

                                }

                            } else {
                                $json['message'] = 'Das Datum ist leider nicht buchbar';
                                $json['error'] = '-302';
                            }

                        } else {
                            $json['message'] = 'Datum liegt in der Vergangenheit';
                            $json['error'] = '-301';

                        }

                    } else {

                        $json['message'] = 'Datum fehlt';
                        $json['error'] = '-300';

                    }

                } else {

                    $json['success'] = true;

                }

            } else {

                    $json['message'] = 'Artikel oder Kategorie wurde deaktiviert';
                    $json['error'] = '-100';
                }


        } elseif($t_del){

            $waren_ticket = $em->getRepository("AppBundle\Entity\ShopWarenkorb")->find($t_del);

            if($waren_ticket){
                if($session->getSWarenkorb()->contains($waren_ticket) == true){

                    $em->remove($waren_ticket);
                    $em->flush();

                    $json['success'] = true;
                } else {
                    $json['message'] = 'Das Ticket stammt von einem anderen Warenkorb...';
                    $json['error'] = '-9';
                }
            } else {
                $json['message'] = 'kein Ticket vorhanden';
                $json['error'] = '-100';
            }

        } else {
            if($t_id && !$t_anzahl){
                $json['message'] = "Bitte wählen Sie eine Personenanzahl aus";
                $json['error'] = "-990";
            } else {
                $json['message'] = "Unbekannter Fehler";
                $json['error'] = "-999";
            }
        }

        if($json['success'] && !$t_del){

            foreach($waren_tickets as $wc_t){
                if($wc_t instanceof ShopWarenkorb){

                    $em->persist($wc_t);
                    $em->flush();

                }
            }

        }

        Antwort:

        $response = new JsonResponse();
        $response->setData($json);

        return $response;
    }

    /**
     * @Route("/warenkorb/update", name="wc_update")
     */
    public function updateAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $session_id = $request->cookies->get('PHPSESSID');
        $session = $em->getRepository('AppBundle\Entity\ShopSession')->findSession($session_id);

        $json = array('success' => false);

        $t_id       =   $request->query->get('tid');
        $t_anzahl   =   $request->query->get('an');

        if($t_id && $t_anzahl){

            $waren_ticket = $em->getRepository("AppBundle\Entity\ShopWarenkorb")->find($t_id);

            if($waren_ticket){
                if($session->getSWarenkorb()->contains($waren_ticket)){
                    $waren_ticket->setWcMenge($t_anzahl);

                    $em->persist($waren_ticket);
                    $em->flush();

                    $json = array('success' => true);
                }
            }
        }

        $response = new JsonResponse();
        $response->setData($json);

        return $response;

    }
}
