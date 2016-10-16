<?php

namespace AppBundle\Entity;


use AppBundle\AppBundle;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AgenturUser
 *
 * @ORM\Table(name="AGENTUR_User")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AgenturUserRepository")
 * @UniqueEntity(fields={"auBn"}, errorPath="auBn", message="Der angegebene Benutzername wird bereits verwendet!")
 */
class AgenturUser implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="au_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $auId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="au_art", type="integer", length=2, nullable=false)
     */
    private $auArt = '0';

    protected $auArtLabel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="au_typ", type="boolean", nullable=false)
     */
    private $auTyp = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="au_bn", type="string", length=32, nullable=false)
     * @Assert\NotBlank(message="Bitte geben Sie einen Benutzernamen an.")
     * @Assert\Length(min=2, max=32, minMessage="Der Benutzername muss mindestens {{ limit }} Zeichen lang sein.", maxMessage="Der Benutzername darf nicht länger als {{ limit }} Zeichen lang sein.")
     */
    private $auBn;

    /**
     * @var string
     *
     * @ORM\Column(name="au_pw", type="string", length=32, nullable=false)
     * @Assert\NotBlank(message="Bitte setzen Sie ein Passwort")
     * @Assert\Length(min=8, minMessage="Das Password muss mindestens {{ limit }} Zeichen lang sein.")
     */
    private $auPw;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="au_lastlogin", type="datetime", nullable=true)
     */
    private $auLastlogin;

    /**
     * @var string
     *
     * @ORM\Column(name="au_vorname", type="string", length=32, nullable=false)
     * @Assert\NotBlank(message="Bitte geben Sie einen Vornamen an.")
     */
    private $auVorname;

    /**
     * @var string
     *
     * @ORM\Column(name="au_nachname", type="string", length=32, nullable=false)
     * @Assert\NotBlank(message="Bitte geben Sie einen Nachnamen an.")
     */
    private $auNachname;

    /**
     * @var AgenturVertrieb
     *
     * @ORM\ManyToOne(targetEntity="AgenturVertrieb", inversedBy="avUsers")
     * @ORM\JoinColumn(name="au_vid", referencedColumnName="av_id", nullable=true)
     */
    private $auVid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="au_created", type="datetime", nullable=false)
     */
    private $auCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     *
     * @ORM\Column(name="au_status", type="boolean", nullable=false)
     */
    private $auStatus;

    private $auStatusLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="au_email", type="string", length=64, nullable=false)
     * @Assert\NotBlank(message="Bitte geben Sie eine EmailAdresse an.")
     * @Assert\Email(message="Bitte geben Sie eine gültige Emailadresse an.")
     */
    private $auEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="au_telefon", type="string", length=32, nullable=true)
     */
    private $auTelefon;

    /**
     * @var boolean
     *
     * @ORM\Column(name="au_scan_all", type="boolean", nullable=false)
     */
    private $auScanAll = false;

    /**
     * @var AgenturLogin
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AgenturLogin", mappedBy="ag")
     * @ORM\OrderBy({"agCreated" = "DESC"})
     */
    private $auLogs;

    /**
     * @var ShopBestellungen
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ShopBestellungen", mappedBy="bUser")
     */

    private $auVorgaenge;

    public function __construct()
    {
        $this->auArt = 1;
        $this->auCreated = new \DateTime();
        $this->auVorgaenge;
    }

    /**
     * Get auId
     *
     * @return integer
     */
    public function getAuId()
    {
        return $this->auId;
    }

    /**
     * Set auArt
     *
     * @param boolean $auArt
     *
     * @return AgenturUser
     */
    public function setAuArt($auArt)
    {
        $this->auArt = $auArt;

        return $this;
    }

    /**
     * Get auArt
     *
     * @return boolean
     */
    public function getAuArt($true = false)
    {
        if($true === true){

            $array = [
              1    =>  'Normal',
              2    =>  'Admin',
              3    =>  'Scanner',
            ];

            return $array;
        }
        return $this->auArt;
    }

    /**
     * @return mixed
     */
    public function getAuArtLabel()
    {
        $label = "";
        switch($this->auArt){
            case 1:
                $label = "Normal";
                break;
            case 2:
                $label = "Admin";
                break;
            case 3:
                $label = "unbekannt";
                break;
            case 4:
                $label = "SuperAdmin";
                break;
            case 98:
                $label = "system_account";
                break;
            case 99:
                $label = "gelöscht";
                break;
            default:
                $label = "unbekannt";
                break;
        }
        return $label;
    }

    /**
     * Set auTyp
     *
     * @param boolean $auTyp
     *
     * @return AgenturUser
     */
    public function setAuTyp($auTyp)
    {
        $this->auTyp = $auTyp;

        return $this;
    }

    /**
     * Get auTyp
     *
     * @return boolean
     */
    public function getAuTyp()
    {
        return $this->auTyp;
    }

    /**
     * Set auBn
     *
     * @param string $auBn
     *
     * @return AgenturUser
     */
    public function setAuBn($auBn)
    {
        $this->auBn = $auBn;

        return $this;
    }

    /**
     * Get auBn
     *
     * @return string
     */
    public function getAuBn()
    {
        return $this->auBn;
    }

    /**
     * Set auPw
     *
     * @param string $auPw
     *
     * @return AgenturUser
     */
    public function setAuPw($auPw)
    {
        if(false === empty($auPw)){
            $this->auPw = $auPw;
        }

        return $this;
    }

    /**
     * Get auPw
     *
     * @return string
     */
    public function getAuPw()
    {
        return $this->auPw;
    }

    /**
     * Set auLastlogin
     *
     * @param \DateTime $auLastlogin
     *
     * @return AgenturUser
     */
    public function setAuLastlogin($auLastlogin)
    {
        $this->auLastlogin = $auLastlogin;

        return $this;
    }

    /**
     * Get auLastlogin
     *
     * @return \DateTime
     */
    public function getAuLastlogin()
    {
        return $this->auLastlogin;
    }

    /**
     * Set auVorname
     *
     * @param string $auVorname
     *
     * @return AgenturUser
     */
    public function setAuVorname($auVorname)
    {
        $this->auVorname = $auVorname;

        return $this;
    }

    /**
     * Get auVorname
     *
     * @return string
     */
    public function getAuVorname()
    {
        return $this->auVorname;
    }

    /**
     * Set auNachname
     *
     * @param string $auNachname
     *
     * @return AgenturUser
     */
    public function setAuNachname($auNachname)
    {
        $this->auNachname = $auNachname;

        return $this;
    }

    /**
     * Get auNachname
     *
     * @return string
     */
    public function getAuNachname()
    {
        return $this->auNachname;
    }

    /**
     * Set auVid
     *
     * @param integer $auVid
     *
     * @return AgenturUser
     */
    public function setAuVid($auVid)
    {
        $this->auVid = $auVid;

        return $this;
    }

    /**
     * Get auVid
     *
     * @return integer
     */
    public function getAuVid()
    {
        return $this->auVid;
    }

    /**
     * Set auCreated
     *
     * @param \DateTime $auCreated
     *
     * @return AgenturUser
     */
    public function setAuCreated($auCreated)
    {
        $this->auCreated = $auCreated;

        return $this;
    }

    /**
     * Get auCreated
     *
     * @return \DateTime
     */
    public function getAuCreated()
    {
        return $this->auCreated;
    }

    /**
     * Set auStatus
     *
     * @param boolean $auStatus
     *
     * @return AgenturUser
     */
    public function setAuStatus($auStatus)
    {
        $this->auStatus = $auStatus;

        return $this;
    }

    /**
     * Get auStatus
     *
     * @return boolean
     */
    public function getAuStatus()
    {
        return $this->auStatus;
    }

    /**
     * @return mixed
     */
    public function getAuStatusLabel()
    {
        $label = "inaktiv";

        if($this->auStatus) $label = "aktiv";

        return $label;
    }

    /**
     * Set auEmail
     *
     * @param string $auEmail
     *
     * @return AgenturUser
     */
    public function setAuEmail($auEmail)
    {
        $this->auEmail = $auEmail;

        return $this;
    }

    /**
     * Get auEmail
     *
     * @return string
     */
    public function getAuEmail()
    {
        return $this->auEmail;
    }

    /**
     * Set auTelefon
     *
     * @param string $auTelefon
     *
     * @return AgenturUser
     */
    public function setAuTelefon($auTelefon)
    {
        $this->auTelefon = $auTelefon;

        return $this;
    }

    /**
     * Get auTelefon
     *
     * @return string
     */
    public function getAuTelefon()
    {
        return $this->auTelefon;
    }

    /**
     * Set auScanAll
     *
     * @param boolean $auScanAll
     *
     * @return AgenturUser
     */
    public function setAuScanAll($auScanAll)
    {
        $this->auScanAll = $auScanAll;

        return $this;
    }

    /**
     * Get auScanAll
     *
     * @return boolean
     */
    public function getAuScanAll()
    {
        return $this->auScanAll;
    }

    public function getRoles()
    {
        
        if($this->getAuVid()){

            if($this->getAuVid()->getAvId() == 60){

                $role[] = "ROLE_SUPER_ADMIN";

            } else {

                switch($this->auArt){
                    case 3:
                        $role[] = "ROLE_VERTRIEB";
                        break;
                    case 2:
                        $role[] = "ROLE_VERTRIEB_ADMIN";
                        break;
                    case 1:
                        $role[] = "ROLE_SCANNER";
                        break;
                }

            }

            $typ = $this->getAuVid()->getAvArt();

            switch ($typ) {
                case 1:
                    $role[] = "ROLE_VERTRIEB_ACCOUNT_PARTNER";
                    break;
                case 2:
                    $role[] = "ROLE_VERTRIEB_ACCOUNT_VERMITTLER";
                    break;
                case 3:
                    $role[] = "ROLE_VERTRIEB_ACCOUNT_VERMITTLER";
                    $role[] = "ROLE_VERTRIEB_ACCOUNT_PARTNER";
                    break;
            }
        }

        return $role;
    }

    public function getPassword()
    {
        return $this->auPw;
    }

    public function setPassword($pw = null){


        if( false === empty($pw) ) {
            $this->auPw = $pw;
        } else {

            if($this->auPw){

                $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
                $pass = array();
                $alphabetlength = strlen($alphabet) - 1;

                for ($i = 0; $i < 8; $i++) {
                    $n = rand(0, $alphabetlength);
                    $pass[$i] = $alphabet[$n];
                }

                $this->auPw = implode($pass);

            } else {
                $this->auPw = "abc123";
            }
        }

        return $this->auPw;

    }
    public function getSalt()
    {
        return false;
    }

    public function getUsername()
    {
        return $this->auBn;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist(){

    }

    /**
     * @return AgenturLogin
     */
    public function getAuLogs()
    {
        return $this->auLogs;
    }

    /**
     * @param AgenturLogin $auLogs
     */
    public function setAuLogs($auLogs)
    {
        $this->auLogs = $auLogs;
    }

    /**
     * @return ShopBestellungen
     */
    public function getAuVorgaenge()
    {
        return $this->auVorgaenge;
    }

    /**
     * @param ShopBestellungen $auVorgaenge
     */
    public function setAuVorgaenge($auVorgaenge)
    {
        $this->auVorgaenge = $auVorgaenge;
    }

    
}
