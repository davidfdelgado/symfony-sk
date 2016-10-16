<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity
 */
class Test
{
    /**
     * @var integer
     *
     * @ORM\Column(name="a", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $a;

    /**
     * @var string
     *
     * @ORM\Column(name="b", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $b;

    /**
     * @var integer
     *
     * @ORM\Column(name="c", type="integer", nullable=false)
     */
    private $c;

    /**
     * @var integer
     *
     * @ORM\Column(name="d", type="integer", nullable=false)
     */
    private $d;



    /**
     * Get a
     *
     * @return integer
     */
    public function getA()
    {
        return $this->a;
    }

    /**
     * Set b
     *
     * @param string $b
     *
     * @return Test
     */
    public function setB($b)
    {
        $this->b = $b;

        return $this;
    }

    /**
     * Get b
     *
     * @return string
     */
    public function getB()
    {
        return $this->b;
    }

    /**
     * Set c
     *
     * @param integer $c
     *
     * @return Test
     */
    public function setC($c)
    {
        $this->c = $c;

        return $this;
    }

    /**
     * Get c
     *
     * @return integer
     */
    public function getC()
    {
        return $this->c;
    }

    /**
     * Set d
     *
     * @param integer $d
     *
     * @return Test
     */
    public function setD($d)
    {
        $this->d = $d;

        return $this;
    }

    /**
     * Get d
     *
     * @return integer
     */
    public function getD()
    {
        return $this->d;
    }
}
