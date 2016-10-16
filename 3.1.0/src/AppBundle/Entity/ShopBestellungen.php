<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ShopBestellungen
 *
 * @ORM\Table(name="SHOP_Bestellungen", uniqueConstraints={@ORM\UniqueConstraint(name="b_rnnr", columns={"b_rnnr"})}, indexes={@ORM\Index(name="b_art", columns={"b_art"}), @ORM\Index(name="b_summe", columns={"b_summe"}), @ORM\Index(name="b_booked", columns={"b_booked"})})
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ShopBestellungenRepository")
 */
class ShopBestellungen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="nr", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nr;

    /**
     * @var ShopKunde
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopKunde", inversedBy="kBestellungen")
     * @ORM\JoinColumn(name="bKid", referencedColumnName="k_id")
     */
    private $bKid;

    /**
     * @var \AppBundle\Entity\ShopScans
     * 
     * @ORM\OneToMany(targetEntity="ShopScans", mappedBy="scBNr")
     */
    private $bSc;

    /**
     * @var \AppBundle\Entity\ShopPosition
     * 
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ShopPosition", mappedBy="pBid", cascade={"persist"})
     *
     */
    protected $bPositionen;

    /**
     * @var integer
     *
     * @ORM\Column(name="b_bnr", type="integer", nullable=true)
     */
    private $bBnr;

    /**
     * @var string
     *
     * @ORM\Column(name="b_lang", type="string", length=8, nullable=true)
     */
    private $bLang = 'de-DE';

    /**
     * @var string
     *
     * @ORM\Column(name="b_firma", type="string", length=3, nullable=true)
     */
    private $bFirma = "SK";

    /**
     * @var string
     *
     * @ORM\Column(name="b_rnnr", type="string", length=32, nullable=true)
     */
    private $bRnnr;

    /**
     * @var string
     *
     * @ORM\Column(name="b_ref", type="string", length=64, nullable=true)
     */
    private $bRef;

    /**
     * @var boolean
     *
     * @ORM\Column(name="b_art", type="integer", nullable=false)
     */
    private $bArt = 1;

    /**
     * @var string
     */
    private $bArtLabel = "";

    /**
     * @var AgenturVertrieb
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgenturVertrieb", inversedBy="avRechnungen")
     * @ORM\JoinColumn(name="b_vid", referencedColumnName="av_id", nullable=true)
     */
    private $bVid;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Bitte Tragen Sie ein Reisedatum ein.")
     * @ORM\Column(name="b_datum", type="date", nullable=false)
     */
    private $bDatum;

    /**
     * @var string
     *
     * @ORM\Column(name="b_summe", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $bSumme = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="b_bezahlart", type="integer", nullable=true)
     */
    private $bBezahlart = 1;

    /**
     * @var string
     */
    private $bBezahlartLabel = "";

    /**
     * @var boolean
     *
     * @ORM\Column(name="b_bezahlt", type="boolean", nullable=false)
     */
    private $bBezahlt = false;

    /**
     * @var string
     */
    private $bBezahltLabel = "";

    /**
     * @var integer
     *
     * @ORM\Column(name="b_bhinweis", type="integer", length=1, nullable=false)
     */
    private $bBhinweis = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="b_esent", type="boolean", nullable=false)
     */
    private $bEsent = false;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgenturUser", inversedBy="auVorgaenge")
     * @ORM\JoinColumn(name="b_user", referencedColumnName="au_id", nullable=true)
     */
    private $bUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="b_created", type="datetime", nullable=false)
     */
    private $bCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="b_booked", type="datetime", nullable=true)
     */
    private $bBooked;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="b_payed", type="datetime", nullable=true)
     */
    private $bPayed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="b_frist", type="datetime", nullable=true)
     */
    private $bFrist;

    /**
     * @var boolean
     *
     * @ORM\Column(name="b_frist_status", type="boolean", nullable=false)
     */
    private $bFristStatus = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="b_oview", type="integer", nullable=false)
     */
    private $bOview = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="b_calc", type="boolean", nullable=false)
     */
    private $bCalc = '0';

    /**
     * @var ShopMitteilungen
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ShopMitteilungen", mappedBy="mBid", cascade={"remove"})
     */
    protected $bMitteilungen;

    /**
     * @var ShopAnBemerkung
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ShopAnBemerkung", mappedBy="oBid", cascade={"remove"})
     */

    protected $bBemerkungen;
    /**
     * @var Payments
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Payments", mappedBy="payBid")
     */

    protected $bZahlungen;

    /**
     * @var ShopDokumente
     *
     * @ORM\OneToMany(targetEntity="ShopDokumente", mappedBy="doBid")
     */
    protected $bDocs;

    /**
     * @var ArtikelKategorie
     */
    private $bKategorien;


    public function __construct()
    {
        $this->bPositionen = new ArrayCollection();
    }

    /**
     * Get nr
     *
     * @return integer
     */
    public function getNr()
    {
        return $this->nr;
    }

    /**
     * Set bKid
     *
     * @param integer $bKid
     *
     * @return ShopBestellungen
     */
    public function setBKid($bKid)
    {
        $this->bKid = $bKid;

        return $this;
    }

    /**
     * Get bKid
     *
     * @return integer
     */
    public function getBKid()
    {
        return $this->bKid;
    }

    /**
     * Set bBnr
     *
     * @param integer $bBnr
     *
     * @return ShopBestellungen
     */
    public function setBBnr($bBnr)
    {
        $this->bBnr = $bBnr;

        return $this;
    }

    /**
     * Get bBnr
     *
     * @return integer
     */
    public function getBBnr()
    {
        return $this->bBnr;
    }

    /**
     * Set bLang
     *
     * @param string $bLang
     *
     * @return ShopBestellungen
     */
    public function setBLang($bLang)
    {
        $this->bLang = $bLang;

        return $this;
    }

    /**
     * Get bLang
     *
     * @return string
     */
    public function getBLang()
    {
        return $this->bLang;
    }

    /**
     * Set bFirma
     *
     * @param string $bFirma
     *
     * @return ShopBestellungen
     */
    public function setBFirma($bFirma)
    {
        $this->bFirma = $bFirma;

        return $this;
    }

    /**
     * Get bFirma
     *
     * @return string
     */
    public function getBFirma()
    {
        return $this->bFirma;
    }

    /**
     * Set bRnnr
     *
     * @param string $bRnnr
     *
     * @return ShopBestellungen
     */
    public function setBRnnr($bRnnr)
    {
        $this->bRnnr = $bRnnr;

        return $this;
    }

    public function createBRnnr($rnnr = null)
    {
        if($rnnr){

            $this->bRnnr = $rnnr;


        } elseif($this->nr){

            if(!$this->bRnnr && $this->bUser->getAuVid()){

                $anfang = $this->nr;
                $ende = $this->bUser->getAuVid()->getAvId();

                if(!$this->bKid) $this->bKid = $this->bUser->getAuVid()->getAvKid();

                $this->bRnnr = $anfang . "-" . $ende;

            } elseif(!$this->bRnnr && $this->bKid) {

                $anfang = date('Ymd');
                $mitte = $this->nr();
                $ende = $this->getBKid()->getKId();

                $rnnr = $anfang."-".$mitte."-".$ende;

                $this->bRnnr = $rnnr;

            }

        } else {

            return false;

        }

        return $this->bRnnr;

    }

    /**
     * Get bRnnr
     *
     * @return string
     */
    public function getBRnnr()
    {
        return $this->bRnnr;
    }

    /**
     * Set bRef
     *
     * @param string $bRef
     *
     * @return ShopBestellungen
     */
    public function setBRef($bRef)
    {
        $this->bRef = $bRef;

        return $this;
    }

    /**
     * Get bRef
     *
     * @return string
     */
    public function getBRef()
    {
        return $this->bRef;
    }

    /**
     * Set bArt
     *
     * @param boolean $bArt
     *
     * @return ShopBestellungen
     */
    public function setBArt($bArt)
    {
        $this->bArt = $bArt;

        return $this;
    }

    /**
     * Get bArt
     *
     * @return boolean
     */
    public function getBArt()
    {
        return $this->bArt;
    }

    /**
     * @return string
     */
    public function getBArtLabel()
    {
        $label = "";
        switch ($this->bArt) {
            case 1:
                $label = "Anfrage";
                break;
            case 2:
                $label = "Angebot";
                break;
            case 3:
                $label = "Rechnung";
                break;
            case 4:
                $label = "Vertrieb";
                break;
            case 96:
                $label = "Vertrieb";
                break;
            case 97:
                $label = "Storno / Vertrieb";
                break;
            case 98:
                $label = "OP / Nicht abgeschlossen";
                break;
            case 99:
                $label = "Vorgang abgebrochen";
                break;
            default:
                $label = "sonstiges";
        }
        return $label;
    }
    /**
     * Set bVid
     *
     * @param integer $bVid
     *
     * @return ShopBestellungen
     */
    public function setBVid($bVid)
    {
        $this->bVid = $bVid;

        return $this;
    }

    /**
     * Get bVid
     *
     * @return integer
     */
    public function getBVid()
    {
        return $this->bVid;
    }

    /**
     * Set bDatum
     *
     * @param \DateTime $bDatum
     *
     * @return ShopBestellungen
     */
    public function setBDatum($bDatum)
    {
        $this->bDatum = $bDatum;
        return $this;
    }

    /**
     * Get bDatum
     *
     * @return \DateTime
     */
    public function getBDatum()
    {
        return $this->bDatum;
    }

    /**
     * Set bSumme
     *
     * @param string $bSumme
     *
     * @return ShopBestellungen
     */
    public function setBSumme($bSumme)
    {
        $this->bSumme = $bSumme;

        return $this;
    }

    /**
     * Get bSumme
     *
     * @return string
     */
    public function getBSumme()
    {
        return $this->bSumme;
    }

    public function checkBSumme($return_sum = false){
        $cache_sum = 0;
        foreach($this->pPositionen as $p){
            $cache_sum += $p->getPAnzahl() * $p->getPPreis();
        }


        if($cache_sum == $this->bSumme){
            if($return) {
                return $cache_sum;
            } else {
                return true;
            }
        }

        if($return) {
            return $cache_sum;
        } else {
            return false;
        }

    }

    /**
     * @return int;
     */
    public function refreshBSumme(){

        if($this->checkBSumme() == false){
            $this->bSumme = $this->checkBSumme(true);
        }
        return $this->bSumme;
    }

    /**
     * Set bBezahlart
     *
     * @param integer $bBezahlart
     *
     * @return ShopBestellungen
     */
    public function setBBezahlart($bBezahlart)
    {
        $this->bBezahlart = $bBezahlart;

        return $this;
    }

    /**
     * Get bBezahlart
     *
     * @return integer
     */
    public function getBBezahlart()
    {
        return $this->bBezahlart;
    }

    /**
     * Set bBezahlt
     *
     * @param boolean $bBezahlt
     *
     * @return ShopBestellungen
     */
    public function setBBezahlt($bBezahlt)
    {
        $this->bBezahlt = $bBezahlt;

        return $this;
    }

    /**
     * Get bBezahlt
     *
     * @return boolean
     */
    public function getBBezahlt()
    {
        return $this->bBezahlt;
    }

    /**
     * Set bBhinweis
     *
     * @param integer $bBhinweis
     *
     * @return ShopBestellungen
     */
    public function setBBhinweis($bBhinweis)
    {
        $this->bBhinweis = $bBhinweis;

        return $this;
    }

    /**
     * Get bBhinweis
     *
     * @return integer
     */
    public function getBBhinweis()
    {
        return $this->bBhinweis;
    }

    /**
     * Set bEsent
     *
     * @param boolean $bEsent
     *
     * @return ShopBestellungen
     */
    public function setBEsent($bEsent)
    {
        $this->bEsent = $bEsent;

        return $this;
    }

    /**
     * Get bEsent
     *
     * @return boolean
     */
    public function getBEsent()
    {
        return $this->bEsent;
    }

    /**
     * Set bUser
     *
     * @param integer $bUser
     *
     * @return ShopBestellungen
     */
    public function setBUser($bUser)
    {
        $this->bUser = $bUser;

        return $this;
    }

    /**
     * Get bUser
     *
     * @return integer
     */
    public function getBUser()
    {
        return $this->bUser;
    }

    /**
     * Set bCreated
     *
     * @param \DateTime $bCreated
     *
     * @return ShopBestellungen
     */
    public function setBCreated($bCreated)
    {
        $this->bCreated = $bCreated;

        return $this;
    }

    /**
     * Get bCreated
     *
     * @return \DateTime
     */
    public function getBCreated()
    {
        return $this->bCreated;
    }

    /**
     * Set bBooked
     *
     * @param \DateTime $bBooked
     *
     * @return ShopBestellungen
     */
    public function setBBooked($bBooked)
    {
        $this->bBooked = $bBooked;

        return $this;
    }

    /**
     * Get bBooked
     *
     * @return \DateTime
     */
    public function getBBooked()
    {
        return $this->bBooked;
    }

    /**
     * Set bPayed
     *
     * @param \DateTime $bPayed
     *
     * @return ShopBestellungen
     */
    public function setBPayed($bPayed)
    {
        $this->bPayed = $bPayed;

        return $this;
    }

    /**
     * Get bPayed
     *
     * @return \DateTime
     */
    public function getBPayed()
    {
        return $this->bPayed;
    }

    /**
     * Set bFrist
     *
     * @param \DateTime $bFrist
     *
     * @return ShopBestellungen
     */
    public function setBFrist($bFrist)
    {
        $this->bFrist = $bFrist;

        return $this;
    }

    /**
     * Get bFrist
     *
     * @return \DateTime
     */
    public function getBFrist()
    {
        return $this->bFrist;
    }

    /**
     * Set bFristStatus
     *
     * @param boolean $bFristStatus
     *
     * @return ShopBestellungen
     */
    public function setBFristStatus($bFristStatus)
    {
        $this->bFristStatus = $bFristStatus;

        return $this;
    }

    /**
     * Get bFristStatus
     *
     * @return boolean
     */
    public function getBFristStatus()
    {
        return $this->bFristStatus;
    }

    /**
     * Set bOview
     *
     * @param integer $bOview
     *
     * @return ShopBestellungen
     */
    public function setBOview($bOview)
    {
        $this->bOview = $bOview;

        return $this;
    }

    /**
     * Get bOview
     *
     * @return integer
     */
    public function getBOview()
    {
        return $this->bOview;
    }

    /**
     * Set bCalc
     *
     * @param boolean $bCalc
     *
     * @return ShopBestellungen
     */
    public function setBCalc($bCalc)
    {
        $this->bCalc = $bCalc;

        return $this;
    }

    /**
     * Get bCalc
     *
     * @return boolean
     */
    public function getBCalc()
    {
        return $this->bCalc;
    }

    /**
     * @return ShopScans
     */
    public function getBSc()
    {
        return $this->bSc;
    }

    /**
     * @param ShopScans $bSc
     */
    public function setBSc($bSc)
    {
        $this->bSc = $bSc;
    }

    /**
     * @return ShopPosition
     */
    public function getBPositionen()
    {
        return $this->bPositionen;
    }

    /**
     * @param ShopPosition $bPositionen
     */
    public function setBPositionen($bPositionen)
    {
        $this->bPositionen = $bPositionen;
    }

    /**
     * @return ArtikelKategorie
     */
    public function checkBKategorien()
    {
        $this->bKategorien = new ArrayCollection();
        foreach($this->bPositionen as $p){
            $pk = $p->getPTid();
            if($pk){

                $kat = $pk->getPkKategorie();
                if($p->getPDatum()){

                    $datum = $p->getPDatum()->format('Ymd');
                }else{
                    $datum = "GENERAL";
                }

                $index = $kat->getAKId()."-".$datum;
                if($kat){

                    if(!$this->bKategorien->offsetExists($index)){
                        $this->bKategorien->offsetSet($index, $kat);

                        $kat->checkin_positionen = new ArrayCollection();
                    }

                    $kat->checkin_positionen ->add($p);

                    if($p->getPDatum()){
                        $kat->datum = $p->getPDatum();
                        $kat->checkin_datum = $p->getPDatum();
                        $diff_now = $p->getPDatum()->diff(new \DateTime('Now'));

                    }
                    foreach ($this->getBSc() as $sc){
                        if($sc->getScK() == $kat){
                            $kat->scan = $sc;
                            $kat->checkin_message = "Die Leistunge wurde bereits von ".$sc->getScAu()->getAuVorname()." ".$sc->getScAu()->getAuNachname()." am ".$sc->getScScanned()->format('d.m.Y H:i')." eingescannt.";
                        }
                    }
                }
            }
            $this->bKategorien;
        }

        // Überprüft nun ob bezogen auf das Datum der leistung eingecheckt werden kann.
        foreach($this->bKategorien as $k){

            $k->checkin_datum = new \DateTime('23.09.2016');
            if($k->checkin_datum){

                $diff_now = $k->checkin_datum->diff(new \DateTime('Now'));

                if($diff_now->invert == 0 && $diff_now->days > 0 ) {

                    $k->checkin = true;

                } else {

                    $k->checkin_message = "Die Leistung ist für den ".$k->checkin_datum->format('d.m.Y')." angemeldet und kann nur an dem Tag eingelöst werden.";

                }

            } else {

                $diff_now = $this->getBDatum()->diff(new \DateTime('Now'));

                if($diff_now->invert == 0 && $diff_now->days > 0){

                    $k->checkin = true;

                } else {

                    $k->checkin_message = "Die Leistung kann erst ab dem ".$this->getBDatum()->format('d.m.Y')." eingelöst werden.";
                }

            }

        }

        return $this->bKategorien;
    }

    /**
     * @return ArtikelKategorie
     */
    public function getBKategorien()
    {

        if(!$this->bKategorien) $this->checkBKategorien();
        
        return $this->bKategorien;
    }

    /**
     * @return string
     */
    public function getBBezahlartLabel()
    {
        switch ($this->bBezahlart) {
            case 1:
                $label = "Vorkasse";
                break;
            case 2:
                $label = "PayPal";
                break;
            case 3:
                $label = "SofortÜberwe";
                break;
            case 4:
                $label = "Vertreib";
                break;
            default:
                $label = "sonstiges";
        }
        return $label;
    }

    /**
     * @return string
     */
    public function getBBezahltLabel()
    {
        $label = "";
        switch ($this->bBezahlt) {
            case 1:
                $label = "Bezahlt";
                break;
            case 2:
                $label = "Gutschrift";
                break;
            case 0:
                $label = "offen";
                break;
        }
        return $label;
    }

    /**
     * @return ShopMitteilungen
     */
    public function getBMitteilungen()
    {
        return $this->bMitteilungen;
    }

    /**
     * @param ShopMitteilungen $bMitteilungen
     */
    public function setBMitteilungen($bMitteilungen)
    {
        $this->bMitteilungen = $bMitteilungen;
    }

    /**
     * @return ShopAnBemerkung
     */
    public function getBBemerkungen()
    {
        return $this->bBemerkungen;
    }

    /**
     * @param ShopAnBemerkung $bBemerkungen
     */
    public function setBBemerkungen($bBemerkungen)
    {
        $this->bBemerkungen = $bBemerkungen;
    }

    /**
     * @return Payments
     */
    public function getBZahlungen()
    {
        return $this->bZahlungen;
    }

    /**
     * @param Payments $bZahlungen
     */
    public function setBZahlungen($bZahlungen)
    {
        $this->bZahlungen = $bZahlungen;
    }

    public function transformWarenkorb(ShopSession $session){

        foreach($session->getSWarenkorb() as $ware){

            $position = new ShopPosition();

            $position->setPBid($this);
            $position->setPTid($ware->getWcArtikelnummer());
            $position->setPAnzahl($ware->getWcMenge());
            $position->setPPreis($ware->getWcPreis());
            $position->setPDatum($ware->getWcDatum());
            $position->setPBezeichnung($ware->getWcName());
            $position->setPBezeichnungEn($ware->getWcNameEn());
            $position->setPVtext($ware->getWcAid()->getAKid()->getAKVText());
            $position->setPRtext($ware->getWcAid()->getAKid()->getAKRText());
            $position->setPMwst(19);

            $this->bSumme += $position->getPPreis() * $position->getPAnzahl();

            $this->bPositionen->add($position);

            if($this->bPositionen->contains($position)) {
                $session->removeSWarenkorb($ware);
            }
        }
    }

    /**
     * @return ShopDokumente
     */
    public function getBDocs()
    {
        return $this->bDocs;
    }

    /**
     * @param ShopDokumente $bDocs
     */
    public function setBDocs($bDocs)
    {
        $this->bDocs = $bDocs;
    }

    public function getBAngebot()
    {
        if(!$this->bDocs->count()) return false;

        foreach($this->bDocs as $doc){
            if($doc->getDoType() == 1){
                return $doc;
            }
        }
        return false;
    }

    public function getBRechnung()
    {

        if(!$this->bDocs->count()) return false;

        foreach($this->bDocs as $doc){
            if($doc->getDoType() == 3){
                return $doc;
            }
        }
        return false;
    }

    public function getBVoucher()
    {
        if(!$this->bDocs->count()) return false;

        foreach($this->bDocs as $doc){
            if($doc->getDoType() == 2){
                return $doc;
            }
        }

        return false;
    }

    public function generateBVoucher($overwrite = true){

        if(1==1){

        }

    }

    public function generatePDF($art = 0, AgenturUser $user, $get_link = 0, $get_full_link = true, $spezial = null, $entwickler = null){

        $rnnr = $this->nr;

        $typ = "pdf";
        $art_array = array('rn', 'an', 'vc'); // rn

        $link_to_show_pdf = "http://api.sightseeing-kontor.de/pdfs/show/?s=";

        if(!$rnnr) return "Fehler: Rechnungsnummer nicht vorhanden CODE 001 (ADMIN benachrichtigen)";

        if($typ == "pdf"){
            if(!in_array($art, $art_array)) return "Fehler: Falsche Art CODE 003a (ADMIN benachrichtigen)";
        } elseif($typ == "mail") {
            if(!is_numeric($art)) return "Fehler: Falsche Art CODE 003b (ADMIN benachrichtigen)";
        }



        $url = "http://api.sightseeing-kontor.de/pdfs/generate/";

        $key = "#&$sdfdfs789fs7d";

        $myVarIWantToEncodeAndDecode = $rnnr.";".$art.";".";".$user.";".$get_link.";".$spezial.";".$entwickler;

        $decode = rawurlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $myVarIWantToEncodeAndDecode, MCRYPT_MODE_CBC, md5(md5($key)))));

        if(!$decode) return "Fehler: Keine Variablen zum übergeben (ADMIN benachrichtigen)";

        $string = $url."?_=".$decode;

        $ch = curl_init($string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); // No Output to Screen
        $result = curl_exec($ch);
        curl_close($ch);

        $antwort = json_decode($result, true);

        if($antwort['success'] === true ){
            if($antwort['read'] === true) {
                $respone = $antwort['response'];
            } elseif($get_link) {
                if($get_full_link == true) {
                    $respone = $link_to_show_pdf.rawurlencode($antwort['response']);
                } else {
                    $respone = rawurlencode($antwort['response']);
                }
            } else {
                if($entwickler){
                    $respone = "Erfolgreich - ".$myVarIWantToEncodeAndDecode." - ".$string;
                } else {
                    $respone = "Erfolgreich";
                }
            }
        } elseif($antwort['success'] === false ) {
            if($antwort['read'] === true) {
                $respone = "Fehler : ".$antwort['response'];
            } else {
                $respone = "Fehler... ";
            }
        } else {
            $respone = "Fehler beim erstellen der PDF: UNBEKANNT (ADMIN benachrichtigen) $string";
        }

        return $respone;

    }


    /**
     * @ORM\PostPersist()
     */
    public function afterPersist(){

        if(!$this->bRnnr) $this->createBRnnr();

    }

    /**
     * @ORM\PrePersist()
     */
    public function onPersist(){

        $this->bCreated = new \DateTime();

    }

    public function storno(){

        $this->bArt = 98;

    }

    public function readyToCheckin(){
        // gibt an ob die Leistung eingecheckt werden kann oder nicht. Soll eventuelle Routinen beinhalten um da zu überprüfen

        $return = false;

        if($this->bArt == 3){

            if($this->bBezahlt == true){

                $return = true;

            } else {

                // muss noch geschrieben werden...

            }

        } elseif($this->bArt = 4) {

            $return = true;

        }

        $this->checkBKategorien();

        return $return;
    }


}
