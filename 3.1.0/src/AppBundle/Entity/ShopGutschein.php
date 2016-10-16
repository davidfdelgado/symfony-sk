<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopGutschein
 *
 * @ORM\Table(name="SHOP_Gutschein", uniqueConstraints={@ORM\UniqueConstraint(name="gu_nr", columns={"gu_nr"})})
 * @ORM\Entity
 */
class ShopGutschein
{
    /**
     * @var integer
     *
     * @ORM\Column(name="gu_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $guId;

    /**
     * @var string
     *
     * @ORM\Column(name="gu_nr", type="string", length=32, nullable=false)
     */
    private $guNr;

    /**
     * @var string
     *
     * @ORM\Column(name="gu_wert", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $guWert;

    /**
     * @var string
     *
     * @ORM\Column(name="gu_wert_ist", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $guWertIst = '0.00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="gu_created", type="datetime", nullable=false)
     */
    private $guCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="gu_typ", type="integer", nullable=false)
     */
    private $guTyp;

    /**
     * @var string
     *
     * @ORM\Column(name="gu_session", type="string", length=50, nullable=false)
     */
    private $guSession;



    /**
     * Get guId
     *
     * @return integer
     */
    public function getGuId()
    {
        return $this->guId;
    }

    /**
     * Set guNr
     *
     * @param string $guNr
     *
     * @return ShopGutschein
     */
    public function setGuNr($guNr)
    {
        $this->guNr = $guNr;

        return $this;
    }

    /**
     * Get guNr
     *
     * @return string
     */
    public function getGuNr()
    {
        return $this->guNr;
    }

    /**
     * Set guWert
     *
     * @param string $guWert
     *
     * @return ShopGutschein
     */
    public function setGuWert($guWert)
    {
        $this->guWert = $guWert;

        return $this;
    }

    /**
     * Get guWert
     *
     * @return string
     */
    public function getGuWert()
    {
        return $this->guWert;
    }

    /**
     * Set guWertIst
     *
     * @param string $guWertIst
     *
     * @return ShopGutschein
     */
    public function setGuWertIst($guWertIst)
    {
        $this->guWertIst = $guWertIst;

        return $this;
    }

    /**
     * Get guWertIst
     *
     * @return string
     */
    public function getGuWertIst()
    {
        return $this->guWertIst;
    }

    /**
     * Set guCreated
     *
     * @param \DateTime $guCreated
     *
     * @return ShopGutschein
     */
    public function setGuCreated($guCreated)
    {
        $this->guCreated = $guCreated;

        return $this;
    }

    /**
     * Get guCreated
     *
     * @return \DateTime
     */
    public function getGuCreated()
    {
        return $this->guCreated;
    }

    /**
     * Set guTyp
     *
     * @param integer $guTyp
     *
     * @return ShopGutschein
     */
    public function setGuTyp($guTyp)
    {
        $this->guTyp = $guTyp;

        return $this;
    }

    /**
     * Get guTyp
     *
     * @return integer
     */
    public function getGuTyp()
    {
        return $this->guTyp;
    }

    /**
     * Set guSession
     *
     * @param string $guSession
     *
     * @return ShopGutschein
     */
    public function setGuSession($guSession)
    {
        $this->guSession = $guSession;

        return $this;
    }

    /**
     * Get guSession
     *
     * @return string
     */
    public function getGuSession()
    {
        return $this->guSession;
    }
}
