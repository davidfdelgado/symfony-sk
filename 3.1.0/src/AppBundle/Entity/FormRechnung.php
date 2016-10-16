<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormRechnung
 *
 * @ORM\Table(name="FORM_Rechnung", uniqueConstraints={@ORM\UniqueConstraint(name="fo_type", columns={"fo_type", "fo_lang"})})
 * @ORM\Entity
 */
class FormRechnung
{
    /**
     * @var integer
     *
     * @ORM\Column(name="fo_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $foId;

    /**
     * @var integer
     *
     * @ORM\Column(name="fo_type", type="integer", nullable=false)
     */
    private $foType;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_lang", type="string", length=8, nullable=false)
     */
    private $foLang;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_header", type="string", length=64, nullable=false)
     */
    private $foHeader;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_footer", type="string", length=64, nullable=true)
     */
    private $foFooter;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_1_1", type="string", length=32, nullable=true)
     */
    private $foFo11;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_1_2", type="string", length=32, nullable=true)
     */
    private $foFo12;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_1_3", type="string", length=32, nullable=true)
     */
    private $foFo13;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_1_4", type="string", length=32, nullable=true)
     */
    private $foFo14;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_2_1", type="string", length=32, nullable=true)
     */
    private $foFo21;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_2_2", type="string", length=32, nullable=true)
     */
    private $foFo22;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_2_3", type="string", length=32, nullable=true)
     */
    private $foFo23;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_2_4", type="string", length=32, nullable=true)
     */
    private $foFo24;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_3_1", type="string", length=32, nullable=true)
     */
    private $foFo31;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_3_2", type="string", length=32, nullable=true)
     */
    private $foFo32;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_3_3", type="string", length=32, nullable=true)
     */
    private $foFo33;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_3_4", type="string", length=32, nullable=true)
     */
    private $foFo34;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_4_1", type="string", length=32, nullable=true)
     */
    private $foFo41;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_4_2", type="string", length=32, nullable=true)
     */
    private $foFo42;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_4_3", type="string", length=32, nullable=true)
     */
    private $foFo43;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fo_4_4", type="string", length=32, nullable=true)
     */
    private $foFo44;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_email", type="string", length=32, nullable=true)
     */
    private $foEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_company", type="string", length=64, nullable=true)
     */
    private $foCompany;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_addr_1", type="string", length=64, nullable=true)
     */
    private $foAddr1;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_addr_2", type="string", length=64, nullable=true)
     */
    private $foAddr2;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_tel", type="string", length=32, nullable=true)
     */
    private $foTel;

    /**
     * @var string
     *
     * @ORM\Column(name="fo_fax", type="string", length=32, nullable=true)
     */
    private $foFax;



    /**
     * Get foId
     *
     * @return integer
     */
    public function getFoId()
    {
        return $this->foId;
    }

    /**
     * Set foType
     *
     * @param integer $foType
     *
     * @return FormRechnung
     */
    public function setFoType($foType)
    {
        $this->foType = $foType;

        return $this;
    }

    /**
     * Get foType
     *
     * @return integer
     */
    public function getFoType()
    {
        return $this->foType;
    }

    /**
     * Set foLang
     *
     * @param string $foLang
     *
     * @return FormRechnung
     */
    public function setFoLang($foLang)
    {
        $this->foLang = $foLang;

        return $this;
    }

    /**
     * Get foLang
     *
     * @return string
     */
    public function getFoLang()
    {
        return $this->foLang;
    }

    /**
     * Set foHeader
     *
     * @param string $foHeader
     *
     * @return FormRechnung
     */
    public function setFoHeader($foHeader)
    {
        $this->foHeader = $foHeader;

        return $this;
    }

    /**
     * Get foHeader
     *
     * @return string
     */
    public function getFoHeader()
    {
        return $this->foHeader;
    }

    /**
     * Set foFooter
     *
     * @param string $foFooter
     *
     * @return FormRechnung
     */
    public function setFoFooter($foFooter)
    {
        $this->foFooter = $foFooter;

        return $this;
    }

