<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopBilder
 *
 * @ORM\Table(name="SHOP_Bilder")
 * @ORM\Entity
 */
class ShopBilder
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bi_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $biId;

    /**
     * @var string
     *
     * @ORM\Column(name="bi_path", type="string", length=128, nullable=true)
     */
    private $biPath;

    /**
     * @var string
     *
     * @ORM\Column(name="bi_alt", type="string", length=256, nullable=true)
     */
    private $biAlt;

    /**
     * @var string
     *
     * @ORM\Column(name="bi_title", type="string", length=256, nullable=true)
     */
    private $biTitle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bi_typ", type="boolean", nullable=false)
     */
    private $biTyp;

    /**
     * @var integer
     *
     * @ORM\Column(name="bi_oid", type="integer", nullable=false)
     */
    private $biOid;



    /**
     * Get biId
     *
     * @return integer
     */
    public function getBiId()
    {
        return $this->biId;
    }

    /**
     * Set biPath
     *
     * @param string $biPath
     *
     * @return ShopBilder
     */
    public function setBiPath($biPath)
    {
        $this->biPath = $biPath;

        return $this;
    }

    /**
     * Get biPath
     *
     * @return string
     */
    public function getBiPath()
    {
        return $this->biPath;
    }

    /**
     * Set biAlt
     *
     * @param string $biAlt
     *
     * @return ShopBilder
     */
    public function setBiAlt($biAlt)
    {
        $this->biAlt = $biAlt;

        return $this;
    }

    /**
     * Get biAlt
     *
     * @return string
     */
    public function getBiAlt()
    {
        return $this->biAlt;
    }

    /**
     * Set biTitle
     *
     * @param string $biTitle
     *
     * @return ShopBilder
     */
    public function setBiTitle($biTitle)
    {
        $this->biTitle = $biTitle;

        return $this;
    }

    /**
     * Get biTitle
     *
     * @return string
     */
    public function getBiTitle()
    {
        return $this->biTitle;
    }

    /**
     * Set biTyp
     *
     * @param boolean $biTyp
     *
     * @return ShopBilder
     */
    public function setBiTyp($biTyp)
    {
        $this->biTyp = $biTyp;

        return $this;
    }

    /**
     * Get biTyp
     *
     * @return boolean
     */
    public function getBiTyp()
    {
        return $this->biTyp;
    }

    /**
     * Set biOid
     *
     * @param integer $biOid
     *
     * @return ShopBilder
     */
    public function setBiOid($biOid)
    {
        $this->biOid = $biOid;

        return $this;
    }

    /**
     * Get biOid
     *
     * @return integer
     */
    public function getBiOid()
    {
        return $this->biOid;
    }
}
