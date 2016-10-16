<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgenturLogin
 *
 * @ORM\Table(name="AGENTUR_Login", uniqueConstraints={@ORM\UniqueConstraint(name="ag_session", columns={"ag_session"})}, indexes={@ORM\Index(name="ag_id", columns={"ag_id"})})
 * @ORM\Entity
 */
class AgenturLogin
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ag_nr", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $agNr;

    /**
     * @var string
     *
     * @ORM\Column(name="ag_session", type="string", length=32, nullable=false)
     */
    private $agSession;

    /**
     * @var string
     *
     * @ORM\Column(name="ag_ip", type="text", length=65535, nullable=true)
     */
    private $agIp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ag_expire", type="datetime", nullable=true)
     */
    private $agExpire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ag_created", type="datetime", nullable=false)
     */
    private $agCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     *
     * @ORM\Column(name="ag_type", type="boolean", nullable=false)
     */
    private $agType = '0';

    /**
     * @var \AppBundle\Entity\AgenturUser
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgenturUser", inversedBy="auLogs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ag_id", referencedColumnName="au_id")
     * })
     */
    private $ag;



    /**
     * Get agNr
     *
     * @return integer
     */
    public function getAgNr()
    {
        return $this->agNr;
    }

    /**
     * Set agSession
     *
     * @param string $agSession
     *
     * @return AgenturLogin
     */
    public function setAgSession($agSession)
    {
        $this->agSession = $agSession;

        return $this;
    }

    /**
     * Get agSession
     *
     * @return string
     */
    public function getAgSession()
    {
        return $this->agSession;
    }

    /**
     * Set agIp
     *
     * @param string $agIp
     *
     * @return AgenturLogin
     */
    public function setAgIp($agIp)
    {
        $this->agIp = $agIp;

        return $this;
    }

    /**
     * Get agIp
     *
     * @return string
     */
    public function getAgIp()
    {
        return $this->agIp;
    }

    /**
     * Set agExpire
     *
     * @param \DateTime $agExpire
     *
     * @return AgenturLogin
     */
    public function setAgExpire($agExpire)
    {
        $this->agExpire = $agExpire;

        return $this;
    }

    /**
     * Get agExpire
     *
     * @return \DateTime
     */
    public function getAgExpire()
    {
        return $this->agExpire;
    }

    /**
     * Set agCreated
     *
     * @param \DateTime $agCreated
     *
     * @return AgenturLogin
     */
    public function setAgCreated($agCreated)
    {
        $this->agCreated = $agCreated;

        return $this;
    }

    /**
     * Get agCreated
     *
     * @return \DateTime
     */
    public function getAgCreated()
    {
        return $this->agCreated;
    }

    /**
     * Set agType
     *
     * @param boolean $agType
     *
     * @return AgenturLogin
     */
    public function setAgType($agType)
    {
        $this->agType = $agType;

        return $this;
    }

    /**
     * Get agType
     *
     * @return boolean
     */
    public function getAgType()
    {
        return $this->agType;
    }

    /**
     * Set ag
     *
     * @param \AppBundle\Entity\AgenturUser $ag
     *
     * @return AgenturLogin
     */
    public function setAg(\AppBundle\Entity\AgenturUser $ag = null)
    {
        $this->ag = $ag;

        return $this;
    }

    /**
     * Get ag
     *
     * @return \AppBundle\Entity\AgenturUser
     */
    public function getAg()
    {
        return $this->ag;
    }
}
