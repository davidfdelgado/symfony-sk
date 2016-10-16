<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtikelKombiH
 *
 * @ORM\Table(name="ARTIKEL_Kombi_h", uniqueConstraints={@ORM\UniqueConstraint(name="akk_id", columns={"akk_id"})})
 * @ORM\Entity
 */
class ArtikelKombiH
{
    /**
     * @var integer
     *
     * @ORM\Column(name="akk_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $akkId;

    /**
     * @var integer
     *
     * @ORM\Column(name="akk_kid", type="integer", nullable=false)
     */
    private $akkKid;

    /**
     * @var integer
     *
     * @ORM\Column(name="akk_rid", type="integer", nullable=false)
     */
    private $akkRid;



    /**
     * Get akkId
     *
     * @return integer
     */
    public function getAkkId()
    {
        return $this->akkId;
    }

    /**
     * Set akkKid
     *
     * @param integer $akkKid
     *
     * @return ArtikelKombiH
     */
    public function setAkkKid($akkKid)
    {
        $this->akkKid = $akkKid;

        return $this;
    }

    /**
     * Get akkKid
     *
     * @return integer
     */
    public function getAkkKid()
    {
        return $this->akkKid;
    }

    /**
     * Set akkRid
     *
     * @param integer $akkRid
     *
     * @return ArtikelKombiH
     */
    public function setAkkRid($akkRid)
    {
        $this->akkRid = $akkRid;

        return $this;
    }

    /**
     * Get akkRid
     *
     * @return integer
     */
    public function getAkkRid()
    {
        return $this->akkRid;
    }
}
