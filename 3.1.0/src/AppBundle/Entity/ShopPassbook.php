<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopPassbook
 *
 * @ORM\Table(name="SHOP_Passbook")
 * @ORM\Entity
 */
class ShopPassbook
{
    /**
     * @var integer
     *
     * @ORM\Column(name="pa_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $paId;

    /**
     * @var string
     *
     * @ORM\Column(name="pa_city", type="string", length=32, nullable=false)
     */
    private $paCity;

    /**
     * @var string
     *
     * @ORM\Column(name="pa_name", type="string", length=32, nullable=false)
     */
    private $paName;

    /**
     * @var string
     *
     * @ORM\Column(name="pa_pass_type", type="string", length=64, nullable=false)
     */
    private $paPassType;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pa_time_true", type="boolean", nullable=false)
     */
    private $paTimeTrue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pa_time", type="time", nullable=false)
     */
    private $paTime;

    /**
     * @var string
     *
     * @ORM\Column(name="pa_organization_name", type="string", length=32, nullable=false)
     */
    private $paOrganizationName;

    /**
     * @var string
     *
     * @ORM\Column(name="pa_description", type="string", length=64, nullable=false)
     */
    private $paDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="pa_category", type="string", length=32, nullable=false)
     */
    private $paCategory;



    /**
     * Get paId
     *
     * @return integer
     */
    public function getPaId()
    {
        return $this->paId;
    }

    /**
     * Set paCity
     *
     * @param string $paCity
     *
     * @return ShopPassbook
     */
    public function setPaCity($paCity)
    {
        $this->paCity = $paCity;

        return $this;
    }

    /**
     * Get paCity
     *
     * @return string
     */
    public function getPaCity()
    {
        return $this->paCity;
    }

    /**
     * Set paName
     *
     * @param string $paName
     *
     * @return ShopPassbook
     */
    public function setPaName($paName)
    {
        $this->paName = $paName;

        return $this;
    }

    /**
     * Get paName
     *
     * @return string
     */
    public function getPaName()
    {
        return $this->paName;
    }

    /**
     * Set paPassType
     *
     * @param string $paPassType
     *
     * @return ShopPassbook
     */
    public function setPaPassType($paPassType)
    {
        $this->paPassType = $paPassType;

        return $this;
    }

    /**
     * Get paPassType
     *
     * @return string
     */
    public function getPaPassType()
    {
        return $this->paPassType;
    }

    /**
     * Set paTimeTrue
     *
     * @param boolean $paTimeTrue
     *
     * @return ShopPassbook
     */
    public function setPaTimeTrue($paTimeTrue)
    {
        $this->paTimeTrue = $paTimeTrue;

        return $this;
    }

    /**
     * Get paTimeTrue
     *
     * @return boolean
     */
    public function getPaTimeTrue()
    {
        return $this->paTimeTrue;
    }

    /**
     * Set paTime
     *
     * @param \DateTime $paTime
     *
     * @return ShopPassbook
     */
    public function setPaTime($paTime)
    {
        $this->paTime = $paTime;

        return $this;
    }

    /**
     * Get paTime
     *
     * @return \DateTime
     */
    public function getPaTime()
    {
        return $this->paTime;
    }

    /**
     * Set paOrganizationName
     *
     * @param string $paOrganizationName
     *
     * @return ShopPassbook
     */
    public function setPaOrganizationName($paOrganizationName)
    {
        $this->paOrganizationName = $paOrganizationName;

        return $this;
    }

    /**
     * Get paOrganizationName
     *
     * @return string
     */
    public function getPaOrganizationName()
    {
        return $this->paOrganizationName;
    }

    /**
     * Set paDescription
     *
     * @param string $paDescription
     *
     * @return ShopPassbook
     */
    public function setPaDescription($paDescription)
    {
        $this->paDescription = $paDescription;

        return $this;
    }

    /**
     * Get paDescription
     *
     * @return string
     */
    public function getPaDescription()
    {
        return $this->paDescription;
    }

    /**
     * Set paCategory
     *
     * @param string $paCategory
     *
     * @return ShopPassbook
     */
    public function setPaCategory($paCategory)
    {
        $this->paCategory = $paCategory;

        return $this;
    }

    /**
     * Get paCategory
     *
     * @return string
     */
    public function getPaCategory()
    {
        return $this->paCategory;
    }
}
