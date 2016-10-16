<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgenturProvisionsTabelle
 *
 * @ORM\Table(name="AGENTUR_Provisions_Tabelle", uniqueConstraints={@ORM\UniqueConstraint(name="KategorieProAG", columns={"ap_av_id", "ap_ak_id"})},  indexes={@ORM\Index(name="ap_au_id", columns={"ap_av_id", "ap_ak_id"}), @ORM\Index(name="ap_ak_id", columns={"ap_ak_id"}), @ORM\Index(name="IDX_F0A176361BD5A8DA", columns={"ap_av_id"})})
 * @ORM\Entity
 */
class AgenturProvisionsTabelle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ap_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $apId;

    /**
     * @var string
     *
     * @ORM\Column(name="ap_prov_a", type="decimal", precision=7, scale=3, nullable=false)
     */
    private $apProvA = '0.000';

    /**
     * @var string
     *
     * @ORM\Column(name="ap_prov_b", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $apProvB = '0.00';

    /**
     * @var \AppBundle\Entity\AgenturVertrieb
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgenturVertrieb")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ap_av_id", referencedColumnName="av_id")
     * })
     */
    private $apAv;

    /**
     * @var \AppBundle\Entity\ArtikelKategorie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtikelKategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ap_ak_id", referencedColumnName="a_k_id")
     * })
     */
    private $apAk;



    /**
     * Get apId
     *
     * @return integer
     */
    public function getApId()
    {
        return $this->apId;
    }

    /**
     * Set apProvA
     *
     * @param string $apProvA
     *
     * @return AgenturProvisionsTabelle
     */
    public function setApProvA($apProvA)
    {
        $this->apProvA = $apProvA;

        return $this;
    }

    /**
     * Get apProvA
     *
     * @return string
     */
    public function getApProvA()
    {
        return $this->apProvA;
    }

    /**
     * Set apProvB
     *
     * @param string $apProvB
     *
     * @return AgenturProvisionsTabelle
     */
    public function setApProvB($apProvB)
    {
        $this->apProvB = $apProvB;

        return $this;
    }

    /**
     * Get apProvB
     *
     * @return string
     */
    public function getApProvB()
    {
        return $this->apProvB;
    }

    /**
     * Set apAv
     *
     * @param \AppBundle\Entity\AgenturVertrieb $apAv
     *
     * @return AgenturProvisionsTabelle
     */
    public function setApAv(\AppBundle\Entity\AgenturVertrieb $apAv = null)
    {
        $this->apAv = $apAv;

        return $this;
    }

    /**
     * Get apAv
     *
     * @return \AppBundle\Entity\AgenturVertrieb
     */
    public function getApAv()
    {
        return $this->apAv;
    }

    /**
     * Set apAk
     *
     * @param \AppBundle\Entity\ArtikelKategorie $apAk
     *
     * @return AgenturProvisionsTabelle
     */
    public function setApAk(\AppBundle\Entity\ArtikelKategorie $apAk = null)
    {
        $this->apAk = $apAk;

        return $this;
    }

    /**
     * Get apAk
     *
     * @return \AppBundle\Entity\ArtikelKategorie
     */
    public function getApAk()
    {
        return $this->apAk;
    }
}
