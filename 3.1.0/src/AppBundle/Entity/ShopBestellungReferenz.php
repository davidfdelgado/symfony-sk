<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopBestellungReferenz
 *
 * @ORM\Table(name="SHOP_Bestellung_Referenz", uniqueConstraints={@ORM\UniqueConstraint(name="rf_id", columns={"rf_id", "rf_char"})}, indexes={@ORM\Index(name="IDX_47AAEAF0C27DF04F", columns={"rf_id"})})
 * @ORM\Entity
 */
class ShopBestellungReferenz
{
    /**
     * @var integer
     *
     * @ORM\Column(name="rf_index", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $rfIndex;

    /**
     * @var boolean
     *
     * @ORM\Column(name="rf_type", type="boolean", nullable=false)
     */
    private $rfType = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="rf_char", type="string", length=64, nullable=false)
     */
    private $rfChar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="rf_created", type="datetime", nullable=false)
     */
    private $rfCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var \AppBundle\Entity\ShopBestellungen
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopBestellungen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rf_id", referencedColumnName="nr")
     * })
     */
    private $rf;



    /**
     * Get rfIndex
     *
     * @return integer
     */
    public function getRfIndex()
    {
        return $this->rfIndex;
    }

    /**
     * Set rfType
     *
     * @param boolean $rfType
     *
     * @return ShopBestellungReferenz
     */
    public function setRfType($rfType)
    {
        $this->rfType = $rfType;

        return $this;
    }

    /**
     * Get rfType
     *
     * @return boolean
     */
    public function getRfType()
    {
        return $this->rfType;
    }

    /**
     * Set rfChar
     *
     * @param string $rfChar
     *
     * @return ShopBestellungReferenz
     */
    public function setRfChar($rfChar)
    {
        $this->rfChar = $rfChar;

        return $this;
    }

    /**
     * Get rfChar
     *
     * @return string
     */
    public function getRfChar()
    {
        return $this->rfChar;
    }

    /**
     * Set rfCreated
     *
     * @param \DateTime $rfCreated
     *
     * @return ShopBestellungReferenz
     */
    public function setRfCreated($rfCreated)
    {
        $this->rfCreated = $rfCreated;

        return $this;
    }

    /**
     * Get rfCreated
     *
     * @return \DateTime
     */
    public function getRfCreated()
    {
        return $this->rfCreated;
    }

    /**
     * Set rf
     *
     * @param \AppBundle\Entity\ShopBestellungen $rf
     *
     * @return ShopBestellungReferenz
     */
    public function setRf(\AppBundle\Entity\ShopBestellungen $rf = null)
    {
        $this->rf = $rf;

        return $this;
    }

    /**
     * Get rf
     *
     * @return \AppBundle\Entity\ShopBestellungen
     */
    public function getRf()
    {
        return $this->rf;
    }
}
