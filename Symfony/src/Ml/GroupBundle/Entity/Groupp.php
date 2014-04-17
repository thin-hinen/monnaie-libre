<?php

namespace Ml\GroupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupp
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ml\GroupBundle\Entity\GrouppRepository")
 */
class Groupp
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
	  * @ORM\ManyToOne(targetEntity="Ml\UserBundle\Entity\User")
	  */
    private $administrator;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


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
     * Set name
     *
     * @param string $name
     * @return Groupp
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

    // Getter et setter pour l'entité User
	  public function setAdministrator(\Ml\UserBundle\Entity\User $administrator) {
		$this->administrator = $administrator;
	  }
	  public function getAdministrator() {
		return $this->administrator;
	  }

    /**
     * Set description
     *
     * @param string $description
     * @return Groupp
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
