<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopBewertungslinks
 *
 * @ORM\Table(name="SHOP_Bewertungslinks", uniqueConstraints={@ORM\UniqueConstraint(name="bwl_nr_2", columns={"bwl_nr"})}, indexes={@ORM\Index(name="bwl_nr", columns={"bwl_nr"})})
 * @ORM\Entity
 */
class ShopBewertungslinks
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bwl_id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $bwlId;
    /**
     * @var boolean
     *
     * @ORM\Column(name="bwl_status", type="boolean", nullable=false)
     */
    private $bwlStatus;

    /**
     * @var \AppBundle\Entity\ShopBestellungen
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ShopBestellungen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bwl_nr", referencedColumnName="nr", unique=true)
     * })
     */
    private $bwlNr;

    /**
     * @return int
     */
    public function getBwlId()
    {
        return $this->bwlId;
    }

    /**
     * @param int $bwlId
     */
    public function setBwlId($bwlId)
    {
        $this->bwlId = $bwlId;
    }
    
    /**
     * Set bwlStatus
     *
     * @param boolean $bwlStatus
     *
     * @return ShopBewertungslinks
     */
    public function setBwlStatus($bwlStatus)
    {
        $this->bwlStatus = $bwlStatus;

        return $this;
    }

    /**
     * Get bwlStatus
     *
     * @return boolean
     */
    public function getBwlStatus()
    {
        return $this->bwlStatus;
    }

    /**
     * Set bwlNr
     *
     * @param \AppBundle\Entity\ShopBestellungen $bwlNr
     *
     * @return ShopBewertungslinks
     */
    public function setBwlNr(\AppBundle\Entity\ShopBestellungen $bwlNr = null)
    {
        $this->bwlNr = $bwlNr;

        return $this;
    }

    /**
     * Get bwlNr
     *
     * @return \AppBundle\Entity\ShopBestellungen
     */
    public function getBwlNr()
    {
        return $this->bwlNr;
    }
}
