<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ArtikelKategorieArt
 *
 * @ORM\Table(name="ARTIKEL_Kategorie_Art")
 * @ORM\Entity
 */
class ArtikelKategorieArt
{
    /**
     * @var integer
     *
     * @ORM\Column(name="a_a_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aAId;

    /**
     * @var integer
     *
     * @ORM\Column(name="a_a_typ", type="integer", nullable=false)
     */
    private $aATyp = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="a_a_overview", type="integer", nullable=false)
     */
    private $aAOverview = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="a_a_css_class", type="string", length=32, nullable=true)
     */
    private $aACssClass;

    /**
     * @var string
     *
     * @ORM\Column(name="a_a_icon", type="string", length=32, nullable=true)
     */
    private $aAIcon;

    /**
     * @var string
     * @Assert\NotBlank(message="Bitte tragen Sie eine kurze Beschreibung ein!")
     * @ORM\Column(name="a_a_beschreibung", type="string", length=64, nullable=false)
     */
    private $aABeschreibung;

    /**
     * @var string
     *
     * @ORM\Column(name="a_a_google_marker_image", type="string", length=128, nullable=true)
     */
    private $aAGoogleMarkerImage;

    /**
     * @var ArtikelKategorieArt
     */
    public $aAKategorien;

    /**
     * Get aAId
     *
     * @return integer
     */
    public function getAAId()
    {
        return $this->aAId;
    }

    /**
     * Set aATyp
     *
     * @param integer $aATyp
     *
     * @return ArtikelKategorieArt
     */
    public function setAATyp($aATyp)
    {
        $this->aATyp = $aATyp;

        return $this;
    }

    /**
     * Get aATyp
     *
     * @return integer
     */
    public function getAATyp()
    {
        return $this->aATyp;
    }

    /**
     * @return int
     */
    public function getAAOverview()
    {
        return $this->aAOverview;
    }

    /**
     * @param int $aAOverview
     */
    public function setAAOverview($aAOverview)
    {
        $this->aAOverview = $aAOverview;
    }

    /**
     * @return string
     */
    public function getAAIcon()
    {
        return $this->aAIcon;
    }

    /**
     * @param string $aAIcon
     */
    public function setAAIcon($aAIcon)
    {
        $this->aAIcon = $aAIcon;
    }

    
    /**
     * @return string
     */
    public function getAACssClass()
    {
        return $this->aACssClass;
    }

    /**
     * @param string $aACssClass
     */
    public function setAACssClass($aACssClass)
    {
        $this->aACssClass = $aACssClass;
    }

    /**
     * Set aABeschreibung
     *
     * @param string $aABeschreibung
     *
     * @return ArtikelKategorieArt
     */
    public function setAABeschreibung($aABeschreibung)
    {
        $this->aABeschreibung = $aABeschreibung;

        return $this;
    }

    /**
     * Get aABeschreibung
     *
     * @return string
     */
    public function getAABeschreibung()
    {
        return $this->aABeschreibung;
    }

    /**
     * Set aAGoogleMarkerImage
     *
     * @param string $aAGoogleMarkerImage
     *
     * @return ArtikelKategorieArt
     */
    public function setAAGoogleMarkerImage($aAGoogleMarkerImage)
    {
        $this->aAGoogleMarkerImage = $aAGoogleMarkerImage;

        return $this;
    }

    /**
     * Get aAGoogleMarkerImage
     *
     * @return string
     */
    public function getAAGoogleMarkerImage()
    {
        return $this->aAGoogleMarkerImage;
    }

    /**
     * @return ArtikelKategorieArt
     */
    public function getAAKategorien()
    {
        if(!$this->aAKategorien) $this->aAKategorien = new ArrayCollection();
        
        return $this->aAKategorien;
    }

    /**
     * @param ArtikelKategorieArt $aAKategorien
     */
    public function setAAKategorien($aAKategorien)
    {
        $this->aAKategorien = $aAKategorien;
    }

}
