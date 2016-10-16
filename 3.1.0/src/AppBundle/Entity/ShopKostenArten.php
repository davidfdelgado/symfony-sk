<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopKostenArten
 *
 * @ORM\Table(name="SHOP_Kosten_Arten")
 * @ORM\Entity
 */
class ShopKostenArten
{
    /**
     * @var integer
     *
     * @ORM\Column(name="xa_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $xaId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="xa_status", type="boolean", nullable=false)
     */
    private $xaStatus = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="xa_von", type="date", nullable=false)
     */
    private $xaVon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="xa_bis", type="date", nullable=false)
     */
    private $xaBis;

    /**
     * @var string
     *
     * @ORM\Column(name="xa_bezeichnung", type="string", length=64, nullable=false)
     */
    private $xaBezeichnung;

    /**
     * @var string
     *
     * @ORM\Column(name="xa_zusatz", type="string", length=128, nullable=true)
     */
    private $xaZusatz;

    /**
     * @var string
     *
     * @ORM\Column(name="xa_netto", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $xaNetto;

    /**
     * @var string
     *
     * @ORM\Column(name="xa_brutto", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $xaBrutto;

    /**
     * @var integer
     *
     * @ORM\Column(name="xa_mwst", type="integer", nullable=false)
     */
    private $xaMwst;

    /**
     * @var integer
     *
     * @ORM\Column(name="xa_prozent", type="integer", nullable=false)
     */
    private $xaProzent;



    /**
     * Get xaId
     *
     * @return integer
     */
    public function getXaId()
    {
        return $this->xaId;
    }

    /**
     * Set xaStatus
     *
     * @param boolean $xaStatus
     *
     * @return ShopKostenArten
     */
    public function setXaStatus($xaStatus)
    {
        $this->xaStatus = $xaStatus;

        return $this;
    }

    /**
     * Get xaStatus
     *
     * @return boolean
     */
    public function getXaStatus()
    {
        return $this->xaStatus;
    }

    /**
     * Set xaVon
     *
     * @param \DateTime $xaVon
     *
     * @return ShopKostenArten
     */
    public function setXaVon($xaVon)
    {
        $this->xaVon = $xaVon;

        return $this;
    }

    /**
     * Get xaVon
     *
     * @return \DateTime
     */
    public function getXaVon()
    {
        return $this->xaVon;
    }

    /**
     * Set xaBis
     *
     * @param \DateTime $xaBis
     *
     * @return ShopKostenArten
     */
    public function setXaBis($xaBis)
    {
        $this->xaBis = $xaBis;

        return $this;
    }

    /**
     * Get xaBis
     *
     * @return \DateTime
     */
    public function getXaBis()
    {
        return $this->xaBis;
    }

    /**
     * Set xaBezeichnung
     *
     * @param string $xaBezeichnung
     *
     * @return ShopKostenArten
     */
    public function setXaBezeichnung($xaBezeichnung)
    {
        $this->xaBezeichnung = $xaBezeichnung;

        return $this;
    }

    /**
     * Get xaBezeichnung
     *
     * @return string
     */
    public function getXaBezeichnung()
    {
        return $this->xaBezeichnung;
    }

    /**
     * Set xaZusatz
     *
     * @param string $xaZusatz
     *
     * @return ShopKostenArten
     */
    public function setXaZusatz($xaZusatz)
    {
        $this->xaZusatz = $xaZusatz;

        return $this;
    }

    /**
     * Get xaZusatz
     *
     * @return string
     */
    public function getXaZusatz()
    {
        return $this->xaZusatz;
    }

    /**
     * Set xaNetto
     *
     * @param string $xaNetto
     *
     * @return ShopKostenArten
     */
    public function setXaNetto($xaNetto)
    {
        $this->xaNetto = $xaNetto;

        return $this;
    }

    /**
     * Get xaNetto
     *
     * @return string
     */
    public function getXaNetto()
    {
        return $this->xaNetto;
    }

    /**
     * Set xaBrutto
     *
     * @param string $xaBrutto
     *
     * @return ShopKostenArten
     */
    public function setXaBrutto($xaBrutto)
    {
        $this->xaBrutto = $xaBrutto;

        return $this;
    }

    /**
     * Get xaBrutto
     *
     * @return string
     */
    public function getXaBrutto()
    {
        return $this->xaBrutto;
    }

    /**
     * Set xaMwst
     *
     * @param integer $xaMwst
     *
     * @return ShopKostenArten
     */
    public function setXaMwst($xaMwst)
    {
        $this->xaMwst = $xaMwst;

        return $this;
    }

    /**
     * Get xaMwst
     *
     * @return integer
     */
    public function getXaMwst()
    {
        return $this->xaMwst;
    }

    /**
     * Set xaProzent
     *
     * @param integer $xaProzent
     *
     * @return ShopKostenArten
     */
    public function setXaProzent($xaProzent)
    {
        $this->xaProzent = $xaProzent;

        return $this;
    }

    /**
     * Get xaProzent
     *
     * @return integer
     */
    public function getXaProzent()
    {
        return $this->xaProzent;
    }
}
