<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtikelLinks
 *
 * @ORM\Table(name="ARTIKEL_Links", uniqueConstraints={@ORM\UniqueConstraint(name="l_links", columns={"l_links"})})
 * @ORM\Entity
 */
class ArtikelLinks
{
    /**
     * @var integer
     *
     * @ORM\Column(name="l_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $lId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="l_art", type="boolean", nullable=false)
     */
    private $lArt;

    /**
     * @var integer
     *
     * @ORM\Column(name="l_kid", type="integer", nullable=false)
     */
    private $lKid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="l_links", type="string", length=128, nullable=false)
     */
    private $lLinks;

    /**
     * @var string
     *
     * @ORM\Column(name="l_language", type="string", length=6, nullable=false)
     */
    private $lLanguage;



    /**
     * Get lId
     *
     * @return integer
     */
    public function getLId()
    {
        return $this->lId;
    }

    /**
     * Set lArt
     *
     * @param boolean $lArt
     *
     * @return ArtikelLinks
     */
    public function setLArt($lArt)
    {
        $this->lArt = $lArt;

        return $this;
    }

    /**
     * Get lArt
     *
     * @return boolean
     */
    public function getLArt()
    {
        return $this->lArt;
    }

    /**
     * Set lKid
     *
     * @param integer $lKid
     *
     * @return ArtikelLinks
     */
    public function setLKid($lKid)
    {
        $this->lKid = $lKid;

        return $this;
    }

    /**
     * Get lKid
     *
     * @return integer
     */
    public function getLKid()
    {
        return $this->lKid;
    }

    /**
     * Set lLinks
     *
     * @param string $lLinks
     *
     * @return ArtikelLinks
     */
    public function setLLinks($lLinks)
    {
        $this->lLinks = $lLinks;

        return $this;
    }

    /**
     * Get lLinks
     *
     * @return string
     */
    public function getLLinks()
    {
        return $this->lLinks;
    }

    /**
     * Set lLanguage
     *
     * @param string $lLanguage
     *
     * @return ArtikelLinks
     */
    public function setLLanguage($lLanguage)
    {
        $this->lLanguage = $lLanguage;

        return $this;
    }

    /**
     * Get lLanguage
     *
     * @return string
     */
    public function getLLanguage()
    {
        return $this->lLanguage;
    }
}
