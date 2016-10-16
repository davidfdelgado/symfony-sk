<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopZahlarten
 *
 * @ORM\Table(name="SHOP_Zahlarten")
 * @ORM\Entity
 */
class ShopZahlarten
{
    /**
     * @var integer
     *
     * @ORM\Column(name="zahlartenid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $zahlartenid;

    /**
     * @var string
     *
     * @ORM\Column(name="art", type="string", length=50, nullable=false)
     */
    private $art = '';

    /**
     * @var string
     *
     * @ORM\Column(name="beschreibung", type="text", length=16777215, nullable=true)
     */
    private $beschreibung;

    /**
     * @var string
     *
     * @ORM\Column(name="art_kosten", type="string", length=30, nullable=false)
     */
    private $artKosten = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="date", nullable=false)
     */
    private $datum;



    /**
     * Get zahlartenid
     *
     * @return integer
     */
    public function getZahlartenid()
    {
        return $this->zahlartenid;
    }

    /**
     * Set art
     *
     * @param string $art
     *
     * @return ShopZahlarten
     */
    public function setArt($art)
    {
        $this->art = $art;

        return $this;
    }

    /**
     * Get art
     *
     * @return string
     */
    public function getArt()
    {
        return $this->art;
    }

    /**
     * Set beschreibung
     *
     * @param string $beschreibung
     *
     * @return ShopZahlarten
     */
    public function setBeschreibung($beschreibung)
    {
        $this->beschreibung = $beschreibung;

        return $this;
    }

    /**
     * Get beschreibung
     *
     * @return string
     */
    public function getBeschreibung()
    {
        return $this->beschreibung;
    }

    /**
     * Set artKosten
     *
     * @param string $artKosten
     *
     * @return ShopZahlarten
     */
    public function setArtKosten($artKosten)
    {
        $this->artKosten = $artKosten;

        return $this;
    }

    /**
     * Get artKosten
     *
     * @return string
     */
    public function getArtKosten()
    {
        return $this->artKosten;
    }

    /**
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return ShopZahlarten
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime
     */
    public function getDatum()
    {
        return $this->datum;
    }
}
