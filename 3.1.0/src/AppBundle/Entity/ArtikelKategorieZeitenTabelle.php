<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtikelKategorieZeitenTabelle
 *
 * @ORM\Table(name="ARTIKEL_Kategorie_Zeiten_Tabelle", indexes={@ORM\Index(name="azt_k_id", columns={"azt_k_id"})})
 * @ORM\Entity
 */
class ArtikelKategorieZeitenTabelle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="azt_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aztId;

    /**
     * @var integer
     *
     * @ORM\Column(name="azt_status", type="integer", nullable=false)
     */
    private $aztStatus = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="azt_typ", type="smallint", length=1, nullable=false)
     */
    private $aztTyp = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="azt_von", type="date", nullable=false)
     */
    private $aztVon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="azt_bis", type="date", nullable=false)
     */
    private $aztBis;

    /**
     * @var string
     *
     * @ORM\Column(name="azt_beschreibung", type="string", length=128, nullable=false)
     */
    private $aztBeschreibung;

    /**
     * @var \AppBundle\Entity\ArtikelKategorie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtikelKategorie", inversedBy="aKZeitenTabelle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="azt_k_id", referencedColumnName="a_k_id")
     * })
     */
    private $aztK;

    /**
     * @var \AppBundle\Entity\ArtikelKategorieZeiten
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ArtikelKategorieZeiten", mappedBy="azAzt")
     */
    private $aztZeiten;

    /**
     * Get aztId
     *
     * @return integer
     */
    public function getAztId()
    {
        return $this->aztId;
    }

    /**
     * Set aztStatus
     *
     * @param integer $aztStatus
     *
     * @return ArtikelKategorieZeitenTabelle
     */
    public function setAztStatus($aztStatus)
    {
        $this->aztStatus = $aztStatus;

        return $this;
    }

    /**
     * Get aztStatus
     *
     * @return integer
     */
    public function getAztStatus()
    {
        return $this->aztStatus;
    }

    /**
     * Set aztTyp
     *
     * @param integer $aztTyp
     *
     * @return ArtikelKategorieZeitenTabelle
     */
    public function setAztTyp($aztTyp)
    {
        $this->aztTyp = $aztTyp;

        return $this;
    }

    /**
     * Get aztTyp
     *
     * @return integer
     */
    public function getAztTyp()
    {
        return $this->aztTyp;
    }

    /**
     * Set aztVon
     *
     * @param \DateTime $aztVon
     *
     * @return ArtikelKategorieZeitenTabelle
     */
    public function setAztVon($aztVon)
    {
        $this->aztVon = $aztVon;

        return $this;
    }

    /**
     * Get aztVon
     *
     * @return \DateTime
     */
    public function getAztVon()
    {
        return $this->aztVon;
    }

    /**
     * Set aztBis
     *
     * @param \DateTime $aztBis
     *
     * @return ArtikelKategorieZeitenTabelle
     */
    public function setAztBis($aztBis)
    {
        $this->aztBis = $aztBis;

        return $this;
    }

    /**
     * Get aztBis
     *
     * @return \DateTime
     */
    public function getAztBis()
    {
        return $this->aztBis;
    }

    /**
     * Set aztBeschreibung
     *
     * @param string $aztBeschreibung
     *
     * @return ArtikelKategorieZeitenTabelle
     */
    public function setAztBeschreibung($aztBeschreibung)
    {
        $this->aztBeschreibung = $aztBeschreibung;

        return $this;
    }

    /**
     * Get aztBeschreibung
     *
     * @return string
     */
    public function getAztBeschreibung()
    {
        return $this->aztBeschreibung;
    }

    /**
     * Set aztK
     *
     * @param \AppBundle\Entity\ArtikelKategorie $aztK
     *
     * @return ArtikelKategorieZeitenTabelle
     */
    public function setAztK(\AppBundle\Entity\ArtikelKategorie $aztK = null)
    {
        $this->aztK = $aztK;

        return $this;
    }

    /**
     * Get aztK
     *
     * @return \AppBundle\Entity\ArtikelKategorie
     */
    public function getAztK()
    {
        return $this->aztK;
    }

    /**
     * @return ArtikelKategorieZeiten
     */
    public function getAztZeiten()
    {
        return $this->aztZeiten;
    }

    /**
     * @param ArtikelKategorieZeiten $aztZeiten
     */
    public function setAztZeiten($aztZeiten)
    {
        $this->aztZeiten = $aztZeiten;
    }


}
