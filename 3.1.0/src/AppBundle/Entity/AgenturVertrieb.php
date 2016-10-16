<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AgenturVertrieb
 *
 * @ORM\Table(name="AGENTUR_Vertrieb", options={"engine":"InnoDB"} )
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AgenturVertriebRepository")
 */
class AgenturVertrieb
{
    /**
     * @var integer
     *
     * @ORM\Column(name="av_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $avId;

    /**
     * @var integer
     *
     * @ORM\Column(name="av_art", type="integer", length=1, nullable=true)
     */
    private $avArt = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="av_status", type="boolean", nullable=false)
     */
    private $avStatus = false;

    /**
     * @var ShopKunde
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopKunde")
     * @ORM\JoinColumn(name="av_kid", referencedColumnName="k_id" , nullable=true)
     */
    private $avKid;

    /**
     * @var string
     * @Assert\NotBlank(message="Bitte geben Sie einen Agentur-/Hotelnamen ein.")
     * @ORM\Column(name="av_hotelname", type="string", length=64, nullable=false)
     */
    private $avHotelname;

    /**
     * @var string
     * @Assert\NotBlank(message="Bitte geben Sie den Ansprechpartner an.")
     * @ORM\Column(name="av_ansprechpartner", type="string", length=32, nullable=false)
     */
    private $avAnsprechpartner;

    /**
     * @var string
     *
     * @ORM\Column(name="av_email", type="string", length=64, nullable=false)
     */
    private $avEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="av_zahlungsziel", type="integer", length=2, nullable=false)
     */
    private $avZahlungsziel = '14';

    /**
     * @var boolean
     *
     * @ORM\Column(name="av_checkin_email", type="boolean", nullable=false)
     */
    private $avCheckinEmail = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="av_bu_email", type="boolean", nullable=false)
     */
    private $avBuEmail = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="av_afl_status", type="boolean", nullable=false)
     */
    private $avAflStatus = false;

    /**
     * @var string
     *
     * @ORM\Column(name="av_afl_id", type="string", length=10, nullable=true)
     */
    private $avAflId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="av_created", type="datetime", nullable=false)
     */
    private $avCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     *
     * @ORM\Column(name="av_stempel", type="boolean", nullable=false)
     */
    private $avStempel = false;

    /**
     * @var ShopBestellungen
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ShopBestellungen", mappedBy="bVid")
     */
    private $avRechnungen;
    
    private $avVorgaenge;

    /**
     * @var AgenturUser
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AgenturUser", mappedBy="auVid")
     * @ORM\OrderBy({"auStatus" = "DESC", "auArt" = "DESC"})
     */
    protected $avUsers;

    /**
     * @var ArtikelKategorie
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ArtikelKategorie", mappedBy="aKAnbieterId")
     */
    protected $avKategorien;

    public function __construct()
    {
        $this->avVorgaenge = new ArrayCollection();
    }

    /**
     * Get avId
     *
     * @return integer
     */
    public function getAvId()
    {
        return $this->avId;
    }

    /**
     * @return int
     */
    public function getAvArt()
    {
        return $this->avArt;
    }

    /**
     * @param int $avArt
     */
    public function setAvArt($avArt)
    {
        $this->avArt = $avArt;
    }

    /**
     * Set avStatus
     *
     * @param boolean $avStatus
     *
     * @return AgenturVertrieb
     */
    public function setAvStatus($avStatus)
    {
        $this->avStatus = $avStatus;

        return $this;
    }

    /**
     * Get avStatus
     *
     * @return boolean
     */
    public function getAvStatus()
    {
        return $this->avStatus;
    }

    /**
     * @return ShopKunde
     */
    public function getAvKid()
    {
        return $this->avKid;
    }

    /**
     * @param ShopKunde $avKid
     */
    public function setAvKid($avKid)
    {
        $this->avKid = $avKid;
    }

    /**
     * Set avHotelname
     *
     * @param string $avHotelname
     *
     * @return AgenturVertrieb
     */
    public function setAvHotelname($avHotelname)
    {
        $this->avHotelname = $avHotelname;

        return $this;
    }

    /**
     * Get avHotelname
     *
     * @return string
     */
    public function getAvHotelname()
    {
        return $this->avHotelname;
    }

    /**
     * Set avAnsprechpartner
     *
     * @param string $avAnsprechpartner
     *
     * @return AgenturVertrieb
     */
    public function setAvAnsprechpartner($avAnsprechpartner)
    {
        $this->avAnsprechpartner = $avAnsprechpartner;

        return $this;
    }

    /**
     * Get avAnsprechpartner
     *
     * @return string
     */
    public function getAvAnsprechpartner()
    {
        return $this->avAnsprechpartner;
    }

    /**
     * Set avEmail
     *
     * @param string $avEmail
     *
     * @return AgenturVertrieb
     */
    public function setAvEmail($avEmail)
    {
        $this->avEmail = $avEmail;

        return $this;
    }

    /**
     * Get avEmail
     *
     * @return string
     */
    public function getAvEmail()
    {
        return $this->avEmail;
    }

    /**
     * @return int
     */
    public function getAvZahlungsziel()
    {
        return $this->avZahlungsziel;
    }

    /**
     * @param int $avZahlungsziel
     */
    public function setAvZahlungsziel($avZahlungsziel)
    {
        $this->avZahlungsziel = $avZahlungsziel;
    }

    /**
     * Set avCheckinEmail
     *
     * @param boolean $avCheckinEmail
     *
     * @return AgenturVertrieb
     */
    public function setAvCheckinEmail($avCheckinEmail)
    {
        $this->avCheckinEmail = $avCheckinEmail;

        return $this;
    }

    /**
     * Get avCheckinEmail
     *
     * @return boolean
     */
    public function getAvCheckinEmail()
    {
        return $this->avCheckinEmail;
    }

    /**
     * Set avBuEmail
     *
     * @param boolean $avBuEmail
     *
     * @return AgenturVertrieb
     */
    public function setAvBuEmail($avBuEmail)
    {
        $this->avBuEmail = $avBuEmail;

        return $this;
    }

    /**
     * Get avBuEmail
     *
     * @return boolean
     */
    public function getAvBuEmail()
    {
        return $this->avBuEmail;
    }

    /**
     * Set avAflStatus
     *
     * @param boolean $avAflStatus
     *
     * @return AgenturVertrieb
     */
    public function setAvAflStatus($avAflStatus)
    {
        $this->avAflStatus = $avAflStatus;

        return $this;
    }

    /**
     * Get avAflStatus
     *
     * @return boolean
     */
    public function getAvAflStatus()
    {
        return $this->avAflStatus;
    }

    /**
     * Set avAflId
     *
     * @param string $avAflId
     *
     * @return AgenturVertrieb
     */
    public function setAvAflId($avAflId)
    {
        $this->avAflId = $avAflId;

        return $this;
    }

    /**
     * Get avAflId
     *
     * @return string
     */
    public function getAvAflId()
    {
        return $this->avAflId;
    }

    /**
     * Set avCreated
     *
     * @param \DateTime $avCreated
     *
     * @return AgenturVertrieb
     */
    public function setAvCreated($avCreated)
    {
        $this->avCreated = $avCreated;

        return $this;
    }

    /**
     * Get avCreated
     *
     * @return \DateTime
     */
    public function getAvCreated()
    {
        return $this->avCreated;
    }

    /**
     * Set avStempel
     *
     * @param boolean $avStempel
     *
     * @return AgenturVertrieb
     */
    public function setAvStempel($avStempel)
    {
        $this->avStempel = $avStempel;

        return $this;
    }

    /**
     * Get avStempel
     *
     * @return boolean
     */
    public function getAvStempel()
    {
        return $this->avStempel;
    }

    /**
     * @return mixed
     */
    public function getAvRechnungen()
    {
        return $this->avRechnungen;
    }

    /**
     * @param mixed $avRechnungen
     */
    public function setAvRechnungen($avRechnungen)
    {
        $this->avRechnungen = $avRechnungen;
    }

    /**
     * @return mixed
     */
    public function getAvVorgaenge()
    {
        return $this->avVorgaenge;
    }

    /**
     * @param mixed $avVorgaenge
     */
    public function setAvVorgaenge($avVorgaenge)
    {
        $this->avVorgaenge = $avVorgaenge;
    }


    /**
     * @return mixed
     */
    public function getAvUsers()
    {
        return $this->avUsers;
    }

    /**
     * @param mixed $avUsers
     */
    public function setAvUsers($avUsers)
    {
        $this->avUsers = $avUsers;
    }

    /**
     * @return ArtikelKategorie
     */
    public function getAvKategorien()
    {
        return $this->avKategorien;
    }

    /**
     * @param ArtikelKategorie $avKategorien
     */
    public function setAvKategorien($avKategorien)
    {
        $this->avKategorien = $avKategorien;
    }

}
