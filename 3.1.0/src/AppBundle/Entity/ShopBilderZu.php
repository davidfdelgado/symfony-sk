<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopBilderZu
 *
 * @ORM\Table(name="SHOP_Bilder_Zu", indexes={@ORM\Index(name="Kategorie", columns={"bz_bi_id"}), @ORM\Index(name="bz_ak_id", columns={"bz_ak_id"})})
 * @ORM\Entity
 */
class ShopBilderZu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bz_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bzId;

    /**
     * @var string
     *
     * @ORM\Column(name="bz_bezeichnung", type="string", length=128, nullable=true)
     */
    private $bzBezeichnung;

    /**
     * @var string
     *
     * @ORM\Column(name="bz_title", type="string", length=64, nullable=true)
     */
    private $bzTitle;

    /**
     * @var integer
     *
     * @ORM\Column(name="bz_typ", type="integer", nullable=false)
     */
    private $bzTyp;

    /**
     * @var \AppBundle\Entity\ShopBilder
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopBilder")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bz_bi_id", referencedColumnName="bi_id")
     * })
     */
    private $bzBi;

    /**
     * @var \AppBundle\Entity\ArtikelKategorie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtikelKategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bz_ak_id", referencedColumnName="a_k_id")
     * })
     */
    private $bzAk;



    /**
     * Get bzId
     *
     * @return integer
     */
    public function getBzId()
    {
        return $this->bzId;
    }

    /**
     * Set bzBezeichnung
     *
     * @param string $bzBezeichnung
     *
     * @return ShopBilderZu
     */
    public function setBzBezeichnung($bzBezeichnung)
    {
        $this->bzBezeichnung = $bzBezeichnung;

        return $this;
    }

    /**
     * Get bzBezeichnung
     *
     * @return string
     */
    public function getBzBezeichnung()
    {
        return $this->bzBezeichnung;
    }

    /**
     * Set bzTitle
     *
     * @param string $bzTitle
     *
     * @return ShopBilderZu
     */
    public function setBzTitle($bzTitle)
    {
        $this->bzTitle = $bzTitle;

        return $this;
    }

    /**
     * Get bzTitle
     *
     * @return string
     */
    public function getBzTitle()
    {
        return $this->bzTitle;
    }

    /**
     * Set bzTyp
     *
     * @param integer $bzTyp
     *
     * @return ShopBilderZu
     */
    public function setBzTyp($bzTyp)
    {
        $this->bzTyp = $bzTyp;

        return $this;
    }

    /**
     * Get bzTyp
     *
     * @return integer
     */
    public function getBzTyp()
    {
        return $this->bzTyp;
    }

    /**
     * Set bzBi
     *
     * @param \AppBundle\Entity\ShopBilder $bzBi
     *
     * @return ShopBilderZu
     */
    public function setBzBi(\AppBundle\Entity\ShopBilder $bzBi = null)
    {
        $this->bzBi = $bzBi;

        return $this;
    }

    /**
     * Get bzBi
     *
     * @return \AppBundle\Entity\ShopBilder
     */
    public function getBzBi()
    {
        return $this->bzBi;
    }

    /**
     * Set bzAk
     *
     * @param \AppBundle\Entity\ArtikelKategorie $bzAk
     *
     * @return ShopBilderZu
     */
    public function setBzAk(\AppBundle\Entity\ArtikelKategorie $bzAk = null)
    {
        $this->bzAk = $bzAk;

        return $this;
    }

    /**
     * Get bzAk
     *
     * @return \AppBundle\Entity\ArtikelKategorie
     */
    public function getBzAk()
    {
        return $this->bzAk;
    }
}