    /**
     * Get foFooter
     *
     * @return string
     */
    public function getFoFooter()
    {
        return $this->foFooter;
    }

    /**
     * Set foFo11
     *
     * @param string $foFo11
     *
     * @return FormRechnung
     */
    public function setFoFo11($foFo11)
    {
        $this->foFo11 = $foFo11;

        return $this;
    }

    /**
     * Get foFo11
     *
     * @return string
     */
    public function getFoFo11()
    {
        return $this->foFo11;
    }

    /**
     * Set foFo12
     *
     * @param string $foFo12
     *
     * @return FormRechnung
     */
    public function setFoFo12($foFo12)
    {
        $this->foFo12 = $foFo12;

        return $this;
    }

    /**
     * Get foFo12
     *
     * @return string
     */
    public function getFoFo12()
    {
        return $this->foFo12;
    }

    /**
     * Set foFo13
     *
     * @param string $foFo13
     *
     * @return FormRechnung
     */
    public function setFoFo13($foFo13)
    {
        $this->foFo13 = $foFo13;

        return $this;
    }

    /**
     * Get foFo13
     *
     * @return string
     */
    public function getFoFo13()
    {
        return $this->foFo13;
    }

    /**
     * Set foFo14
     *
     * @param string $foFo14
     *
     * @return FormRechnung
     */
    public function setFoFo14($foFo14)
    {
        $this->foFo14 = $foFo14;

        return $this;
    }

    /**
     * Get foFo14
     *
     * @return string
     */
    public function getFoFo14()
    {
        return $this->foFo14;
    }

    /**
     * Set foFo21
     *
     * @param string $foFo21
     *
     * @return FormRechnung
     */
    public function setFoFo21($foFo21)
    {
        $this->foFo21 = $foFo21;

        return $this;
    }

    /**
     * Get foFo21
     *
     * @return string
     */
    public function getFoFo21()
    {
        return $this->foFo21;
    }

    /**
     * Set foFo22
     *
     * @param string $foFo22
     *
     * @return FormRechnung
     */
    public function setFoFo22($foFo22)
    {
        $this->foFo22 = $foFo22;

        return $this;
    }

    /**
     * Get foFo22
     *
     * @return string
     */
    public function getFoFo22()
    {
        return $this->foFo22;
    }

    /**
     * Set foFo23
     *
     * @param string $foFo23
     *
     * @return FormRechnung
     */
    public function setFoFo23($foFo23)
    {
        $this->foFo23 = $foFo23;

        return $this;
    }

    /**
     * Get foFo23
     *
     * @return string
     */
    public function getFoFo23()
    {
        return $this->foFo23;
    }

    /**
     * Set foFo24
     *
     * @param string $foFo24
     *
     * @return FormRechnung
     */
    public function setFoFo24($foFo24)
    {
        $this->foFo24 = $foFo24;

        return $this;
    }

    /**
     * Get foFo24
     *
     * @return string
     */
    public function getFoFo24()
    {
        return $this->foFo24;
    }

    /**
     * Set foFo31
     *
     * @param string $foFo31
     *
     * @return FormRechnung
     */
    public function setFoFo31($foFo31)
    {
        $this->foFo31 = $foFo31;

        return $this;
    }

    /**
     * Get foFo31
     *
     * @return string
     */
    public function getFoFo31()
    {
        return $this->foFo31;
    }

    /**
     * Set foFo32
     *
     * @param string $foFo32
     *
     * @return FormRechnung
     */
    public function setFoFo32($foFo32)
    {
        $this->foFo32 = $foFo32;

        return $this;
    }

    /**
     * Get foFo32
     *
     * @return string
     */
    public function getFoFo32()
    {
        return $this->foFo32;
    }

    /**
     * Set foFo33
     *
     * @param string $foFo33
     *
     * @return FormRechnung
     */
    public function setFoFo33($foFo33)
    {
        $this->foFo33 = $foFo33;

        return $this;
    }

