<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtikelKategorieLeistungen
 *
 * @ORM\Table(name="ARTIKEL_Kategorie_Leistungen", indexes={@ORM\Index(name="akl_kl_id", columns={"akl_kl_id"}), @ORM\Index(name="akl_k_id", columns={"akl_k_id"})})
 * @ORM\Entity
 */
class ArtikelKategorieLeistungen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="akl_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aklId;

    /**
     * @var string
     *
     * @ORM\Column(name="akl_bezeichnung", type="string", length=64, nullable=true)
     */
    private $aklBezeichnung;

    /**
     * @var \AppBundle\Entity\ArtikelKategorie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtikelKategorie", inversedBy="aKPoints")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="akl_k_id", referencedColumnName="a_k_id")
     * })
     */
    private $aklK;

    /**
     * @var \AppBundle\Entity\KategorieLeistungen
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\KategorieLeistungen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="akl_kl_id", referencedColumnName="kl_id")
     * })
     */
    private $aklKl;



    /**
     * Get aklId
     *
     * @return integer
     */
    public function getAklId()
    {
        return $this->aklId;
    }

    /**
     * Set aklBezeichnung
     *
     * @param string $aklBezeichnung
     *
     * @return ArtikelKategorieLeistungen
     */
    public function setAklBezeichnung($aklBezeichnung)
    {
        $this->aklBezeichnung = $aklBezeichnung;

        return $this;
    }

    /**
     * Get aklBezeichnung
     *
     * @return string
     */
    public function getAklBezeichnung()
    {
        return $this->aklBezeichnung;
    }

    /**
     * Set aklK
     *
     * @param \AppBundle\Entity\ArtikelKategorie $aklK
     *
     * @return ArtikelKategorieLeistungen
     */
    public function setAklK(\AppBundle\Entity\ArtikelKategorie $aklK = null)
    {
        $this->aklK = $aklK;

        return $this;
    }

    /**
     * Get aklK
     *
     * @return \AppBundle\Entity\ArtikelKategorie
     */
    public function getAklK()
    {
        return $this->aklK;
    }

    /**
     * Set aklKl
     *
     * @param \AppBundle\Entity\KategorieLeistungen $aklKl
     *
     * @return ArtikelKategorieLeistungen
     */
    public function setAklKl(\AppBundle\Entity\KategorieLeistungen $aklKl = null)
    {
        $this->aklKl = $aklKl;

        return $this;
    }

    /**
     * Get aklKl
     *
     * @return \AppBundle\Entity\KategorieLeistungen
     */
    public function getAklKl()
    {
        return $this->aklKl;
    }
}
