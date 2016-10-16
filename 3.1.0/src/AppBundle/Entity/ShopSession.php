<?php

namespace AppBundle\Entity;

use AppBundle\AppBundle;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ShopSession
 *
 * @ORM\Table(name="SHOP_Session", uniqueConstraints={@ORM\UniqueConstraint(name="s_id", columns={"s_id"}), @ORM\UniqueConstraint(name="s_session", columns={"s_session"})}, indexes={@ORM\Index(name="s_gs", columns={"s_gs"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ShopSessionRepository")
 */
class ShopSession
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\Column(name="s_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $sId;

    /**
     * @var string
     *
     * @ORM\Column(name="s_session", type="string", length=32, nullable=true)
     */
    private $sSession = "";

    /**
     * @var integer
     *
     * @ORM\Column(name="s_kid", type="integer", length=12, nullable=true)
     */
    private $sKid;

    /**
     * @var string
     *
     * @ORM\Column(name="s_lang", type="string", length=8, nullable=true)
     */
    private $sLang;

    /**
     * @var string
     *
     * @ORM\Column(name="s_rnnr", type="string", length=32, nullable=true)
     */
    private $sRnnr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="s_date", type="datetime", nullable=true)
     */
    private $sDate = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="s_rdatum", type="date", nullable=true)
     */
    private $sRdatum;

    /**
     * @var \AppBundle\Entity\ShopGsCodes
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopGsCodes")
     *   @ORM\JoinColumn(name="s_gs", referencedColumnName="gs_n_id", nullable=true)
     */
    private $sGs;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ShopWarenkorb", mappedBy="wcSId", cascade={"persist", "remove"})
     */
    private $sWarenkorb;

    /**
     * @var ArrayCollection
     */
    private $sKategorien;

    /**
     * @var integer
     */
    private $sTicketsAnzahl;

    public function __construct()
    {
        $this->sWarenkorb = new ArrayCollection();
        $this->sDate = new \DateTime();
    }



    /**
     * Get wId
     *
     * @return integer
     */
    public function getSId()
    {
        return $this->sId;
    }


    /**
     * Set sSession
     *
     * @param string $sSession
     *
     * @return ShopSession
     */
    public function setSSession($sSession)
    {
        $this->sSession = $sSession;

        return $this;
    }

    /**
     * Get sSession
     *
     * @return string
     */
    public function getSSession()
    {
        return $this->sSession;
    }

    /**
     * Set sKid
     *
     * @param integer $sKid
     *
     * @return ShopSession
     */
    public function setSKid($sKid)
    {
        $this->sKid = $sKid;

        return $this;
    }

    /**
     * Get sKid
     *
     * @return integer
     */
    public function getSKid()
    {
        return $this->sKid;
    }

    /**
     * Set sLang
     *
     * @param string $sLang
     *
     * @return ShopSession
     */
    public function setSLang($sLang)
    {
        $this->sLang = $sLang;

        return $this;
    }

    /**
     * Get sLang
     *
     * @return string
     */
    public function getSLang()
    {
        return $this->sLang;
    }

    /**
     * Set sRnnr
     *
     * @param string $sRnnr
     *
     * @return ShopSession
     */
    public function setSRnnr($sRnnr)
    {
        $this->sRnnr = $sRnnr;

        return $this;
    }

    /**
     * Get sRnnr
     *
     * @return string
     */
    public function getSRnnr()
    {
        return $this->sRnnr;
    }

    /**
     * Set sDate
     *
     * @param \DateTime $sDate
     *
     * @return ShopSession
     */
    public function setSDate($sDate)
    {
        $this->sDate = $sDate;

        return $this;
    }

    /**
     * Get sDate
     *
     * @return \DateTime
     */
    public function getSDate()
    {
        return $this->sDate;
    }

    /**
     * Set sRdatum
     *
     * @param \DateTime $sRdatum
     *
     * @return ShopSession
     */
    public function setSRdatum($sRdatum)
    {
        $this->sRdatum = $sRdatum;

        return $this;
    }

    /**
     * Get sRdatum
     *
     * @return \DateTime
     */
    public function getSRdatum()
    {
        return $this->sRdatum;
    }

    /**
     * Set sGs
     *
     * @param \AppBundle\Entity\ShopGsCodes $sGs
     *
     * @return ShopSession
     */
    public function setSGs(\AppBundle\Entity\ShopGsCodes $sGs = null)
    {
        $this->sGs = $sGs;

        return $this;
    }

    /**
     * Get sGs
     *
     * @return \AppBundle\Entity\ShopGsCodes
     */
    public function getSGs()
    {
        return $this->sGs;
    }

    /**
     * @return ShopWarenkorb
     */
    public function getSWarenkorb()
    {
        return $this->sWarenkorb;
    }

    /**
     * @param ShopWarenkorb $sWarenkorb
     */
    public function setSWarenkorb($sWarenkorb)
    {
        $this->sWarenkorb = $sWarenkorb;
    }

    /**
     * @param ShopWarenkorb $sWarenkorb
     */
    public function removeSWarenkorb(ShopWarenkorb $sWarenkorb)
    {
        $this->sWarenkorb->removeElement($sWarenkorb);

        return $this;
    }



    /**
     * @return ArrayCollection
     */
    public function getSKategorien()
    {
        if(!$this->sKategorien) $this->sKategorien = new ArrayCollection();

        foreach($this->sWarenkorb as $wc){

            if($wc->getWcArtikelnummer()){
                if($this->sKategorien->contains($wc->getWcArtikelnummer()->getPkKategorie()) == false){
                    $this->sKategorien->add($wc->getWcArtikelnummer()->getPkKategorie());
                }

            }

        }

        return $this->sKategorien;
    }

    /**
     * @return mixed
     */
    public function getSTicketsAnzahl()
    {
        $anzahl = 0;
        foreach($this->sWarenkorb as $wc){
            $anzahl += $wc->getWcMenge();
        }
        return $this->sTicketsAnzahl = $anzahl;
    }


}
