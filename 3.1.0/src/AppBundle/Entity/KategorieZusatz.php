<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KategorieZusatz
 *
 * @ORM\Table(name="KATEGORIE_Zusatz")
 * @ORM\Entity
 */
class KategorieZusatz
{
    /**
     * @var integer
     *
     * @ORM\Column(name="akz_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $akzId;

    /**
     * @var string
     *
     * @ORM\Column(name="akz_lang", type="string", length=6, nullable=false)
     */
    private $akzLang;

    /**
     * @var string
     *
     * @ORM\Column(name="akz_beschreibung", type="string", length=64, nullable=false)
     */
    private $akzBeschreibung;

    /**
     * @var string
     *
     * @ORM\Column(name="akz_text", type="string", length=256, nullable=false)
     */
    private $akzText;



    /**
     * Get akzId
     *
     * @return integer
     */
    public function getAkzId()
    {
        return $this->akzId;
    }

    /**
     * Set akzLang
     *
     * @param string $akzLang
     *
     * @return KategorieZusatz
     */
    public function setAkzLang($akzLang)
    {
        $this->akzLang = $akzLang;

        return $this;
    }

    /**
     * Get akzLang
     *
     * @return string
     */
    public function getAkzLang()
    {
        return $this->akzLang;
    }

    /**
     * @return string
     */
    public function getAkzBeschreibung()
    {
        return $this->akzBeschreibung;
    }

    /**
     * @param string $akzBeschreibung
     */
    public function setAkzBeschreibung($akzBeschreibung)
    {
        $this->akzBeschreibung = $akzBeschreibung;
    }

    /**
     * Set akzText
     *
     * @param string $akzText
     *
     * @return KategorieZusatz
     */
    public function setAkzText($akzText)
    {
        $this->akzText = $akzText;

        return $this;
    }

    /**
     * Get akzText
     *
     * @return string
     */
    public function getAkzText()
    {
        return $this->akzText;
    }
}
