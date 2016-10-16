<?php

namespace AppBundle\Entity;

use AppBundle\AppBundle;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * ShopKunde
 *
 * @ORM\Table(name="SHOP_Kunde", options={"engine":"InnoDB"} )
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ShopKundeRepository")
 */
class ShopKunde
{
    /**
     * @var integer
     *
     * @ORM\Column(name="k_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $kId;

    /**
     * @var string
     * @Assert\NotBlank(message = "Bitte wählen Sie eine Anrede aus!")
     *
     * @ORM\Column(name="k_anrede", type="string", length=6, nullable=true)
     */
    private $kAnrede;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "Bitte geben Sie einen Nachnamen an!")
     * @ORM\Column(name="k_vorname", type="string", length=32, nullable=true)
     */
    private $kVorname;

    /**
     * @var string
     *
     * @ORM\Column(name="k_nachname", type="string", length=64, nullable=false)
     */
    private $kNachname;

    /**
     * @var string
     *
     * @ORM\Column(name="k_telefonnummer", type="string", length=32, nullable=true)
     */
    private $kTelefonnummer;

    /**
     * @var string
     * @Assert\NotBlank(message = "Eine Emailadresse muss angegeben werden!")
     * @Assert\Email(message = "Die Email '{{ value }}' ist nicht gültig.")
     * @ORM\Column(name="k_email", type="string", length=64, nullable=false)
     */
    private $kEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="k_strasse", type="string", length=64, nullable=true)
     */
    private $kStrasse;

    /**
     * @var string
     *
     * @ORM\Column(name="k_firma", type="string", length=64, nullable=true)
     */
    private $kFirma;

    /**
     * @var string
     *
     * @ORM\Column(name="k_stadt", type="string", length=32, nullable=true)
     */
    private $kStadt;

    /**
     * @var string
     *
     * @ORM\Column(name="k_plz", type="string", length=6, nullable=true)
     */
    private $kPlz;

    /**
     * @var \DateTime
     * @ORM\Column(name="k_adatum", type="datetime", nullable=false)
     */
    private $kAdatum = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="k_edatum", type="datetime", nullable=true)
     */
    private $kEdatum;

    /**
     * @var boolean
     *
     * @ORM\Column(name="k_newsletter", type="boolean")
     */
    private $kNewsletter = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="k_rueckruf", type="integer", nullable=true)
     */
    private $kRueckruf;

    /**
     * @var boolean
     *
     * @ORM\Column(name="k_bewertung_link", type="boolean", nullable=false)
     */
    private $kBewertungLink = false;

    /**
     * @var string
     *
     * @ORM\Column(name="k_channel", type="string", length=8, nullable=true)
     */
    private $kChannel;

    /**
     * @var integer
     *
     * @ORM\Column(name="k_vid", type="integer", nullable=true)
     */
    private $kVid;

    /**
     * @var \AppBundle\Entity\ShopBestellungen
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ShopBestellungen", mappedBy="bKid")
     */
    protected $kBestellungen;

    /**
     * Get kId
     *
     * @return integer
     */
    public function getKId()
    {
        return $this->kId;
    }

    /**
     * Set kAnrede
     *
     * @param string $kAnrede
     *
     * @return ShopKunde
     */
    public function setKAnrede($kAnrede)
    {
        $this->kAnrede = $kAnrede;

        return $this;
    }

    /**
     * Get kAnrede
     *
     * @return string
     */
    public function getKAnrede()
    {
        return $this->kAnrede;
    }

    /**
     * Set kVorname
     *
     * @param string $kVorname
     *
     * @return ShopKunde
     */
    public function setKVorname($kVorname)
    {
        $this->kVorname = $kVorname;

        return $this;
    }

    /**
     * Get kVorname
     *
     * @return string
     */
    public function getKVorname()
    {
        return $this->kVorname;
    }

    /**
     * Set kNachname
     *
     * @param string $kNachname
     *
     * @return ShopKunde
     */
    public function setKNachname($kNachname)
    {
        $this->kNachname = $kNachname;

        return $this;
    }

    /**
     * Get kNachname
     *
     * @return string
     */
    public function getKNachname()
    {
        return $this->kNachname;
    }

    /**
     * Set kTelefonnummer
     *
     * @param string $kTelefonnummer
     *
     * @return ShopKunde
     */
    public function setKTelefonnummer($kTelefonnummer)
    {
        $this->kTelefonnummer = $kTelefonnummer;

        return $this;
    }

    /**
     * Get kTelefonnummer
     *
     * @return string
     */
    public function getKTelefonnummer()
    {
        return $this->kTelefonnummer;
    }

    /**
     * Set kEmail
     *
     * @param string $kEmail
     *
     * @return ShopKunde
     */
    public function setKEmail($kEmail)
    {
        $this->kEmail = $kEmail;

        return $this;
    }

    /**
     * Get kEmail
     *
     * @return string
     */
    public function getKEmail()
    {
        return $this->kEmail;
    }

    /**
     * Set kStrasse
     *
     * @param string $kStrasse
     *
     * @return ShopKunde
     */
    public function setKStrasse($kStrasse)
    {
        $this->kStrasse = $kStrasse;

        return $this;
    }

    /**
     * Get kStrasse
     *
     * @return string
     */
    public function getKStrasse()
    {
        return $this->kStrasse;
    }

    /**
     * Set kFirma
     *
     * @param string $kFirma
     *
     * @return ShopKunde
     */
    public function setKFirma($kFirma)
    {
        $this->kFirma = $kFirma;

        return $this;
    }

    /**
     * Get kFirma
     *
     * @return string
     */
    public function getKFirma()
    {
        return $this->kFirma;
    }

    /**
     * Set kStadt
     *
     * @param string $kStadt
     *
     * @return ShopKunde
     */
    public function setKStadt($kStadt)
    {
        $this->kStadt = $kStadt;

        return $this;
    }

    /**
     * Get kStadt
     *
     * @return string
     */
    public function getKStadt()
    {
        return $this->kStadt;
    }

    /**
     * Set kPlz
     *
     * @param string $kPlz
     *
     * @return ShopKunde
     */
    public function setKPlz($kPlz)
    {
        $this->kPlz = $kPlz;

        return $this;
    }

    /**
     * Get kPlz
     *
     * @return string
     */
    public function getKPlz()
    {
        return $this->kPlz;
    }

    /**
     * Set kAdatum
     *
     * @param \DateTime $kAdatum
     *
     * @return ShopKunde
     */
    public function setKAdatum($kAdatum)
    {
        $this->kAdatum = $kAdatum;

        return $this;
    }

    /**
     * Get kAdatum
     *
     * @return \DateTime
     */
    public function getKAdatum()
    {
        return $this->kAdatum;
    }

    /**
     * Set kEdatum
     *
     * @param \DateTime $kEdatum
     *
     * @return ShopKunde
     */
    public function setKEdatum($kEdatum)
    {
        $this->kEdatum = $kEdatum;

        return $this;
    }

    /**
     * Get kEdatum
     *
     * @return \DateTime
     */
    public function getKEdatum()
    {
        return $this->kEdatum;
    }

    /**
     * Set kNewsletter
     *
     * @param integer $kNewsletter
     *
     * @return ShopKunde
     */
    public function setKNewsletter($kNewsletter)
    {
        $this->kNewsletter = $kNewsletter;

        return $this;
    }

    /**
     * Get kNewsletter
     *
     * @return integer
     */
    public function getKNewsletter()
    {
        return $this->kNewsletter;
    }

    /**
     * Set kRueckruf
     *
     * @param integer $kRueckruf
     *
     * @return ShopKunde
     */
    public function setKRueckruf($kRueckruf)
    {
        $this->kRueckruf = $kRueckruf;

        return $this;
    }

    /**
     * Get kRueckruf
     *
     * @return integer
     */
    public function getKRueckruf()
    {
        return $this->kRueckruf;
    }

    /**
     * Set kBewertungLink
     *
     * @param boolean $kBewertungLink
     *
     * @return ShopKunde
     */
    public function setKBewertungLink($kBewertungLink)
    {
        $this->kBewertungLink = $kBewertungLink;

        return $this;
    }

    /**
     * Get kBewertungLink
     *
     * @return boolean
     */
    public function getKBewertungLink()
    {
        return $this->kBewertungLink;
    }

    /**
     * Set kChannel
     *
     * @param string $kChannel
     *
     * @return ShopKunde
     */
    public function setKChannel($kChannel)
    {
        $this->kChannel = $kChannel;

        return $this;
    }

    /**
     * Get kChannel
     *
     * @return string
     */
    public function getKChannel()
    {
        return $this->kChannel;
    }

    /**
     * Set kVid
     *
     * @param integer $kVid
     *
     * @return ShopKunde
     */
    public function setKVid($kVid)
    {
        $this->kVid = $kVid;

        return $this;
    }

    /**
     * Get kVid
     *
     * @return integer
     */
    public function getKVid()
    {
        return $this->kVid;
    }

    /**
     * @return ShopBestellungen
     */
    public function getKBestellungen()
    {
        return $this->kBestellungen;
    }

    /**
     * @param ShopBestellungen $kBestellungen
     */
    public function setKBestellungen($kBestellungen)
    {
        $this->kBestellungen = $kBestellungen;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist(){
        $this->kAdatum = new \DateTime();
        $this->kEdatum = new \DateTime();
    }

}
