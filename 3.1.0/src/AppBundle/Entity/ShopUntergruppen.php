<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopUntergruppen
 *
 * @ORM\Table(name="SHOP_Untergruppen")
 * @ORM\Entity
 */
class ShopUntergruppen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="main_kat", type="string", length=5, nullable=true)
     */
    private $mainKat;

    /**
     * @var string
     *
     * @ORM\Column(name="anzeige", type="string", length=5, nullable=true)
     */
    private $anzeige;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mainKat
     *
     * @param string $mainKat
     *
     * @return ShopUntergruppen
     */
    public function setMainKat($mainKat)
    {
        $this->mainKat = $mainKat;

        return $this;
    }

    /**
     * Get mainKat
     *
     * @return string
     */
    public function getMainKat()
    {
        return $this->mainKat;
    }

    /**
     * Set anzeige
     *
     * @param string $anzeige
     *
     * @return ShopUntergruppen
     */
    public function setAnzeige($anzeige)
    {
        $this->anzeige = $anzeige;

        return $this;
    }

    /**
     * Get anzeige
     *
     * @return string
     */
    public function getAnzeige()
    {
        return $this->anzeige;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ShopUntergruppen
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
