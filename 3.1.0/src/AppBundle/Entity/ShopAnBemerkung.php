<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopAnBemerkung
 *
 * @ORM\Table(name="SHOP_AN_Bemerkung", indexes={@ORM\Index(name="o_bid", columns={"o_bid"})})
 * @ORM\Entity
 */
class ShopAnBemerkung
{
    /**
     * @var integer
     *
     * @ORM\Column(name="o_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $oId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="o_art", type="boolean", nullable=false)
     */
    private $oArt;

    /**
     * @var string
     *
     * @ORM\Column(name="o_text", type="text", length=65535, nullable=false)
     */
    private $oText;

    /**
     * @var \AppBundle\Entity\ShopBestellungen
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopBestellungen", inversedBy="bBemerkungen")
     *   @ORM\JoinColumn(name="o_bid", referencedColumnName="nr")
     */
    private $oBid;



    /**
     * Get oId
     *
     * @return integer
     */
    public function getOId()
    {
        return $this->oId;
    }

    /**
     * Set oArt
     *
     * @param boolean $oArt
     *
     * @return ShopAnBemerkung
     */
    public function setOArt($oArt)
    {
        $this->oArt = $oArt;

        return $this;
    }

    /**
     * Get oArt
     *
     * @return boolean
     */
    public function getOArt()
    {
        return $this->oArt;
    }

    /**
     * Set oText
     *
     * @param string $oText
     *
     * @return ShopAnBemerkung
     */
    public function setOText($oText)
    {
        $this->oText = $oText;

        return $this;
    }

    /**
     * Get oText
     *
     * @return string
     */
    public function getOText()
    {
        return $this->oText;
    }

    /**
     * Set oBid
     *
     * @param \AppBundle\Entity\ShopBestellungen $oBid
     *
     * @return ShopAnBemerkung
     */
    public function setOBid(\AppBundle\Entity\ShopBestellungen $oBid = null)
    {
        $this->oBid = $oBid;

        return $this;
    }

    /**
     * Get oBid
     *
     * @return \AppBundle\Entity\ShopBestellungen
     */
    public function getOBid()
    {
        return $this->oBid;
    }
}
