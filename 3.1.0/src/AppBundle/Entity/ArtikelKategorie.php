<?php

namespace AppBundle\Entity;

use AppBundle\AppBundle;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * ArtikelKategorie
 *
 * @ORM\Table(name="ARTIKEL_Kategorie", uniqueConstraints={@ORM\UniqueConstraint(name="Artikelkurz", columns={"a_k_oid", "a_k_name_kurz"})}, indexes={@ORM\Index(name="a_k_art", columns={"a_k_art"}), @ORM\Index(name="a_k_anbieter_id", columns={"a_k_anbieter_id"}), @ORM\Index(name="a_k_zusatz", columns={"a_k_zusatz"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ArtikelKategorieRepository")
 */
class ArtikelKategorie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="a_k_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aKId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="a_k_aktiv", type="boolean", nullable=false)
     */
    private $aKAktiv = '0';

    /**
     * @var ArtikelOrte
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtikelOrte", inversedBy="aOKategorien")
     * @ORM\JoinColumn(name="a_k_oid", referencedColumnName="a_o_id")
     */
    private $aKOid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="a_k_ansicht", type="boolean", nullable=false)
     */
    private $aKAnsicht = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="a_k_druck", type="boolean", nullable=false)
     */
    private $aKDruck = false;

    /**
     * @var string
     *
     * @ORM\Column(name="a_k_anbieter", type="string", length=64, nullable=false)
     */
    private $aKAnbieter;

    /**
     * @var AppBundle/Entity/AgenturVertrieb
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgenturVertrieb", inversedBy="avKategorien")
     * @ORM\JoinColumn(name="a_k_anbieter_id", referencedColumnName="av_id", nullable=true)
     */
    private $aKAnbieterId;

    /**
     * @var integer
     *
     * @ORM\Column(name="a_k_konto", type="integer", nullable=true)
     */
    private $aKKonto;

    /**
     * @var string
     *
     * @ORM\Column(name="a_k_name", type="string", length=64, nullable=false)
     */
    private $aKName;

    /**
     * @var string
     *
     * @ORM\Column(name="a_k_name_en", type="string", length=64, nullable=false)
     */
    private $aKNameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="a_k_name_kurz", type="string", length=12, nullable=false)
     */
    private $aKNameKurz;

    /**
     * @var integer
     *
     * @ORM\Column(name="a_k_sort", type="integer", nullable=false)
     */
    private $aKSort;

    /**
     * @var string
     *
     * @ORM\Column(name="a_k_ueberschrift", type="string", length=64, nullable=false)
     */
    private $aKUeberschrift;

    /**
     * @var string
     *
     * @ORM\Column(name="a_k_ueberschrift_en", type="string", length=64, nullable=false)
     */
    private $aKUeberschriftEn;

    /**
     * @var string
     *
     * @ORM\Column(name="a_k_beschreibung", type="string", length=2048, nullable=false)
     */
    private $aKBeschreibung;

    /**
     * @var string
     *
     * @ORM\Column(name="a_k_beschreibung_en", type="string", length=2048, nullable=true)
     */
    private $aKBeschreibungEn;

    /**
     * @var boolean
     *
     * @ORM\Column(name="a_k_bewerten", type="boolean", nullable=false)
     */
    private $aKBewerten = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="a_k_time", type="integer", length=1, nullable=false)
     */
    private $aKTime = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="a_k_time_min_date", type="integer", length=2,nullable=false)
     */
    private $aKTimeMinDate = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="a_k_dauer", type="time", nullable=false)
     */
    private $aKDauer;

    /**
     * @var boolean
     *
     * @ORM\Column(name="a_k_voucher", type="boolean", nullable=false)
     */
    private $aKVoucher = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="a_k_einbuchen", type="boolean", nullable=false)
     */
    private $aKEinbuchen = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="a_k_vertrieb", type="boolean", nullable=false)
     */
    private $aKVertrieb = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="a_k_position_darst", type="boolean", nullable=false)
     */
    private $aKPositionDarst = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="a_k_abrechnung", type="integer", nullable=true)
     */
    private $aKAbrechnung = '1';

    /**
     * @var \AppBundle\Entity\ShopBausteine
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopBausteine")
     * @ORM\JoinColumn(name="a_k_vtext", referencedColumnName="h_id", nullable=true)
     */
    private $aKVtext;

    /**
     * @var \AppBundle\Entity\ShopBausteine
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopBausteine")
     * @ORM\JoinColumn(name="a_k_rtext", referencedColumnName="h_id", nullable=true)
     */
    private $aKRtext;

    /**
     * @var integer
     *
     * @ORM\Column(name="a_k_mwst", type="integer", nullable=false)
     */
    private $aKMwst = '19';

    /**
     * @var \AppBundle\Entity\ArtikelKategorieArt
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtikelKategorieArt")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="a_k_art", referencedColumnName="a_a_id")
     * })
     */
    private $aKArt;

    /**
     * @var \AppBundle\Entity\KategorieZusatz
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\KategorieZusatz")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="a_k_zusatz", referencedColumnName="akz_id", nullable=true)
     * })
     */
    private $aKZusatz;


    /**
     * @var \AppBundle\Entity\Artikel
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Artikel", mappedBy="aKid")
     */
    private $aKArtikel;

    /**
     * @var \AppBundle\Entity\ArtikelKategorieLeistungen
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ArtikelKategorieLeistungen", mappedBy="aklK")
     */
    private $aKPoints;

    /**
     * @var \AppBundle\Entity\ArtikelAbZeiten
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ArtikelAbZeiten", mappedBy="aAbKid")
     * @ORM\OrderBy({"aAbDatum": "DESC"})
     */
    private $aKZeiten;

    /**
     * @var \AppBundle\Entity\ArtikelKategorieZeitenTabelle
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ArtikelKategorieZeitenTabelle", mappedBy="aztK")
     */
    private $aKZeitenTabelle;

    public $zeiten = array();

    public $checkin = false; // Gibt an ob die Leistung eingescannt werden kann
    public $checkin_positionen; // Gibt die Positionen an die Eingescannt werden müssten
    public $checkin_datum = null; // Gibt das Datum des Checkins an.
    public $checkin_message = ""; // Gibt die Fehlermeldung zu obrigen an
    public $scan = null; // Gibt das ShopScan Objekt wieder welches die Leistung bereits eingescant hat

    /**
     * Get aKId
     *
     * @return integer
     */
    public function getAKId()
    {
        return $this->aKId;
    }

    /**
     * Set aKAktiv
     *
     * @param boolean $aKAktiv
     *
     * @return ArtikelKategorie
     */
    public function setAKAktiv($aKAktiv)
    {
        $this->aKAktiv = $aKAktiv;

        return $this;
    }

    /**
     * Get aKAktiv
     *
     * @return boolean
     */
    public function getAKAktiv()
    {
        return $this->aKAktiv;
    }

    public function getAKAktivLabel()
    {
        switch($this->aKAktiv){
            case 1:
                $label = "aktiv";
                break;
            case 0:
                $label = "INAKTIV";
                break;
            default:
                $label = "uNdeFinIert";
                break;
        }

        return $label;

    }

    /**
     * @return ArtikelOrte
     */
    public function getAKOid()
    {
        return $this->aKOid;
    }

    /**
     * @param ArtikelOrte $aKOid
     */
    public function setAKOid($aKOid)
    {
        $this->aKOid = $aKOid;
    }
    
    /**
     * Set aKAnsicht
     *
     * @param boolean $aKAnsicht
     *
     * @return ArtikelKategorie
     */
    public function setAKAnsicht($aKAnsicht)
    {
        $this->aKAnsicht = $aKAnsicht;

        return $this;
    }

    /**
     * Get aKAnsicht
     *
     * @return boolean
     */
    public function getAKAnsicht()
    {
        return $this->aKAnsicht;
    }

    /**
     * Set aKDruck
     *
     * @param integer $aKDruck
     *
     * @return ArtikelKategorie
     */
    public function setAKDruck($aKDruck)
    {
        $this->aKDruck = $aKDruck;

        return $this;
    }

    /**
     * Get aKDruck
     *
     * @return integer
     */
    public function getAKDruck()
    {
        return $this->aKDruck;
    }

    /**
     * Set aKAnbieter
     *
     * @param string $aKAnbieter
     *
     * @return ArtikelKategorie
     */
    public function setAKAnbieter($aKAnbieter)
    {
        $this->aKAnbieter = $aKAnbieter;

        return $this;
    }

    /**
     * Get aKAnbieter
     *
     * @return string
     */
    public function getAKAnbieter()
    {
        return $this->aKAnbieter;
    }

    /**
     * Set aKAnbieterId
     *
     * @param integer $aKAnbieterId
     *
     * @return ArtikelKategorie
     */
    public function setAKAnbieterId($aKAnbieterId)
    {
        $this->aKAnbieterId = $aKAnbieterId;

        return $this;
    }

    /**
     * Get aKAnbieterId
     *
     * @return integer
     */
    public function getAKAnbieterId()
    {
        return $this->aKAnbieterId;
    }

    /**
     * Set aKKonto
     *
     * @param integer $aKKonto
     *
     * @return ArtikelKategorie
     */
    public function setAKKonto($aKKonto)
    {
        $this->aKKonto = $aKKonto;

        return $this;
    }

    /**
     * Get aKKonto
     *
     * @return integer
     */
    public function getAKKonto()
    {
        return $this->aKKonto;
    }

    /**
     * Set aKName
     *
     * @param string $aKName
     *
     * @return ArtikelKategorie
     */
    public function setAKName($aKName)
    {
        $this->aKName = $aKName;

        return $this;
    }

    /**
     * Get aKName
     *
     * @return string
     */
    public function getAKName()
    {
        return $this->aKName;
    }

    /**
     * Set aKNameEn
     *
     * @param string $aKNameEn
     *
     * @return ArtikelKategorie
     */
    public function setAKNameEn($aKNameEn)
    {
        $this->aKNameEn = $aKNameEn;

        return $this;
    }

    /**
     * Get aKNameEn
     *
     * @return string
     */
    public function getAKNameEn()
    {
        return $this->aKNameEn;
    }

    /**
     * Set aKNameKurz
     *
     * @param string $aKNameKurz
     *
     * @return ArtikelKategorie
     */
    public function setAKNameKurz($aKNameKurz)
    {
        $this->aKNameKurz = $aKNameKurz;

        return $this;
    }

    /**
     * Get aKNameKurz
     *
     * @return string
     */
    public function getAKNameKurz()
    {
        return $this->aKNameKurz;
    }

    /**
     * Set aKSort
     *
     * @param integer $aKSort
     *
     * @return ArtikelKategorie
     */
    public function setAKSort($aKSort)
    {
        $this->aKSort = $aKSort;

        return $this;
    }

    /**
     * Get aKSort
     *
     * @return integer
     */
    public function getAKSort()
    {
        return $this->aKSort;
    }

    /**
     * Set aKUeberschrift
     *
     * @param string $aKUeberschrift
     *
     * @return ArtikelKategorie
     */
    public function setAKUeberschrift($aKUeberschrift)
    {
        $this->aKUeberschrift = $aKUeberschrift;

        return $this;
    }

    /**
     * Get aKUeberschrift
     *
     * @return string
     */
    public function getAKUeberschrift()
    {
        return $this->aKUeberschrift;
    }

    /**
     * Set aKUeberschriftEn
     *
     * @param string $aKUeberschriftEn
     *
     * @return ArtikelKategorie
     */
    public function setAKUeberschriftEn($aKUeberschriftEn)
    {
        $this->aKUeberschriftEn = $aKUeberschriftEn;

        return $this;
    }

    /**
     * Get aKUeberschriftEn
     *
     * @return string
     */
    public function getAKUeberschriftEn()
    {
        return $this->aKUeberschriftEn;
    }

    /**
     * Set aKBeschreibung
     *
     * @param string $aKBeschreibung
     *
     * @return ArtikelKategorie
     */
    public function setAKBeschreibung($aKBeschreibung)
    {
        $this->aKBeschreibung = $aKBeschreibung;

        return $this;
    }

    /**
     * Get aKBeschreibung
     *
     * @return string
     */
    public function getAKBeschreibung()
    {
        return $this->aKBeschreibung;
    }

    /**
     * Set aKBeschreibungEn
     *
     * @param string $aKBeschreibungEn
     *
     * @return ArtikelKategorie
     */
    public function setAKBeschreibungEn($aKBeschreibungEn)
    {
        $this->aKBeschreibungEn = $aKBeschreibungEn;

        return $this;
    }

    /**
     * Get aKBeschreibungEn
     *
     * @return string
     */
    public function getAKBeschreibungEn()
    {
        return $this->aKBeschreibungEn;
    }

    /**
     * Set aKBewerten
     *
     * @param boolean $aKBewerten
     *
     * @return ArtikelKategorie
     */
    public function setAKBewerten($aKBewerten)
    {
        $this->aKBewerten = $aKBewerten;

        return $this;
    }

    /**
     * Get aKBewerten
     *
     * @return boolean
     */
    public function getAKBewerten()
    {
        return $this->aKBewerten;
    }

    /**
     * Set aKTime
     *
     * @param boolean $aKTime
     *
     * @return ArtikelKategorie
     */
    public function setAKTime($aKTime)
    {
        $this->aKTime = $aKTime;

        return $this;
    }

    /**
     * Get aKTime
     *
     * @return boolean
     */
    public function getAKTime()
    {
        return $this->aKTime;
    }

    /**
     * Set aKTimeMinDate
     *
     * @param boolean $aKTimeMinDate
     *
     * @return ArtikelKategorie
     */
    public function setAKTimeMinDate($aKTimeMinDate)
    {
        $this->aKTimeMinDate = $aKTimeMinDate;

        return $this;
    }

    /**
     * Get aKTimeMinDate
     *
     * @return integer
     */
    public function getAKTimeMinDate()
    {
        return $this->aKTimeMinDate;
    }

    /**
     * Set aKDauer
     *
     * @param \DateTime $aKDauer
     *
     * @return ArtikelKategorie
     */
    public function setAKDauer($aKDauer)
    {
        $this->aKDauer = $aKDauer;

        return $this;
    }

    /**
     * Get aKDauer
     *
     * @return \DateTime
     */
    public function getAKDauer()
    {
        return $this->aKDauer;
    }

    /**
     * Set aKVoucher
     *
     * @param boolean $aKVoucher
     *
     * @return ArtikelKategorie
     */
    public function setAKVoucher($aKVoucher)
    {
        $this->aKVoucher = $aKVoucher;

        return $this;
    }

    /**
     * Get aKVoucher
     *
     * @return boolean
     */
    public function getAKVoucher()
    {
        return $this->aKVoucher;
    }

    /**
     * Set aKEinbuchen
     *
     * @param boolean $aKEinbuchen
     *
     * @return ArtikelKategorie
     */
    public function setAKEinbuchen($aKEinbuchen)
    {
        $this->aKEinbuchen = $aKEinbuchen;

        return $this;
    }

    /**
     * Get aKEinbuchen
     *
     * @return boolean
     */
    public function getAKEinbuchen()
    {
        return $this->aKEinbuchen;
    }

    /**
     * Set aKVertrieb
     *
     * @param boolean $aKVertrieb
     *
     * @return ArtikelKategorie
     */
    public function setAKVertrieb($aKVertrieb)
    {
        $this->aKVertrieb = $aKVertrieb;

        return $this;
    }

    /**
     * Get aKVertrieb
     *
     * @return boolean
     */
    public function getAKVertrieb()
    {
        return $this->aKVertrieb;
    }

    /**
     * Set aKPositionDarst
     *
     * @param boolean $aKPositionDarst
     *
     * @return ArtikelKategorie
     */
    public function setAKPositionDarst($aKPositionDarst)
    {
        $this->aKPositionDarst = $aKPositionDarst;

        return $this;
    }

    /**
     * Get aKPositionDarst
     *
     * @return boolean
     */
    public function getAKPositionDarst()
    {
        return $this->aKPositionDarst;
    }

    /**
     * Set aKAbrechnung
     *
     * @param integer $aKAbrechnung
     *
     * @return ArtikelKategorie
     */
    public function setAKAbrechnung($aKAbrechnung)
    {
        $this->aKAbrechnung = $aKAbrechnung;

        return $this;
    }

    /**
     * Get aKAbrechnung
     *
     * @return integer
     */
    public function getAKAbrechnung()
    {
        return $this->aKAbrechnung;
    }

    /**
     * Set aKVtext
     *
     * @param integer $aKVtext
     *
     * @return ArtikelKategorie
     */
    public function setAKVtext($aKVtext)
    {
        $this->aKVtext = $aKVtext;

        return $this;
    }

    /**
     * Get aKVtext
     *
     * @return integer
     */
    public function getAKVtext()
    {
        return $this->aKVtext;
    }

    /**
     * Set aKRtext
     *
     * @param integer $aKRtext
     *
     * @return ArtikelKategorie
     */
    public function setAKRtext($aKRtext)
    {
        $this->aKRtext = $aKRtext;

        return $this;
    }

    /**
     * Get aKRtext
     *
     * @return integer
     */
    public function getAKRtext()
    {
        return $this->aKRtext;
    }

    /**
     * Set aKMwst
     *
     * @param integer $aKMwst
     *
     * @return ArtikelKategorie
     */
    public function setAKMwst($aKMwst)
    {
        $this->aKMwst = $aKMwst;

        return $this;
    }

    /**
     * Get aKMwst
     *
     * @return integer
     */
    public function getAKMwst()
    {
        return $this->aKMwst;
    }

    /**
     * Set aKArt
     *
     * @param \AppBundle\Entity\ArtikelKategorieArt $aKArt
     *
     * @return ArtikelKategorie
     */
    public function setAKArt(\AppBundle\Entity\ArtikelKategorieArt $aKArt = null)
    {
        $this->aKArt = $aKArt;

        return $this;
    }

    /**
     * Get aKArt
     *
     * @return \AppBundle\Entity\ArtikelKategorieArt
     */
    public function getAKArt()
    {
        return $this->aKArt;
    }

    /**
     * Set aKZusatz
     *
     * @param \AppBundle\Entity\KategorieZusatz $aKZusatz
     *
     * @return ArtikelKategorie
     */
    public function setAKZusatz(\AppBundle\Entity\KategorieZusatz $aKZusatz = null)
    {
        $this->aKZusatz = $aKZusatz;

        return $this;
    }

    /**
     * Get aKZusatz
     *
     * @return \AppBundle\Entity\KategorieZusatz
     */
    public function getAKZusatz()
    {
        return $this->aKZusatz;
    }

    /**
     * @return Artikel
     */
    public function getAKArtikel()
    {
        return $this->aKArtikel;
    }

    /**
     * @param Artikel $aKArtikel
     */
    public function setAKArtikel($aKArtikel)
    {
        $this->aKArtikel = $aKArtikel;
    }

    /**
     * @return ArtikelKategorieLeistungen
     */
    public function getAKPoints()
    {
        return $this->aKPoints;
    }

    /**
     * @param ArtikelKategorieLeistungen $aKPoints
     */
    public function setAKPoints($aKPoints)
    {
        $this->aKPoints = $aKPoints;
    }

    /**
     * @return ArtikelKategorieZeitenTabelle
     */
    public function getAKZeitenTabelle()
    {
        return $this->aKZeitenTabelle;
    }

    /**
     * @param ArtikelKategorieZeitenTabelle $aKZeitenTabelle
     */
    public function setAKZeitenTabelle($aKZeitenTabelle)
    {
        $this->aKZeitenTabelle = $aKZeitenTabelle;
    }

    /**
     * @return ArtikelAbZeiten
     */
    public function getAKZeiten()
    {
        return $this->aKZeiten;
    }

    /**
     * @param ArtikelAbZeiten $aKZeiten
     */
    public function setAKZeiten($aKZeiten)
    {
        $this->aKZeiten = $aKZeiten;
    }

    public function isDateRequired(){

        $return = false;

        if($this->aKTime == 9) {

            $return = true;

        }

        return $return;
    }

    public function isDateBookable(\DateTime $date){

        // if( !$this->isDateRequired() ) return true;
        $zeit = array();

        foreach ($this->getAKZeitenTabelle() as $tabelle) {

            if($tabelle->getAztVon()->format('ymd') <= $date->format('ymd') && $date->format('ymd') <= $tabelle->getAztBis()->format('ymd')) {

                foreach($tabelle->getAztZeiten() as $AztZeiten){
                    if($AztZeiten->getAzDay() == $date->format('w') && $AztZeiten->getAzTyp() == 1){

                        $array = array();
                        $array['zeit']      = $AztZeiten->getAzTime()->format('H:i');
                        $array['zusatz']    = $AztZeiten->getAzZusatz();

                        $zeit["'".$AztZeiten->getAzTime()->format('H:i')."'"]   =   $array;

                    }
                }
            }
        }

        foreach ($this->getAKZeiten() as $zeiten) {
            if($zeiten->getAAbTyp() == 2) {
                if ($zeiten->getAAbDatum()->format('Ymd') == $date->format('Ymd')) {

                    if ($zeiten->getAAbDatum()->format('His') == "000000") {

                        unset($zeit[$date->format('H:i')]);

                        return false;

                    } else {
                        if(array_key_exists($zeit, $date->format('H:i'))){
                            unset($zeit[$date->format('H:i')]);
                        }
                    }

                }
            } elseif($zeiten->getAAbTyp() == 1){

                if ($zeiten->getAAbDatum()->format('His') != "000000") {
                    if(!array_key_exists($zeit, $date->format('H:i'))){
                        $zeit["'".$date->format('H:i')."'"] = array('zeit' => $date->format('H:i'), 'zusatz' => '');
                    }
                }
            }
        }


        if (sizeof($zeit)) {

            $return = array();
            foreach($zeit as $z){
                $return[] = array('time' => $z['zeit'], 'status' => 1);
            }
            $this->zeiten = $return;

            return true;

        } else {

            return false;

        }
    }

    public function isTimeForDateRequired(){

        if( sizeof($this->zeiten) ) {
            $return = $this->zeiten;
        } else {
            $return = false;
        }

        return $return;
    }

    public function getDatepickerArray($export_type = null){

        $data = array();
        $vorlagen = array();
        $tage = array();
        $fdate = date('Y-m-d', strtotime("NOW + ".$this->getAKTimeMinDate()." day"));

        $nurtage = $this->getAKZeitenTabelle()->filter(function ($t){ if($t->getAztTyp() == 2) { return true;} });
        foreach($nurtage as $tabelle){


            $fruehestens = $fdate;

            $start	= $fruehestens > $tabelle->getAztVon()->format('Y-m-d') ? $fruehestens : $tabelle->getAztVon()->format('Y-m-d');
            $ende	= $tabelle->getAztBis()->format('Y-m-d');
            $index 	= $start;

            while($start <= $ende){

                $tage[$start] = $start;

                $start = date('Y-m-d', strtotime($start." +1 day"));
            }
        }

        $woche = $this->getAKZeitenTabelle()->filter(function ($t){ if($t->getAztTyp() != 2) { return $t;} });
        foreach($woche as $tabelle) {


            $fruehestens = $fdate;

            $start	= $fruehestens > $tabelle->getAztVon()->format('Y-m-d') ? $fruehestens : $tabelle->getAztVon()->format('Y-m-d');
            $ende	= $tabelle->getAztBis()->format('Y-m-d');
            $index 	= $start;

            while($start <= $ende){
                $wday = date('w', strtotime($start));

                $wtag = $tabelle->getAztZeiten()->filter(function ($z) use ($wday){ if($z->getAzDay() == $wday){ return true;}});

                foreach($wtag as $tag){
                    $tage[$start]['zeiten'][] = $tag->getAzTime()->format('H:i');
                }

                $start = date('Y-m-d', strtotime($start." +1 day"));
            }
        }

        // Termine die inkludiert werden
        $zeiten = $this->getAKZeiten()->filter(function ($zeit) { if($zeit->getAAbTyp() == 1) { return true; }});

        foreach($zeiten as $zeit){
            dump($zeiten);
            foreach($zeiten['zeiten'] as $zeit){

                if(array_key_exists($zeit->getAAbDatum()->format('Y-m-d'), $tage) && !in_array($zeit, $tage[$tag]['zeiten'], true)) {

                    $array = array();
                    $array[] = "";

                    $tage[$zeit->getAAbDatum()->format('Y-m-d')]['zeiten'][] = $array;
                }
            }
        }

        // Tage die exkludiert werden sollen
        $zeiten = $this->getAKZeiten()->filter(function ($zeit) { if($zeit->getAAbTyp() == 2) { return true; }});

        foreach($zeiten as $zeit){

            if(array_key_exists($zeit->getAAbDatum()->format('Y-m-d'), $tage) && !in_array($zeit, $tage[$zeit->getAAbDatum()->format('Y-m-d')]['zeiten'], true)) {

                unset($tage[$zeit->getAAbDatum()->format('Y-m-d')]);

            }
        }

        /*
        */

        $return = array();
        foreach($tage as $tag => $uhrzeiten){
            if($uhrzeiten && $tag >= $fdate){
                $return[] = $tag;
            }
        }

        if(sizeof($return)){
            array_multisort($return);
        }

        if($export_type == "JSON"){

            return json_encode($return);

        } else {

            return $return;

        }

    }



}
