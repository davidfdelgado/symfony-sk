<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopQr
 *
 * @ORM\Table(name="SHOP_QR")
 * @ORM\Entity
 */
class ShopQr
{
    /**
     * @var integer
     *
     * @ORM\Column(name="qr_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $qrId;

    /**
     * @var string
     *
     * @ORM\Column(name="qr_typ", type="string", length=32, nullable=false)
     */
    private $qrTyp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="qr_date", type="datetime", nullable=false)
     */
    private $qrDate = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="qr_session", type="string", length=32, nullable=false)
     */
    private $qrSession;

    /**
     * @var string
     *
     * @ORM\Column(name="qr_art", type="string", length=32, nullable=false)
     */
    private $qrArt;

    /**
     * @var integer
     *
     * @ORM\Column(name="qr_bid", type="integer", nullable=false)
     */
    private $qrBid;



    /**
     * Get qrId
     *
     * @return integer
     */
    public function getQrId()
    {
        return $this->qrId;
    }

    /**
     * Set qrTyp
     *
     * @param string $qrTyp
     *
     * @return ShopQr
     */
    public function setQrTyp($qrTyp)
    {
        $this->qrTyp = $qrTyp;

        return $this;
    }

    /**
     * Get qrTyp
     *
     * @return string
     */
    public function getQrTyp()
    {
        return $this->qrTyp;
    }

    /**
     * Set qrDate
     *
     * @param \DateTime $qrDate
     *
     * @return ShopQr
     */
    public function setQrDate($qrDate)
    {
        $this->qrDate = $qrDate;

        return $this;
    }

    /**
     * Get qrDate
     *
     * @return \DateTime
     */
    public function getQrDate()
    {
        return $this->qrDate;
    }

    /**
     * Set qrSession
     *
     * @param string $qrSession
     *
     * @return ShopQr
     */
    public function setQrSession($qrSession)
    {
        $this->qrSession = $qrSession;

        return $this;
    }

    /**
     * Get qrSession
     *
     * @return string
     */
    public function getQrSession()
    {
        return $this->qrSession;
    }

    /**
     * Set qrArt
     *
     * @param string $qrArt
     *
     * @return ShopQr
     */
    public function setQrArt($qrArt)
    {
        $this->qrArt = $qrArt;

        return $this;
    }

    /**
     * Get qrArt
     *
     * @return string
     */
    public function getQrArt()
    {
        return $this->qrArt;
    }

    /**
     * Set qrBid
     *
     * @param integer $qrBid
     *
     * @return ShopQr
     */
    public function setQrBid($qrBid)
    {
        $this->qrBid = $qrBid;

        return $this;
    }

    /**
     * Get qrBid
     *
     * @return integer
     */
    public function getQrBid()
    {
        return $this->qrBid;
    }
}
