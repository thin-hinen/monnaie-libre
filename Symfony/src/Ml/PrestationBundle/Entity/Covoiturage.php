<?php

namespace Ml\PrestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ml\PrestationBundle\Entity\Prestation;


/**
 * Covoiturage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ml\PrestationBundle\Entity\CovoiturageRepository")
 */
class Covoiturage extends Prestation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @ORM\Column(name="detours", type="string", length=255)
     */
    private $detours;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDepart", type="datetime")
     */
    private $dateDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="dureeEstimee", type="string", length=255)
     */
    private $dureeEstimee;

    /**
     * @var string
     *
     * @ORM\Column(name="distanceEstimee", type="string", length=255)
     */
    private $distanceEstimee;

    /**
     * @var string
     *
     * @ORM\Column(name="transportDeColis", type="string", length=255)
     */
    private $transportDeColis;

    /**
     * @var string
     *
     * @ORM\Column(name="tailleDesBagages", type="string", length=255)
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
     * @param string $dureeEstimee
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
     * @return string 
     */
    public function getDureeEstimee()
    {
        return $this->dureeEstimee;
    }

    /**
     * Set distanceEstimee
     *
     * @param string $distanceEstimee
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
     * @return string 
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
     * @param string $tailleDesBagages
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
     * @return string 
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