    /**
     * Get foFo33
     *
     * @return string
     */
    public function getFoFo33()
    {
        return $this->foFo33;
    }

    /**
     * Set foFo34
     *
     * @param string $foFo34
     *
     * @return FormRechnung
     */
    public function setFoFo34($foFo34)
    {
        $this->foFo34 = $foFo34;

        return $this;
    }

    /**
     * Get foFo34
     *
     * @return string
     */
    public function getFoFo34()
    {
        return $this->foFo34;
    }

    /**
     * Set foFo41
     *
     * @param string $foFo41
     *
     * @return FormRechnung
     */
    public function setFoFo41($foFo41)
    {
        $this->foFo41 = $foFo41;

        return $this;
    }

    /**
     * Get foFo41
     *
     * @return string
     */
    public function getFoFo41()
    {
        return $this->foFo41;
    }

    /**
     * Set foFo42
     *
     * @param string $foFo42
     *
     * @return FormRechnung
     */
    public function setFoFo42($foFo42)
    {
        $this->foFo42 = $foFo42;

        return $this;
    }

    /**
     * Get foFo42
     *
     * @return string
     */
    public function getFoFo42()
    {
        return $this->foFo42;
    }

    /**
     * Set foFo43
     *
     * @param string $foFo43
     *
     * @return FormRechnung
     */
    public function setFoFo43($foFo43)
    {
        $this->foFo43 = $foFo43;

        return $this;
    }

    /**
     * Get foFo43
     *
     * @return string
     */
    public function getFoFo43()
    {
        return $this->foFo43;
    }

    /**
     * Set foFo44
     *
     * @param string $foFo44
     *
     * @return FormRechnung
     */
    public function setFoFo44($foFo44)
    {
        $this->foFo44 = $foFo44;

        return $this;
    }

    /**
     * Get foFo44
     *
     * @return string
     */
    public function getFoFo44()
    {
        return $this->foFo44;
    }

    /**
     * Set foEmail
     *
     * @param string $foEmail
     *
     * @return FormRechnung
     */
    public function setFoEmail($foEmail)
    {
        $this->foEmail = $foEmail;

        return $this;
    }

    /**
     * Get foEmail
     *
     * @return string
     */
    public function getFoEmail()
    {
        return $this->foEmail;
    }

    /**
     * Set foCompany
     *
     * @param string $foCompany
     *
     * @return FormRechnung
     */
    public function setFoCompany($foCompany)
    {
        $this->foCompany = $foCompany;

        return $this;
    }

    /**
     * Get foCompany
     *
     * @return string
     */
    public function getFoCompany()
    {
        return $this->foCompany;
    }

    /**
     * Set foAddr1
     *
     * @param string $foAddr1
     *
     * @return FormRechnung
     */
    public function setFoAddr1($foAddr1)
    {
        $this->foAddr1 = $foAddr1;

        return $this;
    }

    /**
     * Get foAddr1
     *
     * @return string
     */
    public function getFoAddr1()
    {
        return $this->foAddr1;
    }

    /**
     * Set foAddr2
     *
     * @param string $foAddr2
     *
     * @return FormRechnung
     */
    public function setFoAddr2($foAddr2)
    {
        $this->foAddr2 = $foAddr2;

        return $this;
    }

    /**
     * Get foAddr2
     *
     * @return string
     */
    public function getFoAddr2()
    {
        return $this->foAddr2;
    }

    /**
     * Set foTel
     *
     * @param string $foTel
     *
     * @return FormRechnung
     */
    public function setFoTel($foTel)
    {
        $this->foTel = $foTel;

        return $this;
    }

    /**
     * Get foTel
     *
     * @return string
     */
    public function getFoTel()
    {
        return $this->foTel;
    }

    /**
     * Set foFax
     *
     * @param string $foFax
     *
     * @return FormRechnung
     */
    public function setFoFax($foFax)
    {
        $this->foFax = $foFax;

        return $this;
    }

    /**
     * Get foFax
     *
     * @return string
     */
    public function getFoFax()
    {
        return $this->foFax;
    }
}
