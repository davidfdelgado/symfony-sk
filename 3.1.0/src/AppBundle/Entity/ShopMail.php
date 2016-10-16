<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopMail
 *
 * @ORM\Table(name="SHOP_Mail")
 * @ORM\Entity
 */
class ShopMail
{
    /**
     * @var integer
     *
     * @ORM\Column(name="m_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $mId;

    /**
     * @var string
     *
     * @ORM\Column(name="m_rnnr", type="string", length=32, nullable=false)
     */
    private $mRnnr;

    /**
     * @var string
     *
     * @ORM\Column(name="m_to", type="string", length=64, nullable=false)
     */
    private $mTo;

    /**
     * @var string
     *
     * @ORM\Column(name="m_betreff", type="string", length=48, nullable=false)
     */
    private $mBetreff;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="m_created", type="datetime", nullable=false)
     */
    private $mCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="m_user", type="integer", nullable=false)
     */
    private $mUser;

    /**
     * @var string
     *
     * @ORM\Column(name="m_session", type="string", length=32, nullable=false)
     */
    private $mSession;



    /**
     * Get mId
     *
     * @return integer
     */
    public function getMId()
    {
        return $this->mId;
    }

    /**
     * Set mRnnr
     *
     * @param string $mRnnr
     *
     * @return ShopMail
     */
    public function setMRnnr($mRnnr)
    {
        $this->mRnnr = $mRnnr;

        return $this;
    }

    /**
     * Get mRnnr
     *
     * @return string
     */
    public function getMRnnr()
    {
        return $this->mRnnr;
    }

    /**
     * Set mTo
     *
     * @param string $mTo
     *
     * @return ShopMail
     */
    public function setMTo($mTo)
    {
        $this->mTo = $mTo;

        return $this;
    }

    /**
     * Get mTo
     *
     * @return string
     */
    public function getMTo()
    {
        return $this->mTo;
    }

    /**
     * Set mBetreff
     *
     * @param string $mBetreff
     *
     * @return ShopMail
     */
    public function setMBetreff($mBetreff)
    {
        $this->mBetreff = $mBetreff;

        return $this;
    }

    /**
     * Get mBetreff
     *
     * @return string
     */
    public function getMBetreff()
    {
        return $this->mBetreff;
    }

    /**
     * Set mCreated
     *
     * @param \DateTime $mCreated
     *
     * @return ShopMail
     */
    public function setMCreated($mCreated)
    {
        $this->mCreated = $mCreated;

        return $this;
    }

    /**
     * Get mCreated
     *
     * @return \DateTime
     */
    public function getMCreated()
    {
        return $this->mCreated;
    }

    /**
     * Set mUser
     *
     * @param integer $mUser
     *
     * @return ShopMail
     */
    public function setMUser($mUser)
    {
        $this->mUser = $mUser;

        return $this;
    }

    /**
     * Get mUser
     *
     * @return integer
     */
    public function getMUser()
    {
        return $this->mUser;
    }

    /**
     * Set mSession
     *
     * @param string $mSession
     *
     * @return ShopMail
     */
    public function setMSession($mSession)
    {
        $this->mSession = $mSession;

        return $this;
    }

    /**
     * Get mSession
     *
     * @return string
     */
    public function getMSession()
    {
        return $this->mSession;
    }
}
