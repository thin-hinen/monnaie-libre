<?php

namespace Ml\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ml\UserBundle\Entity\UserRepository")	 
 */
class User
{

	/**
     * @ORM\OneToMany(targetEntity="Ml\PrestationBundle\Entity\Prestation",mappedBy="user",cascade={"persist","remove"})
     */
    //protected $prestations;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="premium", type="boolean")
     */
    private $premium;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
	 * @Assert\Length(
	 *			min="3",
	 *			max="25",
	 *			minMessage="Votre login doit faire au moins 3 caractères",
	 *			maxMessage="Votre login ne peut pas dépasser 25 caractères"
	 *)
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var date
     *
	 * @Assert\Date
     * @ORM\Column(name="birthDate", type="date")
     */
    private $birthDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="karma", type="integer")
     */
    private $karma;
	
	public function __construct() {
		$this->karma = 0;
		$this->dateNaissance = date_create(date('Y-m-d'));
		$this->premium = false;
		$this->prestation = null;
	}


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
     * Set premium
     *
     * @param boolean $premium
     * @return User
     */
    public function setPremium($premium)
    {
        $this->premium = $premium;

        return $this;
    }

    /**
     * Get premium
     *
     * @return boolean 
     */
    public function getPremium()
    {
        return $this->premium;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set birthDate
     *
     * @param integer $birthDate
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return integer 
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set karma
     *
     * @param integer $karma
     * @return User
     */
    public function setKarma($karma)
    {
        $this->karma = $karma;

        return $this;
    }

    /**
     * Get karma
     *
     * @return integer 
     */
    public function getKarma()
    {
        return $this->karma;
    }

    /**
     * Add prestations
     *
     * @param \Ml\PrestationBundle\Entity\Prestation $prestations
     * @return User
     */
    /*public function addPrestation(\Ml\PrestationBundle\Entity\Prestation $prestations)
    {
        $this->prestations = $prestations;
    
        return $this;
    }*/

    /**
     * Remove prestations
     *
     * @param \Ml\PrestationBundle\Entity\Prestation $prestations
     */
   /* public function removePrestation(\Ml\PrestationBundle\Entity\Prestation $prestations)
    {
        $this->prestations->removeElement($prestations);
    }*/

    /**
     * Get prestations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    /*public function getPrestations()
    {
        return $this->prestations;
    }*/
}
