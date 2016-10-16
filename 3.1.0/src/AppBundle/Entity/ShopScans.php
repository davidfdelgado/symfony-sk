<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopScans
 *
 * @ORM\Table(name="SHOP_Scans", uniqueConstraints={@ORM\UniqueConstraint(name="sc_b_nr", columns={"sc_b_nr", "sc_k_id"})}, indexes={@ORM\Index(name="sc_p_id", columns={"sc_b_nr"}), @ORM\Index(name="sc_au_id", columns={"sc_au_id"}), @ORM\Index(name="sc_k_id", columns={"sc_k_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ShopScansRepository")
 */
class ShopScans
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sc_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $scId;

    /**
     * @var integer
     *
     * @ORM\Column(name="sc_anzahl", type="integer", nullable=false)
     */
    private $scAnzahl = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sc_scanned", type="datetime", nullable=true)
     */
    private $scScanned = 'CURRENT_TIMESTAMP';

    /**
     * @var \AppBundle\Entity\AgenturUser
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgenturUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sc_au_id", referencedColumnName="au_id")
     * })
     */
    private $scAu;

    /**
     * @var \AppBundle\Entity\ShopBestellungen
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopBestellungen", inversedBy="bSc")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sc_b_nr", referencedColumnName="nr")
     * })
     */
    private $scBNr;

    /**
     * @var \AppBundle\Entity\ArtikelKategorie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtikelKategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sc_k_id", referencedColumnName="a_k_id")
     * })
     */
    private $scK;

    /**
     * Get scId
     *
     * @return integer
     */
    public function getScId()
    {
        return $this->scId;
    }

    /**
     * Set scAnzahl
     *
     * @param integer $scAnzahl
     *
     * @return ShopScans
     */
    public function setScAnzahl($scAnzahl)
    {
        $this->scAnzahl = $scAnzahl;

        return $this;
    }

    /**
     * Get scAnzahl
     *
     * @return integer
     */
    public function getScAnzahl()
    {
        return $this->scAnzahl;
    }

    /**
     * Set scScanned
     *
     * @param \DateTime $scScanned
     *
     * @return ShopScans
     */
    public function setScScanned($scScanned)
    {
        $this->scScanned = $scScanned;

        return $this;
    }

    /**
     * Get scScanned
     *
     * @return \DateTime
     */
    public function getScScanned()
    {
        return $this->scScanned;
    }

    /**
     * Set scAu
     *
     * @param \AppBundle\Entity\AgenturUser $scAu
     *
     * @return ShopScans
     */
    public function setScAu(\AppBundle\Entity\AgenturUser $scAu = null)
    {
        $this->scAu = $scAu;

        return $this;
    }

    /**
     * Get scAu
     *
     * @return \AppBundle\Entity\AgenturUser
     */
    public function getScAu()
    {
        return $this->scAu;
    }

    /**
     * Set scBNr
     *
     * @param \AppBundle\Entity\ShopBestellungen $scBNr
     *
     * @return ShopScans
     */
    public function setScBNr(\AppBundle\Entity\ShopBestellungen $scBNr = null)
    {
        $this->scBNr = $scBNr;

        return $this;
    }

    /**
     * Get scBNr
     *
     * @return \AppBundle\Entity\ShopBestellungen
     */
    public function getScBNr()
    {
        return $this->scBNr;
    }

    /**
     * Set scK
     *
     * @param \AppBundle\Entity\ArtikelKategorie $scK
     *
     * @return ShopScans
     */
    public function setScK(\AppBundle\Entity\ArtikelKategorie $scK = null)
    {
        $this->scK = $scK;

        return $this;
    }

    /**
     * Get scK
     *
     * @return \AppBundle\Entity\ArtikelKategorie
     */
    public function getScK()
    {
        return $this->scK;
    }
}
