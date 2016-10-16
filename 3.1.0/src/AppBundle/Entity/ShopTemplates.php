<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopTemplates
 *
 * @ORM\Table(name="SHOP_Templates")
 * @ORM\Entity
 */
class ShopTemplates
{
    /**
     * @var integer
     *
     * @ORM\Column(name="templateid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $templateid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="inhalt", type="text", length=65535, nullable=false)
     */
    private $inhalt;



    /**
     * Get templateid
     *
     * @return integer
     */
    public function getTemplateid()
    {
        return $this->templateid;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ShopTemplates
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

    /**
     * Set inhalt
     *
     * @param string $inhalt
     *
     * @return ShopTemplates
     */
    public function setInhalt($inhalt)
    {
        $this->inhalt = $inhalt;

        return $this;
    }

    /**
     * Get inhalt
     *
     * @return string
     */
    public function getInhalt()
    {
        return $this->inhalt;
    }
}
