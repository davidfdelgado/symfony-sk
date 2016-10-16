<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopPosition
 *
 * @ORM\Table(name="SHOP_Position", indexes={@ORM\Index(name="p_bid", columns={"p_bid"}), @ORM\Index(name="p_bid_2", columns={"p_bid"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ShopPositionRepository")
 */
class ShopPosition
{
    /**
     * @var integer
     *
     * @ORM\Column(name="p_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pId;

    /**
     * @var \AppBundle\Entity\ShopPositionArtikelnummern
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopPositionArtikelnummern")
     * @ORM\JoinColumn(name="p_tid",  referencedColumnName="pk_artikelnummer"))
     */
    private $pTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="p_anzahl", type="integer", nullable=false)
     */
    private $pAnzahl;

    /**
     * @var string
     *
     * @ORM\Column(name="p_preis", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $pPreis;

    /**
     * @var integer
     *
     * @ORM\Column(name="p_mwst", type="integer", nullable=false)
     */
    private $pMwst;

    /**
     * @var string
     *
     * @ORM\Column(name="p_bezeichnung", type="string", length=64, nullable=false)
     */
    private $pBezeichnung;

    /**
     * @var string
     *
     * @ORM\Column(name="p_bezeichnung_en", type="string", length=64, nullable=false)
     */
    private $pBezeichnungEn;

    /**
     * @var integer
     *
     * @ORM\Column(name="p_vtext", type="integer", nullable=false)
     */
    private $pVtext;

    /**
     * @var integer
     *
     * @ORM\Column(name="p_rtext", type="integer", nullable=false)
     */
    private $pRtext;

    /**
     * @var integer
     *
     * @ORM\Column(name="p_pa_id", type="integer", nullable=false)
     */
    private $pPaId = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="p_datum", type="datetime", nullable=true)
     */
    private $pDatum;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="p_checkin", type="datetime", nullable=true)
     */
    private $pCheckin;

    /**
     * @var \AppBundle\Entity\ShopBestellungen
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopBestellungen", inversedBy="bPositionen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="p_bid", referencedColumnName="nr")
     * })
     */
    private $pBid;

    /**
     * @var \AppBundle\Entity\ShopScans
     *
     */
    private $pSc;

    /**
     * Get pId
     *
     * @return integer
     */
    public function getPId()
    {
        return $this->pId;
    }

    /**
     * Set pTid
     *
     * @param string $pTid
     *
     * @return ShopPosition
     */
    public function setPTid($pTid)
    {
        $this->pTid = $pTid;

        return $this;
    }

    /**
     * Get pTid
     *
     * @return string
     */
    public function getPTid()
    {
        return $this->pTid;
    }

    /**
     * Set pAnzahl
     *
     * @param integer $pAnzahl
     *
     * @return ShopPosition
     */
    public function setPAnzahl($pAnzahl)
    {
        $this->pAnzahl = $pAnzahl;

        return $this;
    }

    /**
     * Get pAnzahl
     *
     * @return integer
     */
    public function getPAnzahl()
    {
        return $this->pAnzahl;
    }

    /**
     * Set pPreis
     *
     * @param string $pPreis
     *
     * @return ShopPosition
     */
    public function setPPreis($pPreis)
    {
        $this->pPreis = $pPreis;

        return $this;
    }

    /**
     * Get pPreis
     *
     * @return string
     */
    public function getPPreis()
    {
        return $this->pPreis;
    }

    /**
     * Set pMwst
     *
     * @param integer $pMwst
     *
     * @return ShopPosition
     */
    public function setPMwst($pMwst)
    {
        $this->pMwst = $pMwst;

        return $this;
    }

    /**
     * Get pMwst
     *
     * @return integer
     */
    public function getPMwst()
    {
        return $this->pMwst;
    }

    /**
     * Set pBezeichnung
     *
     * @param string $pBezeichnung
     *
     * @return ShopPosition
     */
    public function setPBezeichnung($pBezeichnung)
    {
        $this->pBezeichnung = $pBezeichnung;

        return $this;
    }

    /**
     * Get pBezeichnung
     *
     * @return string
     */
    public function getPBezeichnung()
    {
        return $this->pBezeichnung;
    }

    /**
     * Set pBezeichnungEn
     *
     * @param string $pBezeichnungEn
     *
     * @return ShopPosition
     */
    public function setPBezeichnungEn($pBezeichnungEn)
    {
        $this->pBezeichnungEn = $pBezeichnungEn;

        return $this;
    }

    /**
     * Get pBezeichnungEn
     *
     * @return string
     */
    public function getPBezeichnungEn()
    {
        return $this->pBezeichnungEn;
    }

    /**
     * Set pVtext
     *
     * @param integer $pVtext
     *
     * @return ShopPosition
     */
    public function setPVtext($pVtext)
    {
        $this->pVtext = $pVtext;

        return $this;
    }

    /**
     * Get pVtext
     *
     * @return integer
     */
    public function getPVtext()
    {
        return $this->pVtext;
    }

    /**
     * Set pRtext
     *
     * @param integer $pRtext
     *
     * @return ShopPosition
     */
    public function setPRtext($pRtext)
    {
        $this->pRtext = $pRtext;

        return $this;
    }

    /**
     * Get pRtext
     *
     * @return integer
     */
    public function getPRtext()
    {
        return $this->pRtext;
    }

    /**
     * Set pPaId
     *
     * @param integer $pPaId
     *
     * @return ShopPosition
     */
    public function setPPaId($pPaId)
    {
        $this->pPaId = $pPaId;

        return $this;
    }

    /**
     * Get pPaId
     *
     * @return integer
     */
    public function getPPaId()
    {
        return $this->pPaId;
    }

    /**
     * Set pDatum
     *
     * @param \DateTime $pDatum
     *
     * @return ShopPosition
     */
    public function setPDatum($pDatum)
    {
        $this->pDatum = $pDatum;

        return $this;
    }

    /**
     * Get pDatum
     *
     * @return \DateTime
     */
    public function getPDatum()
    {
        return $this->pDatum;
    }

    /**
     * Set pCheckin
     *
     * @param \DateTime $pCheckin
     *
     * @return ShopPosition
     */
    public function setPCheckin($pCheckin)
    {
        $this->pCheckin = $pCheckin;

        return $this;
    }

    /**
     * Get pCheckin
     *
     * @return \DateTime
     */
    public function getPCheckin()
    {
        return $this->pCheckin;
    }

    /**
     * Set pBid
     *
     * @param \AppBundle\Entity\ShopBestellungen $pBid
     *
     * @return ShopPosition
     */
    public function setPBid(\AppBundle\Entity\ShopBestellungen $pBid = null)
    {
        $this->pBid = $pBid;

        return $this;
    }

    /**
     * Get pBid
     *
     * @return \AppBundle\Entity\ShopBestellungen
     */
    public function getPBid()
    {
        return $this->pBid;
    }

    /**
     * @return \AppBundle\Entity\ShopScans
     */
    public function getPSc()
    {
        if($this->getPBid() && $this->getPTid()){

            foreach($this->getPBid()->getBSc() as $sc){

                if( $sc->getScK() == $this->getPTid()->getPkKategorie() ){

                    $this->pSc = $sc;

                    return $this->pSc;

                }

            }

            return false;

        } else {

            return false;

        }
    }
}
