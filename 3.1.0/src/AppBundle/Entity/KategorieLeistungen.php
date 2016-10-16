<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KategorieLeistungen
 *
 * @ORM\Table(name="KATEGORIE_Leistungen")
 * @ORM\Entity
 */
class KategorieLeistungen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="kl_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $klId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="kl_status", type="boolean", nullable=false)
     */
    private $klStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="kl_beschreibung", type="string", length=64, nullable=false)
     */
    private $klBeschreibung;

    /**
     * @var string
     *
     * @ORM\Column(name="kl_class", type="string", length=32, nullable=false)
     */
    private $klClass;

    private $klLabel;

    /**
     * Get klId
     *
     * @return integer
     */
    public function getKlId()
    {
        return $this->klId;
    }

    /**
     * Set klStatus
     *
     * @param boolean $klStatus
     *
     * @return KategorieLeistungen
     */
    public function setKlStatus($klStatus)
    {
        $this->klStatus = $klStatus;

        return $this;
    }

    /**
     * Get klStatus
     *
     * @return boolean
     */
    public function getKlStatus()
    {
        return $this->klStatus;
    }

    /**
     * Set klBeschreibung
     *
     * @param string $klBeschreibung
     *
     * @return KategorieLeistungen
     */
    public function setKlBeschreibung($klBeschreibung)
    {
        $this->klBeschreibung = $klBeschreibung;

        return $this;
    }

    /**
     * Get klBeschreibung
     *
     * @return string
     */
    public function getKlBeschreibung()
    {
        return $this->klBeschreibung;
    }

    /**
     * Set klClass
     *
     * @param string $klClass
     *
     * @return KategorieLeistungen
     */
    public function setKlClass($klClass)
    {
        $this->klClass = $klClass;

        return $this;
    }

    /**
     * Get klClass
     *
     * @return string
     */
    public function getKlClass()
    {
        return $this->klClass;
    }

    /**
     * @return mixed
     */
    public function getKlLabel()
    {
        $label = $this->klBeschreibung." - ".$this->klClass;

        return $label;
    }


}
