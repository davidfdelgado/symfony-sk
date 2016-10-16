<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ArtikelOrte
 *
 * @ORM\Table(name="ARTIKEL_Orte", uniqueConstraints={@ORM\UniqueConstraint(name="a_o_name_kurz", columns={"a_o_name_kurz"})}, indexes={@ORM\Index(name="Shop_Bilder_Zu", columns={"a_o_bzid"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ArtikelOrteRepository")
 */
class ArtikelOrte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="a_o_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aOId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="a_o_status", type="boolean", nullable=false)
     */
    private $aOStatus = '1';

    /**
     * @var string
     * @Assert\NotBlank(message="Bitte Geben Sie einen Ortnamen an.")
     * @ORM\Column(name="a_o_name", type="string", length=64, nullable=false)
     */
    private $aOName;

    /**
     * @var string
     * @Assert\NotBlank(message="Bitte geben Sie einen Kürzel an.")
     * @Assert\Length(min=3, minMessage="Ihr Kürzel ist zu kurz",  max=3, maxMessage="Ihr Kürzel ist zu lang...")
     * @ORM\Column(name="a_o_name_kurz", type="string", length=12, nullable=false)
     */
    private $aONameKurz;

    /**
     * @var boolean
     *
     * @ORM\Column(name="a_o_bewerten", type="boolean", nullable=false)
     */
    private $aOBewerten = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="a_o_created", type="datetime", nullable=false)
     */
    private $aOCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgenturUser")
     * @ORM\JoinColumn(name="a_o_created_u", referencedColumnName="au_id", nullable=true)
     */
    private $aOCreatedU;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="a_o_update", type="datetime", nullable=true)
     */
    private $aOUpdate;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgenturUser")
     * @ORM\JoinColumn(name="a_o_update_u", referencedColumnName="au_id", nullable=true)
     */
    private $aOUpdateU;

    /**
     * @var \AppBundle\Entity\ShopBilderZu
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopBilderZu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="a_o_bzid", referencedColumnName="bz_id")
     * })
     */
    private $aOBzid;

    /**
     * @var \AppBundle\Entity\ArtikelKategorie
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ArtikelKategorie", mappedBy="aKOid")
     * @ORM\OrderBy({"aKId" = "ASC"})
     */
    private $aOKategorien;

    /**
     * @var \AppBundle\Entity\ArtikelKategorieArt
     */
    private $aOArten;


    public function __construct()
    {

    }

    /**
     * Get aOId
     *
     * @return integer
     */
    public function getAOId()
    {
        return $this->aOId;
    }

    /**
     * Set aOStatus
     *
     * @param boolean $aOStatus
     *
     * @return ArtikelOrte
     */
    public function setAOStatus($aOStatus)
    {
        $this->aOStatus = $aOStatus;

        return $this;
    }

    /**
     * Get aOStatus
     *
     * @return boolean
     */
    public function getAOStatus()
    {
        return $this->aOStatus;
    }

    /**
     * Set aOName
     *
     * @param string $aOName
     *
     * @return ArtikelOrte
     */
    public function setAOName($aOName)
    {
        $this->aOName = $aOName;

        return $this;
    }

    /**
     * Get aOName
     *
     * @return string
     */
    public function getAOName()
    {
        return $this->aOName;
    }

    /**
     * Set aONameKurz
     *
     * @param string $aONameKurz
     *
     * @return ArtikelOrte
     */
    public function setAONameKurz($aONameKurz)
    {
        $this->aONameKurz = strtoupper($aONameKurz);

        return $this;
    }

    /**
     * Get aONameKurz
     *
     * @return string
     */
    public function getAONameKurz()
    {
        return $this->aONameKurz;
    }

    /**
     * Set aOBewerten
     *
     * @param boolean $aOBewerten
     *
     * @return ArtikelOrte
     */
    public function setAOBewerten($aOBewerten)
    {
        $this->aOBewerten = $aOBewerten;

        return $this;
    }

    /**
     * Get aOBewerten
     *
     * @return boolean
     */
    public function getAOBewerten()
    {
        return $this->aOBewerten;
    }

    /**
     * Set aOCreated
     *
     * @param \DateTime $aOCreated
     *
     * @return ArtikelOrte
     */
    public function setAOCreated($aOCreated)
    {
        $this->aOCreated = $aOCreated;

        return $this;
    }

    /**
     * Get aOCreated
     *
     * @return \DateTime
     */
    public function getAOCreated()
    {
        return $this->aOCreated;
    }

    /**
     * Set aOCreatedU
     *
     * @param integer $aOCreatedU
     *
     * @return ArtikelOrte
     */
    public function setAOCreatedU($aOCreatedU)
    {
        $this->aOCreatedU = $aOCreatedU;

        return $this;
    }

    /**
     * Get aOCreatedU
     *
     * @return integer
     */
    public function getAOCreatedU()
    {
        return $this->aOCreatedU;
    }

    /**
     * Set aOUpdate
     *
     * @param \DateTime $aOUpdate
     *
     * @return ArtikelOrte
     */
    public function setAOUpdate($aOUpdate)
    {
        $this->aOUpdate = $aOUpdate;

        return $this;
    }

    /**
     * Get aOUpdate
     *
     * @return \DateTime
     */
    public function getAOUpdate()
    {
        return $this->aOUpdate;
    }

    /**
     * Set aOUpdateU
     *
     * @param integer $aOUpdateU
     *
     * @return ArtikelOrte
     */
    public function setAOUpdateU($aOUpdateU)
    {
        $this->aOUpdateU = $aOUpdateU;

        return $this;
    }

    /**
     * Get aOUpdateU
     *
     * @return integer
     */
    public function getAOUpdateU()
    {
        return $this->aOUpdateU;
    }

    /**
     * Set aOBzid
     *
     * @param \AppBundle\Entity\ShopBilderZu $aOBzid
     *
     * @return ArtikelOrte
     */
    public function setAOBzid(\AppBundle\Entity\ShopBilderZu $aOBzid = null)
    {
        $this->aOBzid = $aOBzid;

        return $this;
    }

    /**
     * Get aOBzid
     *
     * @return \AppBundle\Entity\ShopBilderZu
     */
    public function getAOBzid()
    {
        return $this->aOBzid;
    }

    /**
     * @return ArtikelKategorie
     */
    public function getAOKategorien()
    {
        return $this->aOKategorien;
    }

    /**
     * @param ArtikelKategorie $aOKategorien
     */
    public function setAOKategorien($aOKategorien)
    {
        $this->aOKategorien = $aOKategorien;
    }

    /**
     * @return ArtikelKategorieArt
     */
    public function getAOArten()
    {
        if(!$this->aOArten) $this->aOArten = new ArrayCollection();
        return $this->aOArten;
    }

    /**
     * @param ArtikelKategorieArt $aOArten
     */
    public function setAOArten($aOArten)
    {
        $this->aOArten = $aOArten;
    }


}
