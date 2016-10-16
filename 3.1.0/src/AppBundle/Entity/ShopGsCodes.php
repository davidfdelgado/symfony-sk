<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopGsCodes
 *
 * @ORM\Table(name="SHOP_GS_Codes", uniqueConstraints={@ORM\UniqueConstraint(name="gs_n_code", columns={"gs_n_code"})}, indexes={@ORM\Index(name="gs_n_fid", columns={"gs_n_fid"}), @ORM\Index(name="gs_n_fid_2", columns={"gs_n_fid"})})
 * @ORM\Entity
 */
class ShopGsCodes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="gs_n_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $gsNId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gs_n_status", type="boolean", nullable=false)
     */
    private $gsNStatus = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="gs_n_typ", type="boolean", nullable=false)
     */
    private $gsNTyp = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="gs_n_code", type="string", length=16, nullable=false)
     */
    private $gsNCode;

    /**
     * @var string
     *
     * @ORM\Column(name="gs_n_beschreibung", type="string", length=128, nullable=false)
     */
    private $gsNBeschreibung;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="gs_n_created", type="datetime", nullable=false)
     */
    private $gsNCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="gs_n_gueltig_bis", type="datetime", nullable=true)
     */
    private $gsNGueltigBis;

    /**
     * @var \AppBundle\Entity\ShopGsFunktion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopGsFunktion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gs_n_fid", referencedColumnName="gs_f_id")
     * })
     */
    private $gsNFid;



    /**
     * Get gsNId
     *
     * @return integer
     */
    public function getGsNId()
    {
        return $this->gsNId;
    }

    /**
     * Set gsNStatus
     *
     * @param boolean $gsNStatus
     *
     * @return ShopGsCodes
     */
    public function setGsNStatus($gsNStatus)
    {
        $this->gsNStatus = $gsNStatus;

        return $this;
    }

    /**
     * Get gsNStatus
     *
     * @return boolean
     */
    public function getGsNStatus()
    {
        return $this->gsNStatus;
    }

    /**
     * Set gsNTyp
     *
     * @param boolean $gsNTyp
     *
     * @return ShopGsCodes
     */
    public function setGsNTyp($gsNTyp)
    {
        $this->gsNTyp = $gsNTyp;

        return $this;
    }

    /**
     * Get gsNTyp
     *
     * @return boolean
     */
    public function getGsNTyp()
    {
        return $this->gsNTyp;
    }

    /**
     * Set gsNCode
     *
     * @param string $gsNCode
     *
     * @return ShopGsCodes
     */
    public function setGsNCode($gsNCode)
    {
        $this->gsNCode = $gsNCode;

        return $this;
    }

    /**
     * Get gsNCode
     *
     * @return string
     */
    public function getGsNCode()
    {
        return $this->gsNCode;
    }

    /**
     * Set gsNBeschreibung
     *
     * @param string $gsNBeschreibung
     *
     * @return ShopGsCodes
     */
    public function setGsNBeschreibung($gsNBeschreibung)
    {
        $this->gsNBeschreibung = $gsNBeschreibung;

        return $this;
    }

    /**
     * Get gsNBeschreibung
     *
     * @return string
     */
    public function getGsNBeschreibung()
    {
        return $this->gsNBeschreibung;
    }

    /**
     * Set gsNCreated
     *
     * @param \DateTime $gsNCreated
     *
     * @return ShopGsCodes
     */
    public function setGsNCreated($gsNCreated)
    {
        $this->gsNCreated = $gsNCreated;

        return $this;
    }

    /**
     * Get gsNCreated
     *
     * @return \DateTime
     */
    public function getGsNCreated()
    {
        return $this->gsNCreated;
    }

    /**
     * Set gsNGueltigBis
     *
     * @param \DateTime $gsNGueltigBis
     *
     * @return ShopGsCodes
     */
    public function setGsNGueltigBis($gsNGueltigBis)
    {
        $this->gsNGueltigBis = $gsNGueltigBis;

        return $this;
    }

    /**
     * Get gsNGueltigBis
     *
     * @return \DateTime
     */
    public function getGsNGueltigBis()
    {
        return $this->gsNGueltigBis;
    }

    /**
     * Set gsNFid
     *
     * @param \AppBundle\Entity\ShopGsFunktion $gsNFid
     *
     * @return ShopGsCodes
     */
    public function setGsNFid(\AppBundle\Entity\ShopGsFunktion $gsNFid = null)
    {
        $this->gsNFid = $gsNFid;

        return $this;
    }

    /**
     * Get gsNFid
     *
     * @return \AppBundle\Entity\ShopGsFunktion
     */
    public function getGsNFid()
    {
        return $this->gsNFid;
    }
}
