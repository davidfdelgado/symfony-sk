<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgenturChatBetreff
 *
 * @ORM\Table(name="AGENTUR_Chat_Betreff", uniqueConstraints={@ORM\UniqueConstraint(name="ab_typ", columns={"ab_typ", "ab_betreff", "ab_from", "ab_to"})}, indexes={@ORM\Index(name="ab_uid", columns={"ab_from"})})
 * @ORM\Entity
 */
class AgenturChatBetreff
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ab_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $abId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ab_typ", type="boolean", nullable=false)
     */
    private $abTyp = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ab_created", type="datetime", nullable=false)
     */
    private $abCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="ab_betreff", type="string", length=64, nullable=false)
     */
    private $abBetreff;

    /**
     * @var integer
     *
     * @ORM\Column(name="ab_from", type="integer", nullable=false)
     */
    private $abFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="ab_to", type="integer", nullable=false)
     */
    private $abTo;



    /**
     * Get abId
     *
     * @return integer
     */
    public function getAbId()
    {
        return $this->abId;
    }

    /**
     * Set abTyp
     *
     * @param boolean $abTyp
     *
     * @return AgenturChatBetreff
     */
    public function setAbTyp($abTyp)
    {
        $this->abTyp = $abTyp;

        return $this;
    }

    /**
     * Get abTyp
     *
     * @return boolean
     */
    public function getAbTyp()
    {
        return $this->abTyp;
    }

    /**
     * Set abCreated
     *
     * @param \DateTime $abCreated
     *
     * @return AgenturChatBetreff
     */
    public function setAbCreated($abCreated)
    {
        $this->abCreated = $abCreated;

        return $this;
    }

    /**
     * Get abCreated
     *
     * @return \DateTime
     */
    public function getAbCreated()
    {
        return $this->abCreated;
    }

    /**
     * Set abBetreff
     *
     * @param string $abBetreff
     *
     * @return AgenturChatBetreff
     */
    public function setAbBetreff($abBetreff)
    {
        $this->abBetreff = $abBetreff;

        return $this;
    }

    /**
     * Get abBetreff
     *
     * @return string
     */
    public function getAbBetreff()
    {
        return $this->abBetreff;
    }

    /**
     * Set abFrom
     *
     * @param integer $abFrom
     *
     * @return AgenturChatBetreff
     */
    public function setAbFrom($abFrom)
    {
        $this->abFrom = $abFrom;

        return $this;
    }

    /**
     * Get abFrom
     *
     * @return integer
     */
    public function getAbFrom()
    {
        return $this->abFrom;
    }

    /**
     * Set abTo
     *
     * @param integer $abTo
     *
     * @return AgenturChatBetreff
     */
    public function setAbTo($abTo)
    {
        $this->abTo = $abTo;

        return $this;
    }

    /**
     * Get abTo
     *
     * @return integer
     */
    public function getAbTo()
    {
        return $this->abTo;
    }
}
