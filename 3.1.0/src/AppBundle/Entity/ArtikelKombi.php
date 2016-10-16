<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtikelKombi
 *
 * @ORM\Table(name="ARTIKEL_Kombi", uniqueConstraints={@ORM\UniqueConstraint(name="duplicates", columns={"ak_oid", "ak_kid"})})
 * @ORM\Entity
 */
class ArtikelKombi
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ak_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $akId;

    /**
     * @var integer
     *
     * @ORM\Column(name="ak_oid", type="integer", nullable=false)
     */
    private $akOid;

    /**
     * @var integer
     *
     * @ORM\Column(name="ak_kid", type="integer", nullable=false)
     */
    private $akKid;

    /**
     * @var string
     *
     * @ORM\Column(name="ak_rabatt", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $akRabatt;

    /**
     * @var string
     *
     * @ORM\Column(name="ak_min", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $akMin;

    /**
     * @var string
     *
     * @ORM\Column(name="ak_max", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $akMax;



    /**
     * Get akId
     *
     * @return integer
     */
    public function getAkId()
    {
        return $this->akId;
    }

    /**
     * Set akOid
     *
     * @param integer $akOid
     *
     * @return ArtikelKombi
     */
    public function setAkOid($akOid)
    {
        $this->akOid = $akOid;

        return $this;
    }

    /**
     * Get akOid
     *
     * @return integer
     */
    public function getAkOid()
    {
        return $this->akOid;
    }

    /**
     * Set akKid
     *
     * @param integer $akKid
     *
     * @return ArtikelKombi
     */
    public function setAkKid($akKid)
    {
        $this->akKid = $akKid;

        return $this;
    }

    /**
     * Get akKid
     *
     * @return integer
     */
    public function getAkKid()
    {
        return $this->akKid;
    }

    /**
     * Set akRabatt
     *
     * @param string $akRabatt
     *
     * @return ArtikelKombi
     */
    public function setAkRabatt($akRabatt)
    {
        $this->akRabatt = $akRabatt;

        return $this;
    }

    /**
     * Get akRabatt
     *
     * @return string
     */
    public function getAkRabatt()
    {
        return $this->akRabatt;
    }

    /**
     * Set akMin
     *
     * @param string $akMin
     *
     * @return ArtikelKombi
     */
    public function setAkMin($akMin)
    {
        $this->akMin = $akMin;

        return $this;
    }

    /**
     * Get akMin
     *
     * @return string
     */
    public function getAkMin()
    {
        return $this->akMin;
    }

    /**
     * Set akMax
     *
     * @param string $akMax
     *
     * @return ArtikelKombi
     */
    public function setAkMax($akMax)
    {
        $this->akMax = $akMax;

        return $this;
    }

    /**
     * Get akMax
     *
     * @return string
     */
    public function getAkMax()
    {
        return $this->akMax;
    }
}
