<?php

namespace AppBundle\Entity;

use AppBundle\AppBundle;
use Doctrine\ORM\Mapping as ORM;

/**
 * ShopWarenkorb
 *
 * @ORM\Table(name="SHOP_Warenkorb", uniqueConstraints={@ORM\UniqueConstraint(name="wc_id", columns={"wc_id"})},indexes={@ORM\Index(name="wc_s_id", columns={"wc_s_id"}), @ORM\Index(name="wc_artikelnummer", columns={"wc_artikelnummer"})})
 * @ORM\Entity
 */
class ShopWarenkorb
{
    /**
     * @var integer
     *
     * @ORM\Column(name="wc_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $wcId;

    /**
     * @var \AppBundle\Entity\ShopSession
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopSession", inversedBy="sWarenkorb")
     * @ORM\JoinColumn(name="wc_s_id", referencedColumnName="s_id", nullable=false)
     */
    private $wcSId;

    /**
     * @var \AppBundle\Entity\ShopPositionArtikelnummern
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopPositionArtikelnummern")
     * @ORM\JoinColumn(name="wc_artikelnummer", referencedColumnName="pk_artikelnummer", nullable=true)
     */
    private $wcArtikelnummer;

    /**
     * @var \AppBundle\Entity\Artikel
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Artikel")
     * @ORM\JoinColumn(name="wc_aid", referencedColumnName="a_id", nullable=false)
     */
    private $wcAid;

    /**
     * @var string
     *
     * @ORM\Column(name="wc_name", type="string", length=100, nullable=true)
     */
    private $wcName;

    /**
     * @var string
     *
     * @ORM\Column(name="wc_name_en", type="string", length=100, nullable=false)
     */
    private $wcNameEn;

    /**
     * @var integer
     *
     * @ORM\Column(name="wc_menge", type="integer", nullable=true)
     */
    private $wcMenge;

    /**
     * @var string
     *
     * @ORM\Column(name="wc_preis", type="string", length=10, nullable=true)
     */
    private $wcPreis;

    /**
     * @var string
     *
     * @ORM\Column(name="wc_rabatt", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $wcRabatt = '0.00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="wc_datum", type="datetime", nullable=true)
     */
    private $wcDatum;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="wc_updatetime", type="datetime", nullable=false)
     */
    private $wcUpdatetime;


    public function __construct()
    {
        $this->wcUpdatetime = new \DateTime();
    }

    /**
     * @return int
     */
    public function getWcId()
    {
        return $this->wcId;
    }

    /**
     * @param int $wcId
     */
    public function setWcId($wcId)
    {
        $this->wcId = $wcId;
    }

    /**
     * @return ShopSession
     */
    public function getWcSId()
    {
        return $this->wcSId;
    }

    /**
     * @param ShopSession $wcSId
     */
    public function setWcSId($wcSId)
    {
        $this->wcSId = $wcSId;
    }

    /**
     * @return string
     */
    public function getWcArtikelnummer()
    {
        return $this->wcArtikelnummer;
    }

    /**
     * @param string $wcArtikelnummer
     */
    public function setWcArtikelnummer($wcArtikelnummer)
    {
        $this->wcArtikelnummer = $wcArtikelnummer;
    }

    /**
     * @return string
     */
    public function getWcAid()
    {
        return $this->wcAid;
    }

    /**
     * @param string $wcAid
     */
    public function setWcAid($wcAid)
    {
        $this->wcAid = $wcAid;
    }

    /**
     * @return string
     */
    public function getWcName()
    {
        return $this->wcName;
    }

    /**
     * @param string $wcName
     */
    public function setWcName($wcName)
    {
        $this->wcName = $wcName;
    }

    /**
     * @return string
     */
    public function getWcNameEn()
    {
        return $this->wcNameEn;
    }

    /**
     * @param string $wcNameEn
     */
    public function setWcNameEn($wcNameEn)
    {
        $this->wcNameEn = $wcNameEn;
    }

    /**
     * @return int
     */
    public function getWcMenge()
    {
        return $this->wcMenge;
    }

    /**
     * @param int $wcMenge
     */
    public function setWcMenge($wcMenge)
    {
        $this->wcMenge = $wcMenge;
    }

    /**
     * @return string
     */
    public function getWcPreis()
    {
        return $this->wcPreis;
    }

    /**
     * @param string $wcPreis
     */
    public function setWcPreis($wcPreis)
    {
        $this->wcPreis = $wcPreis;
    }

    /**
     * @return string
     */
    public function getWcRabatt()
    {
        return $this->wcRabatt;
    }

    /**
     * @param string $wcRabatt
     */
    public function setWcRabatt($wcRabatt)
    {
        $this->wcRabatt = $wcRabatt;
    }

    /**
     * @return \DateTime
     */
    public function getWcDatum()
    {
        return $this->wcDatum;
    }

    /**
     * @param \DateTime $wcDatum
     */
    public function setWcDatum($wcDatum)
    {
        $this->wcDatum = $wcDatum;
    }

    /**
     * @return \DateTime
     */
    public function getWcUpdatetime()
    {
        return $this->wcUpdatetime;
    }

    /**
     * @param \DateTime $wcUpdatetime
     */
    public function setWcUpdatetime($wcUpdatetime)
    {
        $this->wcUpdatetime = $wcUpdatetime;
    }

}
