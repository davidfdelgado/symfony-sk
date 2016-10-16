<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtikelKategorieZeiten
 *
 * @ORM\Table(name="ARTIKEL_Kategorie_Zeiten", uniqueConstraints={@ORM\UniqueConstraint(name="az_k_id_2", columns={"az_azt_id", "az_day", "az_time"})}, indexes={@ORM\Index(name="az_k_id", columns={"az_azt_id"})})
 * @ORM\Entity
 */
class ArtikelKategorieZeiten
{
    /**
     * @var integer
     *
     * @ORM\Column(name="az_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $azId;

    /**
     * @var integer
     *
     * @ORM\Column(name="az_typ", type="smallint", nullable=false)
     */
    private $azTyp = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="az_status", type="boolean", nullable=false)
     */
    private $azStatus;

    /**
     * @var boolean
     *
     * @ORM\Column(name="az_day", type="smallint", length=1, nullable=false)
     */
    private $azDay;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="az_time", type="time", nullable=false)
     */
    private $azTime;

    /**
     * @var string
     *
     * @ORM\Column(name="az_zusatz", type="string", length=128, nullable=true)
     */
    private $azZusatz;

    /**
     * @var \AppBundle\Entity\ArtikelKategorieZeitenTabelle
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtikelKategorieZeitenTabelle", inversedBy="aztZeiten")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="az_azt_id", referencedColumnName="azt_id")
     * })
     */
    private $azAzt;


    /**
     * Get azId
     *
     * @return integer
     */
    public function getAzId()
    {
        return $this->azId;
    }

    /**
     * Set azTyp
     *
     * @param integer $azTyp
     *
     * @return ArtikelKategorieZeiten
     */
    public function setAzTyp($azTyp)
    {
        $this->azTyp = $azTyp;

        return $this;
    }

    /**
     * Get azTyp
     *
     * @return integer
     */
    public function getAzTyp()
    {
        return $this->azTyp;
    }

    /**
     * Set azStatus
     *
     * @param boolean $azStatus
     *
     * @return ArtikelKategorieZeiten
     */
    public function setAzStatus($azStatus)
    {
        $this->azStatus = $azStatus;

        return $this;
    }

    /**
     * Get azStatus
     *
     * @return boolean
     */
    public function getAzStatus()
    {
        return $this->azStatus;
    }

    /**
     * Set azDay
     *
     * @param integer $azDay
     *
     * @return ArtikelKategorieZeiten
     */
    public function setAzDay($azDay)
    {
        $this->azDay = $azDay;

        return $this;
    }

    /**
     * Get azDay
     *
     * @return integer
     */
    public function getAzDay()
    {
        return $this->azDay;
    }

    /**
     * Set azTime
     *
     * @param \DateTime $azTime
     *
     * @return ArtikelKategorieZeiten
     */
    public function setAzTime($azTime)
    {
        $this->azTime = $azTime;

        return $this;
    }

    /**
     * Get azTime
     *
     * @return \DateTime
     */
    public function getAzTime()
    {
        return $this->azTime;
    }

    /**
     * Set azZusatz
     *
     * @param string $azZusatz
     *
     * @return ArtikelKategorieZeiten
     */
    public function setAzZusatz($azZusatz)
    {
        $this->azZusatz = $azZusatz;

        return $this;
    }

    /**
     * Get azZusatz
     *
     * @return string
     */
    public function getAzZusatz()
    {
        return $this->azZusatz;
    }

    /**
     * Set azAzt
     *
     * @param \AppBundle\Entity\ArtikelKategorieZeitenTabelle $azAzt
     *
     * @return ArtikelKategorieZeiten
     */
    public function setAzAzt(\AppBundle\Entity\ArtikelKategorieZeitenTabelle $azAzt = null)
    {
        $this->azAzt = $azAzt;

        return $this;
    }

    /**
     * Get azAzt
     *
     * @return \AppBundle\Entity\ArtikelKategorieZeitenTabelle
     */
    public function getAzAzt()
    {
        return $this->azAzt;
    }
}
