<?php

namespace Ml\PrestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Covoiturage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ml\PrestationBundle\Entity\CovoiturageRepository")
 */
class Covoiturage
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="blob", nullable=true)
     */
    private $commentaire;

    /**
     * @var boolean
     *
     * @ORM\Column(name="signaler", type="boolean")
     */
    private $signaler;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visibilite", type="boolean")
     */
    private $visibilite;

    /**
     * @var string
     *
     * @ORM\Column(name="villeDepart", type="string", length=255)
     */
    private $villeDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="villeArrivee", type="string", length=255)
     */
    private $villeArrivee;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuRDV", type="string", length=255)
     */
    private $lieuRDV;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuDeDepose", type="string", length=255)
     */
    private $lieuDeDepose;

    /**
     * @var string
     *
     * @ORM\Column(name="detours", type="string", length=255, nullable=true)
     */
    private $detours;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDepart", type="datetime")
     */
    private $dateDepart;

    /**
     * @var integer
     *
     * @ORM\Column(name="dureeEstimee", type="integer")
     */
    private $dureeEstimee;

    /**
     * @var integer
     *
     * @ORM\Column(name="distanceEstimee", type="integer")
     */
    private $distanceEstimee;

    /**
     * @var string
     *
     * @ORM\Column(name="transportDeColis", type="string", length=255, nullable=true)
     */
    private $transportDeColis;

    /**
     * @var integer
     *
     * @ORM\Column(name="tailleDesBagages", type="integer")
     */
    private $tailleDesBagages;

    /**
     * @var string
     *
     * @ORM\Column(name="vehicule", type="string", length=255)
     */
    private $vehicule;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fumeur", type="boolean")
     */
    private $fumeur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="animaux", type="boolean")
     */
    private $animaux;

    /**
     * @var boolean
     *
     * @ORM\Column(name="musique", type="boolean")
     */
    private $musique;
	
	/**
   * @ORM\ManyToOne(targetEntity="Ml\UserBundle\Entity\User")
   */
	private $users;
	
	public function __construct() {
		$this->dateDepart = date_create(date('Y-m-d'));
		$this->dateCreation = date_create(date('Y-m-d'));
		$this->signaler = false;
		$this->visibilite = true;
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
	
	// Getter et setter pour l'entité User
	  public function setUsers(Ml\UserBundle\Entity\User $users)
	  {
		$this->users = $users;
	  }
	  public function getUsers()
	  {
		return $this->users;
	  }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Covoiturage
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Covoiturage
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Covoiturage
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    
        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set signaler
     *
     * @param boolean $signaler
     * @return Covoiturage
     */
    public function setSignaler($signaler)
    {
        $this->signaler = $signaler;
    
        return $this;
    }

    /**
     * Get signaler
     *
     * @return boolean 
     */
    public function getSignaler()
    {
        return $this->signaler;
    }

    /**
     * Set visibilite
     *
     * @param boolean $visibilite
     * @return Covoiturage
     */
    public function setVisibilite($visibilite)
    {
        $this->visibilite = $visibilite;
    
        return $this;
    }

    /**
     * Get visibilite
     *
     * @return boolean 
     */
    public function getVisibilite()
    {
        return $this->visibilite;
    }

    /**
     * Set villeDepart
     *
     * @param string $villeDepart
     * @return Covoiturage
     */
    public function setVilleDepart($villeDepart)
    {
        $this->villeDepart = $villeDepart;
    
        return $this;
    }

    /**
     * Get villeDepart
     *
     * @return string 
     */
    public function getVilleDepart()
    {
        return $this->villeDepart;
    }

    /**
     * Set villeArrivee
     *
     * @param string $villeArrivee
     * @return Covoiturage
     */
    public function setVilleArrivee($villeArrivee)
    {
        $this->villeArrivee = $villeArrivee;
    
        return $this;
    }

    /**
     * Get villeArrivee
     *
     * @return string 
     */
    public function getVilleArrivee()
    {
        return $this->villeArrivee;
    }

    /**
     * Set lieuRDV
     *
     * @param string $lieuRDV
     * @return Covoiturage
     */
    public function setLieuRDV($lieuRDV)
    {
        $this->lieuRDV = $lieuRDV;
    
        return $this;
    }

    /**
     * Get lieuRDV
     *
     * @return string 
     */
    public function getLieuRDV()
    {
        return $this->lieuRDV;
    }

    /**
     * Set lieuDeDepose
     *
     * @param string $lieuDeDepose
     * @return Covoiturage
     */
    public function setLieuDeDepose($lieuDeDepose)
    {
        $this->lieuDeDepose = $lieuDeDepose;
    
        return $this;
    }

    /**
     * Get lieuDeDepose
     *
     * @return string 
     */
    public function getLieuDeDepose()
    {
        return $this->lieuDeDepose;
    }

    /**
     * Set detours
     *
     * @param string $detours
     * @return Covoiturage
     */
    public function setDetours($detours)
    {
        $this->detours = $detours;
    
        return $this;
    }

    /**
     * Get detours
     *
     * @return string 
     */
    public function getDetours()
    {
        return $this->detours;
    }

    /**
     * Set dateDepart
     *
     * @param \DateTime $dateDepart
     * @return Covoiturage
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;
    
        return $this;
    }

    /**
     * Get dateDepart
     *
     * @return \DateTime 
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * Set dureeEstimee
     *
     * @param integer $dureeEstimee
     * @return Covoiturage
     */
    public function setDureeEstimee($dureeEstimee)
    {
        $this->dureeEstimee = $dureeEstimee;
    
        return $this;
    }

    /**
     * Get dureeEstimee
     *
     * @return integer 
     */
    public function getDureeEstimee()
    {
        return $this->dureeEstimee;
    }

    /**
     * Set distanceEstimee
     *
     * @param integer $distanceEstimee
     * @return Covoiturage
     */
    public function setDistanceEstimee($distanceEstimee)
    {
        $this->distanceEstimee = $distanceEstimee;
    
        return $this;
    }

    /**
     * Get distanceEstimee
     *
     * @return integer 
     */
    public function getDistanceEstimee()
    {
        return $this->distanceEstimee;
    }

    /**
     * Set transportDeColis
     *
     * @param string $transportDeColis
     * @return Covoiturage
     */
    public function setTransportDeColis($transportDeColis)
    {
        $this->transportDeColis = $transportDeColis;
    
        return $this;
    }

    /**
     * Get transportDeColis
     *
     * @return string 
     */
    public function getTransportDeColis()
    {
        return $this->transportDeColis;
    }

    /**
     * Set tailleDesBagages
     *
     * @param integer $tailleDesBagages
     * @return Covoiturage
     */
    public function setTailleDesBagages($tailleDesBagages)
    {
        $this->tailleDesBagages = $tailleDesBagages;
    
        return $this;
    }

    /**
     * Get tailleDesBagages
     *
     * @return integer 
     */
    public function getTailleDesBagages()
    {
        return $this->tailleDesBagages;
    }

    /**
     * Set vehicule
     *
     * @param string $vehicule
     * @return Covoiturage
     */
    public function setVehicule($vehicule)
    {
        $this->vehicule = $vehicule;
    
        return $this;
    }

    /**
     * Get vehicule
     *
     * @return string 
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * Set fumeur
     *
     * @param boolean $fumeur
     * @return Covoiturage
     */
    public function setFumeur($fumeur)
    {
        $this->fumeur = $fumeur;
    
        return $this;
    }

    /**
     * Get fumeur
     *
     * @return boolean 
     */
    public function getFumeur()
    {
        return $this->fumeur;
    }

    /**
     * Set animaux
     *
     * @param boolean $animaux
     * @return Covoiturage
     */
    public function setAnimaux($animaux)
    {
        $this->animaux = $animaux;
    
        return $this;
    }

    /**
     * Get animaux
     *
     * @return boolean 
     */
    public function getAnimaux()
    {
        return $this->animaux;
    }

    /**
     * Set musique
     *
     * @param boolean $musique
     * @return Covoiturage
     */
    public function setMusique($musique)
    {
        $this->musique = $musique;
    
        return $this;
    }

    /**
     * Get musique
     *
     * @return boolean 
     */
    public function getMusique()
    {
        return $this->musique;
    }
}
