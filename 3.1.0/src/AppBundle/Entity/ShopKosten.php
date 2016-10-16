<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopKosten
 *
 * @ORM\Table(name="SHOP_Kosten")
 * @ORM\Entity
 */
class ShopKosten
{
    /**
     * @var integer
     *
     * @ORM\Column(name="x_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $xId;

    /**
     * @var string
     *
     * @ORM\Column(name="x_rnnr", type="string", length=32, nullable=false)
     */
    private $xRnnr;

    /**
     * @var integer
     *
     * @ORM\Column(name="x_art", type="integer", nullable=false)
     */
    private $xArt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="x_created", type="datetime", nullable=false)
     */
    private $xCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="x_cost", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $xCost;

    /**
     * @var string
     *
     * @ORM\Column(name="x_info", type="string", length=512, nullable=true)
     */
    private $xInfo;



    /**
     * Get xId
     *
     * @return integer
     */
    public function getXId()
    {
        return $this->xId;
    }

    /**
     * Set xRnnr
     *
     * @param string $xRnnr
     *
     * @return ShopKosten
     */
    public function setXRnnr($xRnnr)
    {
        $this->xRnnr = $xRnnr;

        return $this;
    }

    /**
     * Get xRnnr
     *
     * @return string
     */
    public function getXRnnr()
    {
        return $this->xRnnr;
    }

    /**
     * Set xArt
     *
     * @param integer $xArt
     *
     * @return ShopKosten
     */
    public function setXArt($xArt)
    {
        $this->xArt = $xArt;

        return $this;
    }

    /**
     * Get xArt
     *
     * @return integer
     */
    public function getXArt()
    {
        return $this->xArt;
    }

    /**
     * Set xCreated
     *
     * @param \DateTime $xCreated
     *
     * @return ShopKosten
     */
    public function setXCreated($xCreated)
    {
        $this->xCreated = $xCreated;

        return $this;
    }

    /**
     * Get xCreated
     *
     * @return \DateTime
     */
    public function getXCreated()
    {
        return $this->xCreated;
    }

    /**
     * Set xCost
     *
     * @param string $xCost
     *
     * @return ShopKosten
     */
    public function setXCost($xCost)
    {
        $this->xCost = $xCost;

        return $this;
    }

    /**
     * Get xCost
     *
     * @return string
     */
    public function getXCost()
    {
        return $this->xCost;
    }

    /**
     * Set xInfo
     *
     * @param string $xInfo
     *
     * @return ShopKosten
     */
    public function setXInfo($xInfo)
    {
        $this->xInfo = $xInfo;

        return $this;
    }

    /**
     * Get xInfo
     *
     * @return string
     */
    public function getXInfo()
    {
        return $this->xInfo;
    }
}
