<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtikelEinbuchung
 *
 * @ORM\Table(name="ARTIKEL_Einbuchung", indexes={@ORM\Index(name="a_x_kid", columns={"a_x_kid"}), @ORM\Index(name="a_x_bid", columns={"a_x_bid"}), @ORM\Index(name="a_x_uid", columns={"a_x_uid"})})
 * @ORM\Entity
 */
class ArtikelEinbuchung
{
    /**
     * @var integer
     *
     * @ORM\Column(name="a_x_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aXId;

    /**
     * @var string
     *
     * @ORM\Column(name="a_x_referenz", type="string", length=64, nullable=false)
     */
    private $aXReferenz;

    /**
     * @var integer
     *
     * @ORM\Column(name="a_x_anzahl", type="integer", nullable=false)
     */
    private $aXAnzahl = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="a_x_preis", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $aXPreis;

    /**
     * @var string
     *
     * @ORM\Column(name="a_x_preis_brutto", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $aXPreisBrutto = '0.00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="a_x_created", type="datetime", nullable=false)
     */
    private $aXCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="a_x_updated", type="datetime", nullable=false)
     */
    private $aXUpdated = 'CURRENT_TIMESTAMP';

    /**
     * @var \AppBundle\Entity\ShopBestellungen
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopBestellungen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="a_x_bid", referencedColumnName="nr")
     * })
     */
    private $aXBid;

    /**
     * @var \AppBundle\Entity\ArtikelKategorie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtikelKategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="a_x_kid", referencedColumnName="a_k_id")
     * })
     */
    private $aXKid;

    /**
     * @var \AppBundle\Entity\AgenturUser
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgenturUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="a_x_uid", referencedColumnName="au_id")
     * })
     */
    private $aXUid;



    /**
     * Get aXId
     *
     * @return integer
     */
    public function getAXId()
    {
        return $this->aXId;
    }

    /**
     * Set aXReferenz
     *
     * @param string $aXReferenz
     *
     * @return ArtikelEinbuchung
     */
    public function setAXReferenz($aXReferenz)
    {
        $this->aXReferenz = $aXReferenz;

        return $this;
    }

    /**
     * Get aXReferenz
     *
     * @return string
     */
    public function getAXReferenz()
    {
        return $this->aXReferenz;
    }

    /**
     * Set aXAnzahl
     *
     * @param integer $aXAnzahl
     *
     * @return ArtikelEinbuchung
     */
    public function setAXAnzahl($aXAnzahl)
    {
        $this->aXAnzahl = $aXAnzahl;

        return $this;
    }

    /**
     * Get aXAnzahl
     *
     * @return integer
     */
    public function getAXAnzahl()
    {
        return $this->aXAnzahl;
    }

    /**
     * Set aXPreis
     *
     * @param string $aXPreis
     *
     * @return ArtikelEinbuchung
     */
    public function setAXPreis($aXPreis)
    {
        $this->aXPreis = $aXPreis;

        return $this;
    }

    /**
     * Get aXPreis
     *
     * @return string
     */
    public function getAXPreis()
    {
        return $this->aXPreis;
    }

    /**
     * Set aXPreisBrutto
     *
     * @param string $aXPreisBrutto
     *
     * @return ArtikelEinbuchung
     */
    public function setAXPreisBrutto($aXPreisBrutto)
    {
        $this->aXPreisBrutto = $aXPreisBrutto;

        return $this;
    }

    /**
     * Get aXPreisBrutto
     *
     * @return string
     */
    public function getAXPreisBrutto()
    {
        return $this->aXPreisBrutto;
    }

    /**
     * Set aXCreated
     *
     * @param \DateTime $aXCreated
     *
     * @return ArtikelEinbuchung
     */
    public function setAXCreated($aXCreated)
    {
        $this->aXCreated = $aXCreated;

        return $this;
    }

    /**
     * Get aXCreated
     *
     * @return \DateTime
     */
    public function getAXCreated()
    {
        return $this->aXCreated;
    }

    /**
     * Set aXUpdated
     *
     * @param \DateTime $aXUpdated
     *
     * @return ArtikelEinbuchung
     */
    public function setAXUpdated($aXUpdated)
    {
        $this->aXUpdated = $aXUpdated;

        return $this;
    }

    /**
     * Get aXUpdated
     *
     * @return \DateTime
     */
    public function getAXUpdated()
    {
        return $this->aXUpdated;
    }

    /**
     * Set aXBid
     *
     * @param \AppBundle\Entity\ShopBestellungen $aXBid
     *
     * @return ArtikelEinbuchung
     */
    public function setAXBid(\AppBundle\Entity\ShopBestellungen $aXBid = null)
    {
        $this->aXBid = $aXBid;

        return $this;
    }

    /**
     * Get aXBid
     *
     * @return \AppBundle\Entity\ShopBestellungen
     */
    public function getAXBid()
    {
        return $this->aXBid;
    }

    /**
     * Set aXKid
     *
     * @param \AppBundle\Entity\ArtikelKategorie $aXKid
     *
     * @return ArtikelEinbuchung
     */
    public function setAXKid(\AppBundle\Entity\ArtikelKategorie $aXKid = null)
    {
        $this->aXKid = $aXKid;

        return $this;
    }

    /**
     * Get aXKid
     *
     * @return \AppBundle\Entity\ArtikelKategorie
     */
    public function getAXKid()
    {
        return $this->aXKid;
    }

    /**
     * Set aXUid
     *
     * @param \AppBundle\Entity\AgenturUser $aXUid
     *
     * @return ArtikelEinbuchung
     */
    public function setAXUid(\AppBundle\Entity\AgenturUser $aXUid = null)
    {
        $this->aXUid = $aXUid;

        return $this;
    }

    /**
     * Get aXUid
     *
     * @return \AppBundle\Entity\AgenturUser
     */
    public function getAXUid()
    {
        return $this->aXUid;
    }
}
