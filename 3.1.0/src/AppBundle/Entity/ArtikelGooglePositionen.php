<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtikelGooglePositionen
 *
 * @ORM\Table(name="ARTIKEL_Google_Positionen", uniqueConstraints={@ORM\UniqueConstraint(name="gm_id", columns={"gm_id"})}, indexes={@ORM\Index(name="gm_k_id", columns={"gm_k_id"})})
 * @ORM\Entity
 */
class ArtikelGooglePositionen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="gm_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $gmId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gm_type", type="boolean", nullable=false)
     */
    private $gmType;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gm_status", type="boolean", nullable=false)
     */
    private $gmStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="gm_beschreibung", type="string", length=64, nullable=false)
     */
    private $gmBeschreibung;

    /**
     * @var string
     *
     * @ORM\Column(name="gm_longitude", type="decimal", precision=18, scale=12, nullable=false)
     */
    private $gmLongitude;

    /**
     * @var string
     *
     * @ORM\Column(name="gm_latitude", type="decimal", precision=18, scale=12, nullable=false)
     */
    private $gmLatitude;

    /**
     * @var \AppBundle\Entity\ArtikelKategorie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtikelKategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gm_k_id", referencedColumnName="a_k_id")
     * })
     */
    private $gmK;



    /**
     * Get gmId
     *
     * @return integer
     */
    public function getGmId()
    {
        return $this->gmId;
    }

    /**
     * Set gmType
     *
     * @param boolean $gmType
     *
     * @return ArtikelGooglePositionen
     */
    public function setGmType($gmType)
    {
        $this->gmType = $gmType;

        return $this;
    }

    /**
     * Get gmType
     *
     * @return boolean
     */
    public function getGmType()
    {
        return $this->gmType;
    }

    /**
     * Set gmStatus
     *
     * @param boolean $gmStatus
     *
     * @return ArtikelGooglePositionen
     */
    public function setGmStatus($gmStatus)
    {
        $this->gmStatus = $gmStatus;

        return $this;
    }

    /**
     * Get gmStatus
     *
     * @return boolean
     */
    public function getGmStatus()
    {
        return $this->gmStatus;
    }

    /**
     * Set gmBeschreibung
     *
     * @param string $gmBeschreibung
     *
     * @return ArtikelGooglePositionen
     */
    public function setGmBeschreibung($gmBeschreibung)
    {
        $this->gmBeschreibung = $gmBeschreibung;

        return $this;
    }

    /**
     * Get gmBeschreibung
     *
     * @return string
     */
    public function getGmBeschreibung()
    {
        return $this->gmBeschreibung;
    }

    /**
     * Set gmLongitude
     *
     * @param string $gmLongitude
     *
     * @return ArtikelGooglePositionen
     */
    public function setGmLongitude($gmLongitude)
    {
        $this->gmLongitude = $gmLongitude;

        return $this;
    }

    /**
     * Get gmLongitude
     *
     * @return string
     */
    public function getGmLongitude()
    {
        return $this->gmLongitude;
    }

    /**
     * Set gmLatitude
     *
     * @param string $gmLatitude
     *
     * @return ArtikelGooglePositionen
     */
    public function setGmLatitude($gmLatitude)
    {
        $this->gmLatitude = $gmLatitude;

        return $this;
    }

    /**
     * Get gmLatitude
     *
     * @return string
     */
    public function getGmLatitude()
    {
        return $this->gmLatitude;
    }

    /**
     * Set gmK
     *
     * @param \AppBundle\Entity\ArtikelKategorie $gmK
     *
     * @return ArtikelGooglePositionen
     */
    public function setGmK(\AppBundle\Entity\ArtikelKategorie $gmK = null)
    {
        $this->gmK = $gmK;

        return $this;
    }

    /**
     * Get gmK
     *
     * @return \AppBundle\Entity\ArtikelKategorie
     */
    public function getGmK()
    {
        return $this->gmK;
    }
}
