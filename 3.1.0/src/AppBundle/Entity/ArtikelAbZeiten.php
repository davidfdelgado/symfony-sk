<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtikelAbZeiten
 *
 * @ORM\Table(name="ARTIKEL_AB_Zeiten", indexes={@ORM\Index(name="a_ab_ak_id", columns={"a_ab_kid"}), @ORM\Index(name="a_ab_kid", columns={"a_ab_kid"})})
 * @ORM\Entity
 */
class ArtikelAbZeiten
{
    /**
     * @var integer
     *
     * @ORM\Column(name="a_ab_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aAbId;

    /**
     * @var integer
     *
     * @ORM\Column(name="a_ab_typ", type="integer", length=1, nullable=true)
     */
    private $aAbTyp = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="a_ab_datum", type="datetime", nullable=false)
     */
    private $aAbDatum;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="a_ab_interval", type="time", nullable=false)
     */
    private $aAbInterval = '00:00:15';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="a_ab_int_start", type="time", nullable=false)
     */
    private $aAbIntStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="a_ab_int_ende", type="time", nullable=false)
     */
    private $aAbIntEnde;

    /**
     * @var string
     *
     * @ORM\Column(name="a_ab_info", type="string", length=64, nullable=true)
     */
    private $aAbInfo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="a_ab_status", type="boolean", nullable=false)
     */
    private $aAbStatus = false;

    /**
     * @var \AppBundle\Entity\ArtikelKategorie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtikelKategorie", inversedBy="aKZeiten")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="a_ab_kid", referencedColumnName="a_k_id")
     * })
     */
    private $aAbKid;

    public function __construct()
    {
        $this->aAbInterval = "00:00:00";
    }


    /**
     * Get aAbId
     *
     * @return integer
     */
    public function getAAbId()
    {
        return $this->aAbId;
    }

    /**
     * Set aAbTyp
     *
     * @param boolean $aAbTyp
     *
     * @return ArtikelAbZeiten
     */
    public function setAAbTyp($aAbTyp)
    {
        $this->aAbTyp = $aAbTyp;

        return $this;
    }

    /**
     * Get aAbTyp
     *
     * @return boolean
     */
    public function getAAbTyp()
    {
        return $this->aAbTyp;
    }

    /**
     * Set aAbDatum
     *
     * @param \DateTime $aAbDatum
     *
     * @return ArtikelAbZeiten
     */
    public function setAAbDatum($aAbDatum)
    {
        $this->aAbDatum = $aAbDatum;

        return $this;
    }

    /**
     * Get aAbDatum
     *
     * @return \DateTime
     */
    public function getAAbDatum()
    {
        return $this->aAbDatum;
    }

    /**
     * Set aAbInterval
     *
     * @param \DateTime $aAbInterval
     *
     * @return ArtikelAbZeiten
     */
    public function setAAbInterval($aAbInterval)
    {
        $this->aAbInterval = $aAbInterval;

        return $this;
    }

    /**
     * Get aAbInterval
     *
     * @return \DateTime
     */
    public function getAAbInterval()
    {
        return $this->aAbInterval;
    }

    /**
     * Set aAbIntStart
     *
     * @param \DateTime $aAbIntStart
     *
     * @return ArtikelAbZeiten
     */
    public function setAAbIntStart($aAbIntStart)
    {
        $this->aAbIntStart = $aAbIntStart;

        return $this;
    }

    /**
     * Get aAbIntStart
     *
     * @return \DateTime
     */
    public function getAAbIntStart()
    {
        return $this->aAbIntStart;
    }

    /**
     * Set aAbIntEnde
     *
     * @param \DateTime $aAbIntEnde
     *
     * @return ArtikelAbZeiten
     */
    public function setAAbIntEnde($aAbIntEnde)
    {
        $this->aAbIntEnde = $aAbIntEnde;

        return $this;
    }

    /**
     * Get aAbIntEnde
     *
     * @return \DateTime
     */
    public function getAAbIntEnde()
    {
        return $this->aAbIntEnde;
    }

    /**
     * Set aAbInfo
     *
     * @param string $aAbInfo
     *
     * @return ArtikelAbZeiten
     */
    public function setAAbInfo($aAbInfo)
    {
        $this->aAbInfo = $aAbInfo;

        return $this;
    }

    /**
     * Get aAbInfo
     *
     * @return string
     */
    public function getAAbInfo()
    {
        return $this->aAbInfo;
    }

    /**
     * Set aAbStatus
     *
     * @param boolean $aAbStatus
     *
     * @return ArtikelAbZeiten
     */
    public function setAAbStatus($aAbStatus)
    {
        $this->aAbStatus = $aAbStatus;

        return $this;
    }

    /**
     * Get aAbStatus
     *
     * @return boolean
     */
    public function getAAbStatus()
    {
        return $this->aAbStatus;
    }

    /**
     * Set aAbKid
     *
     * @param \AppBundle\Entity\ArtikelKategorie $aAbKid
     *
     * @return ArtikelAbZeiten
     */
    public function setAAbKid(\AppBundle\Entity\ArtikelKategorie $aAbKid = null)
    {
        $this->aAbKid = $aAbKid;

        return $this;
    }

    /**
     * Get aAbKid
     *
     * @return \AppBundle\Entity\ArtikelKategorie
     */
    public function getAAbKid()
    {
        return $this->aAbKid;
    }
}
