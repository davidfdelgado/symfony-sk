<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgenturChat
 *
 * @ORM\Table(name="AGENTUR_Chat", uniqueConstraints={@ORM\UniqueConstraint(name="ac_from", columns={"ac_from", "ac_to", "ac_message"})}, indexes={@ORM\Index(name="ac_bid", columns={"ac_bid"}), @ORM\Index(name="IDX_FECC6DAF1CD0C3AD", columns={"ac_from"})})
 * @ORM\Entity
 */
class AgenturChat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ac_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $acId;

    /**
     * @var integer
     *
     * @ORM\Column(name="ac_typ", type="integer", nullable=false)
     */
    private $acTyp = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ac_status", type="integer", nullable=false)
     */
    private $acStatus = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ac_to", type="integer", nullable=false)
     */
    private $acTo;

    /**
     * @var string
     *
     * @ORM\Column(name="ac_message", type="string", length=512, nullable=false)
     */
    private $acMessage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ac_created", type="datetime", nullable=false)
     */
    private $acCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var \AppBundle\Entity\AgenturUser
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgenturUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ac_from", referencedColumnName="au_id")
     * })
     */
    private $acFrom;

    /**
     * @var \AppBundle\Entity\AgenturChatBetreff
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgenturChatBetreff")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ac_bid", referencedColumnName="ab_id")
     * })
     */
    private $acBid;



    /**
     * Get acId
     *
     * @return integer
     */
    public function getAcId()
    {
        return $this->acId;
    }

    /**
     * Set acTyp
     *
     * @param integer $acTyp
     *
     * @return AgenturChat
     */
    public function setAcTyp($acTyp)
    {
        $this->acTyp = $acTyp;

        return $this;
    }

    /**
     * Get acTyp
     *
     * @return integer
     */
    public function getAcTyp()
    {
        return $this->acTyp;
    }

    /**
     * Set acStatus
     *
     * @param integer $acStatus
     *
     * @return AgenturChat
     */
    public function setAcStatus($acStatus)
    {
        $this->acStatus = $acStatus;

        return $this;
    }

    /**
     * Get acStatus
     *
     * @return integer
     */
    public function getAcStatus()
    {
        return $this->acStatus;
    }

    /**
     * Set acTo
     *
     * @param integer $acTo
     *
     * @return AgenturChat
     */
    public function setAcTo($acTo)
    {
        $this->acTo = $acTo;

        return $this;
    }

    /**
     * Get acTo
     *
     * @return integer
     */
    public function getAcTo()
    {
        return $this->acTo;
    }

    /**
     * Set acMessage
     *
     * @param string $acMessage
     *
     * @return AgenturChat
     */
    public function setAcMessage($acMessage)
    {
        $this->acMessage = $acMessage;

        return $this;
    }

    /**
     * Get acMessage
     *
     * @return string
     */
    public function getAcMessage()
    {
        return $this->acMessage;
    }

    /**
     * Set acCreated
     *
     * @param \DateTime $acCreated
     *
     * @return AgenturChat
     */
    public function setAcCreated($acCreated)
    {
        $this->acCreated = $acCreated;

        return $this;
    }

    /**
     * Get acCreated
     *
     * @return \DateTime
     */
    public function getAcCreated()
    {
        return $this->acCreated;
    }

    /**
     * Set acFrom
     *
     * @param \AppBundle\Entity\AgenturUser $acFrom
     *
     * @return AgenturChat
     */
    public function setAcFrom(\AppBundle\Entity\AgenturUser $acFrom = null)
    {
        $this->acFrom = $acFrom;

        return $this;
    }

    /**
     * Get acFrom
     *
     * @return \AppBundle\Entity\AgenturUser
     */
    public function getAcFrom()
    {
        return $this->acFrom;
    }

    /**
     * Set acBid
     *
     * @param \AppBundle\Entity\AgenturChatBetreff $acBid
     *
     * @return AgenturChat
     */
    public function setAcBid(\AppBundle\Entity\AgenturChatBetreff $acBid = null)
    {
        $this->acBid = $acBid;

        return $this;
    }

    /**
     * Get acBid
     *
     * @return \AppBundle\Entity\AgenturChatBetreff
     */
    public function getAcBid()
    {
        return $this->acBid;
    }
}
