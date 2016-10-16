<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payments
 *
 * @ORM\Table(name="payments", indexes={@ORM\Index(name="payment_status", columns={"payment_status"}), @ORM\Index(name="itemid", columns={"itemid"})})
 * @ORM\Entity
 */
class Payments
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="paytype", type="integer", length=1, nullable=false)
     */
    private $paytype = 1;

    /**
     * @var ShopBestellungen
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopBestellungen", inversedBy="bZahlungen")
     * @ORM\JoinColumn(name="payBid", referencedColumnName="nr")
     */
    private $payBid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="rnfeallig", type="date", nullable=true)
     */
    private $rnfeallig;

    /**
     * @var string
     *
     * @ORM\Column(name="txnid", type="string", length=32, nullable=true)
     */
    private $txnid;

    /**
     * @var string
     *
     * @ORM\Column(name="buyeremail", type="string", length=64, nullable=true)
     */
    private $buyeremail;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_method", type="string", length=32, nullable=true)
     */
    private $paymentMethod;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_amount", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $paymentAmount = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_fee", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $paymentFee = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_status", type="string", length=25, nullable=false)
     */
    private $paymentStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="itemid", type="string", length=25, nullable=true)
     */
    private $itemid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdtime", type="datetime", nullable=false)
     */
    private $createdtime = 'CURRENT_TIMESTAMP()';

    /**
     * @var string
     *
     * @ORM\Column(name="reason", type="string", length=128, nullable=false)
     */
    private $reason;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set paytype
     *
     * @param boolean $paytype
     *
     * @return Payments
     */
    public function setPaytype($paytype)
    {
        $this->paytype = $paytype;

        return $this;
    }

    /**
     * Get paytype
     *
     * @return boolean
     */
    public function getPaytype()
    {
        return $this->paytype;
    }

    /**
     * Set rnfeallig
     *
     * @param \DateTime $rnfeallig
     *
     * @return Payments
     */
    public function setRnfeallig($rnfeallig)
    {
        $this->rnfeallig = $rnfeallig;

        return $this;
    }

    /**
     * Get rnfeallig
     *
     * @return \DateTime
     */
    public function getRnfeallig()
    {
        return $this->rnfeallig;
    }

    /**
     * Set txnid
     *
     * @param string $txnid
     *
     * @return Payments
     */
    public function setTxnid($txnid)
    {
        $this->txnid = $txnid;

        return $this;
    }

    /**
     * Get txnid
     *
     * @return string
     */
    public function getTxnid()
    {
        return $this->txnid;
    }

    /**
     * Set buyeremail
     *
     * @param string $buyeremail
     *
     * @return Payments
     */
    public function setBuyeremail($buyeremail)
    {
        $this->buyeremail = $buyeremail;

        return $this;
    }

    /**
     * Get buyeremail
     *
     * @return string
     */
    public function getBuyeremail()
    {
        return $this->buyeremail;
    }

    /**
     * Set paymentMethod
     *
     * @param string $paymentMethod
     *
     * @return Payments
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Get paymentMethod
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Set paymentAmount
     *
     * @param string $paymentAmount
     *
     * @return Payments
     */
    public function setPaymentAmount($paymentAmount)
    {
        $this->paymentAmount = $paymentAmount;

        return $this;
    }

    /**
     * Get paymentAmount
     *
     * @return string
     */
    public function getPaymentAmount()
    {
        return $this->paymentAmount;
    }

    /**
     * Set paymentFee
     *
     * @param string $paymentFee
     *
     * @return Payments
     */
    public function setPaymentFee($paymentFee)
    {
        $this->paymentFee = $paymentFee;

        return $this;
    }

    /**
     * Get paymentFee
     *
     * @return string
     */
    public function getPaymentFee()
    {
        return $this->paymentFee;
    }

    /**
     * Set paymentStatus
     *
     * @param string $paymentStatus
     *
     * @return Payments
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    /**
     * Get paymentStatus
     *
     * @return string
     */
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    /**
     * Set itemid
     *
     * @param string $itemid
     *
     * @return Payments
     */
    public function setItemid($itemid)
    {
        $this->itemid = $itemid;

        return $this;
    }

    /**
     * Get itemid
     *
     * @return string
     */
    public function getItemid()
    {
        return $this->itemid;
    }

    /**
     * Set createdtime
     *
     * @param \DateTime $createdtime
     *
     * @return Payments
     */
    public function setCreatedtime($createdtime)
    {
        $this->createdtime = $createdtime;

        return $this;
    }

    /**
     * Get createdtime
     *
     * @return \DateTime
     */
    public function getCreatedtime()
    {
        return $this->createdtime;
    }

    /**
     * Set reason
     *
     * @param string $reason
     *
     * @return Payments
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }
}
