<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtikelKategorieDatum
 *
 * @ORM\Table(name="ARTIKEL_Kategorie_Datum")
 * @ORM\Entity
 */
class ArtikelKategorieDatum
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ad_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $adId;

    /**
     * @var integer
     *
     * @ORM\Column(name="ad_k_id", type="integer", nullable=false)
     */
    private $adKId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ad_date", type="date", nullable=false)
     */
    private $adDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="ad_type", type="integer", nullable=false)
     */
    private $adType;



    /**
     * Get adId
     *
     * @return integer
     */
    public function getAdId()
    {
        return $this->adId;
    }

    /**
     * Set adKId
     *
     * @param integer $adKId
     *
     * @return ArtikelKategorieDatum
     */
    public function setAdKId($adKId)
    {
        $this->adKId = $adKId;

        return $this;
    }

    /**
     * Get adKId
     *
     * @return integer
     */
    public function getAdKId()
    {
        return $this->adKId;
    }

    /**
     * Set adDate
     *
     * @param \DateTime $adDate
     *
     * @return ArtikelKategorieDatum
     */
    public function setAdDate($adDate)
    {
        $this->adDate = $adDate;

        return $this;
    }

    /**
     * Get adDate
     *
     * @return \DateTime
     */
    public function getAdDate()
    {
        return $this->adDate;
    }

    /**
     * Set adType
     *
     * @param integer $adType
     *
     * @return ArtikelKategorieDatum
     */
    public function setAdType($adType)
    {
        $this->adType = $adType;

        return $this;
    }

    /**
     * Get adType
     *
     * @return integer
     */
    public function getAdType()
    {
        return $this->adType;
    }
}
