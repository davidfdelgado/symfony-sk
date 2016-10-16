<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtikelKategorieBewertungen
 *
 * @ORM\Table(name="ARTIKEL_Kategorie_Bewertungen", uniqueConstraints={@ORM\UniqueConstraint(name="bw_bid_2", columns={"bw_bid", "bw_kid"})}, indexes={@ORM\Index(name="bw_kid", columns={"bw_kid"}), @ORM\Index(name="bw_user", columns={"bw_user"}), @ORM\Index(name="bw_bid", columns={"bw_bid"})})
 * @ORM\Entity
 */
class ArtikelKategorieBewertungen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bw_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bwId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bw_status", type="boolean", nullable=false)
     */
    private $bwStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="bw_sterne", type="integer", nullable=false)
     */
    private $bwSterne;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bw_created", type="datetime", nullable=false)
     */
    private $bwCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="bw_bewertung_name", type="string", length=128, nullable=false)
     */
    private $bwBewertungName;

    /**
     * @var string
     *
     * @ORM\Column(name="bw_bewertung_text", type="string", length=1024, nullable=false)
     */
    private $bwBewertungText;

    /**
     * @var \AppBundle\Entity\ArtikelKategorie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtikelKategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bw_kid", referencedColumnName="a_k_id")
     * })
     */
    private $bwKid;

    /**
     * @var \AppBundle\Entity\AgenturUser
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgenturUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bw_user", referencedColumnName="au_id")
     * })
     */
    private $bwUser;

    /**
     * @var \AppBundle\Entity\ShopBestellungen
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopBestellungen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bw_bid", referencedColumnName="nr")
     * })
     */
    private $bwBid;



    /**
     * Get bwId
     *
     * @return integer
     */
    public function getBwId()
    {
        return $this->bwId;
    }

    /**
     * Set bwStatus
     *
     * @param boolean $bwStatus
     *
     * @return ArtikelKategorieBewertungen
     */
    public function setBwStatus($bwStatus)
    {
        $this->bwStatus = $bwStatus;

        return $this;
    }

    /**
     * Get bwStatus
     *
     * @return boolean
     */
    public function getBwStatus()
    {
        return $this->bwStatus;
    }

    /**
     * Set bwSterne
     *
     * @param integer $bwSterne
     *
     * @return ArtikelKategorieBewertungen
     */
    public function setBwSterne($bwSterne)
    {
        $this->bwSterne = $bwSterne;

        return $this;
    }

    /**
     * Get bwSterne
     *
     * @return integer
     */
    public function getBwSterne()
    {
        return $this->bwSterne;
    }

    /**
     * Set bwCreated
     *
     * @param \DateTime $bwCreated
     *
     * @return ArtikelKategorieBewertungen
     */
    public function setBwCreated($bwCreated)
    {
        $this->bwCreated = $bwCreated;

        return $this;
    }

    /**
     * Get bwCreated
     *
     * @return \DateTime
     */
    public function getBwCreated()
    {
        return $this->bwCreated;
    }

    /**
     * Set bwBewertungName
     *
     * @param string $bwBewertungName
     *
     * @return ArtikelKategorieBewertungen
     */
    public function setBwBewertungName($bwBewertungName)
    {
        $this->bwBewertungName = $bwBewertungName;

        return $this;
    }

    /**
     * Get bwBewertungName
     *
     * @return string
     */
    public function getBwBewertungName()
    {
        return $this->bwBewertungName;
    }

    /**
     * Set bwBewertungText
     *
     * @param string $bwBewertungText
     *
     * @return ArtikelKategorieBewertungen
     */
    public function setBwBewertungText($bwBewertungText)
    {
        $this->bwBewertungText = $bwBewertungText;

        return $this;
    }

    /**
     * Get bwBewertungText
     *
     * @return string
     */
    public function getBwBewertungText()
    {
        return $this->bwBewertungText;
    }

    /**
     * Set bwKid
     *
     * @param \AppBundle\Entity\ArtikelKategorie $bwKid
     *
     * @return ArtikelKategorieBewertungen
     */
    public function setBwKid(\AppBundle\Entity\ArtikelKategorie $bwKid = null)
    {
        $this->bwKid = $bwKid;

        return $this;
    }

    /**
     * Get bwKid
     *
     * @return \AppBundle\Entity\ArtikelKategorie
     */
    public function getBwKid()
    {
        return $this->bwKid;
    }

    /**
     * Set bwUser
     *
     * @param \AppBundle\Entity\AgenturUser $bwUser
     *
     * @return ArtikelKategorieBewertungen
     */
    public function setBwUser(\AppBundle\Entity\AgenturUser $bwUser = null)
    {
        $this->bwUser = $bwUser;

        return $this;
    }

    /**
     * Get bwUser
     *
     * @return \AppBundle\Entity\AgenturUser
     */
    public function getBwUser()
    {
        return $this->bwUser;
    }

    /**
     * Set bwBid
     *
     * @param \AppBundle\Entity\ShopBestellungen $bwBid
     *
     * @return ArtikelKategorieBewertungen
     */
    public function setBwBid(\AppBundle\Entity\ShopBestellungen $bwBid = null)
    {
        $this->bwBid = $bwBid;

        return $this;
    }

    /**
     * Get bwBid
     *
     * @return \AppBundle\Entity\ShopBestellungen
     */
    public function getBwBid()
    {
        return $this->bwBid;
    }
}
