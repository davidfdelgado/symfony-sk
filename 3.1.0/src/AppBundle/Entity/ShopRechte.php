<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopRechte
 *
 * @ORM\Table(name="SHOP_Rechte")
 * @ORM\Entity
 */
class ShopRechte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_r", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idR;

    /**
     * @var string
     *
     * @ORM\Column(name="link_r", type="string", length=200, nullable=false)
     */
    private $linkR;

    /**
     * @var integer
     *
     * @ORM\Column(name="rechte_r", type="integer", nullable=false)
     */
    private $rechteR;

    /**
     * @var string
     *
     * @ORM\Column(name="bezeichnung_r", type="string", length=100, nullable=false)
     */
    private $bezeichnungR;

    /**
     * @var integer
     *
     * @ORM\Column(name="master_r", type="integer", nullable=false)
     */
    private $masterR;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_r", type="integer", nullable=false)
     */
    private $orderR = '99';



    /**
     * Get idR
     *
     * @return integer
     */
    public function getIdR()
    {
        return $this->idR;
    }

    /**
     * Set linkR
     *
     * @param string $linkR
     *
     * @return ShopRechte
     */
    public function setLinkR($linkR)
    {
        $this->linkR = $linkR;

        return $this;
    }

    /**
     * Get linkR
     *
     * @return string
     */
    public function getLinkR()
    {
        return $this->linkR;
    }

    /**
     * Set rechteR
     *
     * @param integer $rechteR
     *
     * @return ShopRechte
     */
    public function setRechteR($rechteR)
    {
        $this->rechteR = $rechteR;

        return $this;
    }

    /**
     * Get rechteR
     *
     * @return integer
     */
    public function getRechteR()
    {
        return $this->rechteR;
    }

    /**
     * Set bezeichnungR
     *
     * @param string $bezeichnungR
     *
     * @return ShopRechte
     */
    public function setBezeichnungR($bezeichnungR)
    {
        $this->bezeichnungR = $bezeichnungR;

        return $this;
    }

    /**
     * Get bezeichnungR
     *
     * @return string
     */
    public function getBezeichnungR()
    {
        return $this->bezeichnungR;
    }

    /**
     * Set masterR
     *
     * @param integer $masterR
     *
     * @return ShopRechte
     */
    public function setMasterR($masterR)
    {
        $this->masterR = $masterR;

        return $this;
    }

    /**
     * Get masterR
     *
     * @return integer
     */
    public function getMasterR()
    {
        return $this->masterR;
    }

    /**
     * Set orderR
     *
     * @param integer $orderR
     *
     * @return ShopRechte
     */
    public function setOrderR($orderR)
    {
        $this->orderR = $orderR;

        return $this;
    }

    /**
     * Get orderR
     *
     * @return integer
     */
    public function getOrderR()
    {
        return $this->orderR;
    }
}
