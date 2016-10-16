<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopDokumente
 *
 * @ORM\Table(name="SHOP_Dokumente", uniqueConstraints={@ORM\UniqueConstraint(name="do_bid_2", columns={"do_bid", "do_type", "do_path"})}, indexes={@ORM\Index(name="do_bid", columns={"do_bid"})})
 * @ORM\Entity
 */
class ShopDokumente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="do_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $doId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="do_type", type="boolean", nullable=false)
     */
    private $doType;

    /**
     * @var boolean
     *
     * @ORM\Column(name="do_status", type="boolean", nullable=false)
     */
    private $doStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="do_path", type="string", length=128, nullable=false)
     */
    private $doPath;

    /**
     * @var string
     *
     * @ORM\Column(name="do_link", type="string", length=128, nullable=true)
     */
    private $doLink;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="do_updated", type="datetime", nullable=false)
     */
    private $doUpdated;

    /**
     * @var \AppBundle\Entity\ShopBestellungen
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopBestellungen", inversedBy="bDocs")
     * @ORM\JoinColumn(name="do_bid", referencedColumnName="nr")
     */
    private $doBid;



    /**
     * Get doId
     *
     * @return integer
     */
    public function getDoId()
    {
        return $this->doId;
    }

    /**
     * Set doType
     *
     * @param boolean $doType
     *
     * @return ShopDokumente
     */
    public function setDoType($doType)
    {
        $this->doType = $doType;

        return $this;
    }

    /**
     * Get doType
     *
     * @return boolean
     */
    public function getDoType()
    {
        return $this->doType;
    }

    /**
     * Set doStatus
     *
     * @param boolean $doStatus
     *
     * @return ShopDokumente
     */
    public function setDoStatus($doStatus)
    {
        $this->doStatus = $doStatus;

        return $this;
    }

    /**
     * Get doStatus
     *
     * @return boolean
     */
    public function getDoStatus()
    {
        return $this->doStatus;
    }

    /**
     * Set doPath
     *
     * @param string $doPath
     *
     * @return ShopDokumente
     */
    public function setDoPath($doPath)
    {
        $this->doPath = $doPath;

        return $this;
    }

    /**
     * Get doPath
     *
     * @return string
     */
    public function getDoPath()
    {
        return $this->doPath;
    }

    /**
     * Set doLink
     *
     * @param string $doLink
     *
     * @return ShopDokumente
     */
    public function setDoLink($doLink)
    {
        $this->doLink = $doLink;

        return $this;
    }

    /**
     * Get doLink
     *
     * @return string
     */
    public function getDoLink()
    {
        return $this->doLink;
    }

    /**
     * Set doUpdated
     *
     * @param \DateTime $doUpdated
     *
     * @return ShopDokumente
     */
    public function setDoUpdated($doUpdated)
    {
        $this->doUpdated = $doUpdated;

        return $this;
    }

    /**
     * Get doUpdated
     *
     * @return \DateTime
     */
    public function getDoUpdated()
    {
        return $this->doUpdated;
    }

    /**
     * Set doBid
     *
     * @param \AppBundle\Entity\ShopBestellungen $doBid
     *
     * @return ShopDokumente
     */
    public function setDoBid(\AppBundle\Entity\ShopBestellungen $doBid = null)
    {
        $this->doBid = $doBid;

        return $this;
    }

    /**
     * Get doBid
     *
     * @return \AppBundle\Entity\ShopBestellungen
     */
    public function getDoBid()
    {
        return $this->doBid;
    }

    public function __construct()
    {
        if(!$this->doUpdated) $this->doUpdated = new \DateTime();
    }

    public function getWebLink(){

        $link = "http://api.sightseeing-kontor.de/pdfs/show/?s=".rawurlencode($this->doLink);
        return $link;
    }
}
