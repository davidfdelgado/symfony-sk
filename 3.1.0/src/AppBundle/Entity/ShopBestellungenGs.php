<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopBestellungenGs
 *
 * @ORM\Table(name="SHOP_Bestellungen_GS", indexes={@ORM\Index(name="gs_b_nid", columns={"gs_b_nid"}), @ORM\Index(name="gs_b_bid", columns={"gs_b_bid"})})
 * @ORM\Entity
 */
class ShopBestellungenGs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="gs_b_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $gsBId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="gs_eingeloest", type="datetime", nullable=false)
     */
    private $gsEingeloest = 'CURRENT_TIMESTAMP';

    /**
     * @var \AppBundle\Entity\ShopBestellungen
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopBestellungen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gs_b_bid", referencedColumnName="nr")
     * })
     */
    private $gsBBid;

    /**
     * @var \AppBundle\Entity\ShopGsCodes
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopGsCodes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gs_b_nid", referencedColumnName="gs_n_id")
     * })
     */
    private $gsBNid;



    /**
     * Get gsBId
     *
     * @return integer
     */
    public function getGsBId()
    {
        return $this->gsBId;
    }

    /**
     * Set gsEingeloest
     *
     * @param \DateTime $gsEingeloest
     *
     * @return ShopBestellungenGs
     */
    public function setGsEingeloest($gsEingeloest)
    {
        $this->gsEingeloest = $gsEingeloest;

        return $this;
    }

    /**
     * Get gsEingeloest
     *
     * @return \DateTime
     */
    public function getGsEingeloest()
    {
        return $this->gsEingeloest;
    }

    /**
     * Set gsBBid
     *
     * @param \AppBundle\Entity\ShopBestellungen $gsBBid
     *
     * @return ShopBestellungenGs
     */
    public function setGsBBid(\AppBundle\Entity\ShopBestellungen $gsBBid = null)
    {
        $this->gsBBid = $gsBBid;

        return $this;
    }

    /**
     * Get gsBBid
     *
     * @return \AppBundle\Entity\ShopBestellungen
     */
    public function getGsBBid()
    {
        return $this->gsBBid;
    }

    /**
     * Set gsBNid
     *
     * @param \AppBundle\Entity\ShopGsCodes $gsBNid
     *
     * @return ShopBestellungenGs
     */
    public function setGsBNid(\AppBundle\Entity\ShopGsCodes $gsBNid = null)
    {
        $this->gsBNid = $gsBNid;

        return $this;
    }

    /**
     * Get gsBNid
     *
     * @return \AppBundle\Entity\ShopGsCodes
     */
    public function getGsBNid()
    {
        return $this->gsBNid;
    }
}
