<?php

namespace AppBundle\Controller\Vertrieb;

use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CheckinController extends Controller
{
    /**
     *
     * @Route("/checkin", name="vb_checkin")
     */
    public function indexAction(Request $request)
    {

        $this->denyAccessUnlessGranted('ROLE_VERTRIEB_ACCOUNT_PARTNER', null, 'Sie haben keinen Zugriff auf diese Seite!');

        $content    = "<h1>Der Voucher</h1>
<p>Sie als Leistungsträger haben die Möglichkeit alle Voucher / Tickets welche von der Sightseeing Kontor oder der Hamburg Citytours vertrieben wurden direkt einzuchecken. Das Einchecken der Leistung hat folgenden Hintergrund:</p>
<ul>
    <li><p>Zur überprüfung der Leistung auf Art, Datum oder Gültigkeit.</p></li>
    <li><p>Um einen unberechtigten Zugang zu ihren Angebotenen Leistung zu vermeiden.</p></li>
    <li><p>Zur Entwertung des Vouchers.</p></li>
    <li><p>Zum Freigeben zur Abrechnung.</p>
</li>
</ul>
<h2>Wie checke ich einen Voucher ein?</h2>
<p>Das einlösen/einchecken einer Leistung kann auf 2 Methoden erfolgen.</p>
<ol>
<li><p><b>Manuell</b> - Die erste Methode ist das manuelle einchecken der Voucher auf der folgenden Seite. Hier können die Rechnungsnummerb manuell eingetragen und die damit verknüpfte Leistung direkt entwertet und abgerechnet werden. Voucher, dessen QR-Code nicht eingelesen werden konnten, lassen sich über diesen Weg einchecken, auch über das Ablaufdatum hinaus.</p></li>
<li><p><b>QR-Scan</b> - Die zweite Möglichkeit erfolgt über eine mobile Lösung mit einem mobilen Endgerät. Hierzu werden ein Smartphone, eine QR-Code App und ein Zugang benötigt.<br>Mit der QR-Code App können Sie die QR-Codes (quadratischer Strichcode) die sich auf allen unseren Voucher befinden direkt über das Smartphone erfassen und direkt einchecken.<br>Für Apple-Smartphones (Apple App Store) empfehlen wir folgende App: Scan - QR-Code und Barcodeleser von QR Code City<br>Für Android-Smartphones (Google Play Store) empfehlen wir folgende App:<br>Zusätzlich wird noch ein Zugang benötigt, welchen Sie über die Benutzer-Oberfläche anlegen können. Der Zugang den Sie genutzt haben um sich hier anzumelden kann ebenfalls zum einscanen genutzt werden.</p></li>
</ol>
Manuell - Die erste Methode ist das manuelle einchecken der Voucher auf der folgenden Seite. Hier können die Rechnungsnummerb manuell eingetragen und die damit verknüpfte Leistung direkt entwertet und abgerechnet werden. Voucher, dessen QR-Code nicht eingelesen werden konnten, lassen sich über diesen Weg einchecken, auch über das Ablaufdatum hinaus.
<h2>Was passiert nach dem Einscanen?</h2>
<p>Nach Erfolgreichem einscanen können Sie am Ende des Monats unsere Statistik nutzen um Ihre Abbrechnung an uns zu erstellen oder eine Abbrechnung erfolgt automatisch. Dies ist je nach Absprache und Vereinbarung unterschiedlich.</p>
<p>Sofern Sie kein eigenes Smartphone zur Verfügung haben, können wir ihnen gegen Vorlage einer Kaution, über den Zeitraum unserer Kooperation eines zur Verfügung stellen.</p>";

        return $this->render('@AppBundle/content.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'), 'content' => $content
        ]);
    }

    /**
     * @Route("/checkin/overview", name="vb_checkin_overview")
     */
    public function OverviewAcition(Request $request){

        $this->denyAccessUnlessGranted('ROLE_VERTRIEB_ACCOUNT_PARTNER', null, 'Sie haben keinen Zugriff auf diese Seite!');

        $positionen = $this->getDoctrine()->getManager()->getRepository('AppBundle:ShopScans');

        $scans = $positionen->findAllScanedPositions( $this->getUser(), 1);


        $jahre = array();

        dump($scans);

        foreach($scans as $sc){
            $scanned = "";

            $v_jahr = $sc['jahr'];
            $v_monate = intval($sc['monat']);

            if(!array_key_exists($v_jahr, $jahre)){

                $jahre[$v_jahr] = array();
                $jahre[$v_jahr]['bezeichnung'] = $sc['jahr'];
                $jahre[$v_jahr]['beschreibung'] = 'Scans für ';
                $jahre[$v_jahr]['monate'] = array();
            }

            if(!array_key_exists($v_monate, $jahre[$v_jahr]['monate'])){

                $monat = \DateTime::createFromFormat('!m', $sc['monat']);

                $jahre[$v_jahr]['monate'][$v_monate] = array();
                $jahre[$v_jahr]['monate'][$v_monate]['bezeichnung'] = $monat->format('M');
                $jahre[$v_jahr]['monate'][$v_monate]['beschreibung'] = "";
                $jahre[$v_jahr]['monate'][$v_monate]['inhalt'] = array();
                $jahre[$v_jahr]['monate'][$v_monate]['statistik'] = 0;
                $jahre[$v_jahr]['monate'][$v_monate]['statistik_summe'] = 0;
            }


            $jahre[$v_jahr]['monate'][$v_monate]['statistik'] += $sc['anzahl'];

            $sc['xa_summe_netto'] = ($sc['anzahl'] * $sc['xa_netto']) ?: 0;

            $jahre[$v_jahr]['monate'][$v_monate]['statistik_summe'] += $sc['xa_summe_netto'];
            $jahre[$v_jahr]['monate'][$v_monate]['inhalt'][] = $sc;
        }

        $content = "<h2>Gescannte Positionen</h2>
	<p>Im folgendem werden Ihnen die Positionen aufgelistet, sortiert nach Monaten in denen Sie eingescannt wurde. In der Übersicht werden nur Tickets eingescannt, welche eingescannt wurden. <br><br>
	<i></i></p><center><i>Der genaue Abrechnungszeitraum ist vom 5. des Monats bis jeweils 5. des Folgemonats definiert.</i></center>
	<br><br>Diese Übersicht dient zur Abbrechnung. Je nach Vertrag / Absprache erfolgt die Abrechnung der Positionen automatisch. Bei der automatischen Abrechnung werden die bis zum Zeitpunkt der Verrechnung gültigen EK-Preise verwendet. <br>Sollten eine in Rechnung Stellung ihrerseits erfolgen, können Sie die unten stehende Übersicht hierzu nutzen.<br><br>";

        return $this->render('@AppBundle/content.html.twig', [
            'content' => $content, 'statistik' => $jahre
        ]);
    }

    /**
     * @Route("/checkin/einscannen", name="vb_checkin_manuell")
     */
    public function einscannenAction()
    {

        $this->denyAccessUnlessGranted('ROLE_VERTRIEB_ACCOUNT_PARTNER', null, 'Sie haben keinen Zugriff auf diese Seite!');
        
        $content = "<h2>Voucher einscannen</h2>
				<p>Hier können Sie den Voucher einscannen um seine Gültigkeit zu überprüfen, ihn zur Abrechnung freizuschalten und um ihn ungültig zu machen. Tragen Sie hierzu die Vorgangs-/Rechnungsnummer in das untenstehende Feld ein.</p>";

        return $this->render('@AppBundle/content.html.twig', [
            'content' => $content,
            'checkin' => true,
        ]);
    }

}
