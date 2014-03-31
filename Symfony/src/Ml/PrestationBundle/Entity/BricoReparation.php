<?php

namespace Ml\PrestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BricoReparation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ml\PrestationBundle\Entity\BricoReparationRepository")
 */
class BricoReparation
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
     * @var \DateTime
     *
     * @ORM\Column(name="morningDispB", type="time")
     */
    private $morningDispB;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="morningDispE", type="time")
     */
    private $morningDispE;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="afternoonDispB", type="time")
     */
    private $afternoonDispB;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="afternoonDispE", type="time")
     */
    private $afternoonDispE;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="telNumber", type="string", length=15)
     */
    private $telNumber;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="zipCode", type="string", length=6)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=30)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="department", type="string", length=100)
     */
    private $department;


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
     * Set morningDispB
     *
     * @param \DateTime $morningDispB
     * @return BricolageReparation
     */
    public function setMorningDispB($morningDispB)
    {
        $this->morningDispB = $morningDispB;

        return $this;
    }

    /**
     * Get morningDispB
     *
     * @return \DateTime 
     */
    public function getMorningDispB()
    {
        return $this->morningDispB;
    }

    /**
     * Set morningDispE
     *
     * @param \DateTime $morningDispE
     * @return BricolageReparation
     */
    public function setMorningDispE($morningDispE)
    {
        $this->morningDispE = $morningDispE;

        return $this;
    }

    /**
     * Get morningDispE
     *
     * @return \DateTime 
     */
    public function getMorningDispE()
    {
        return $this->morningDispE;
    }

    /**
     * Set afternoonDispB
     *
     * @param \DateTime $afternoonDispB
     * @return BricolageReparation
     */
    public function setAfternoonDispB($afternoonDispB)
    {
        $this->afternoonDispB = $afternoonDispB;

        return $this;
    }

    /**
     * Get afternoonDispB
     *
     * @return \DateTime 
     */
    public function getAfternoonDispB()
    {
        return $this->afternoonDispB;
    }

    /**
     * Set afternoonDispE
     *
     * @param \DateTime $afternoonDispE
     * @return BricolageReparation
     */
    public function setAfternoonDispE($afternoonDispE)
    {
        $this->afternoonDispE = $afternoonDispE;

        return $this;
    }

    /**
     * Get afternoonDispE
     *
     * @return \DateTime 
     */
    public function getAfternoonDispE()
    {
        return $this->afternoonDispE;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return BricolageReparation
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

    /**
     * Set telNumber
     *
     * @param string $telNumber
     * @return BricolageReparation
     */
    public function setTelNumber($telNumber)
    {
        $this->telNumber = $telNumber;

        return $this;
    }

    /**
     * Get telNumber
     *
     * @return string 
     */
    public function getTelNumber()
    {
        return $this->telNumber;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return BricolageReparation
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     * @return BricolageReparation
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string 
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return BricolageReparation
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set department
     *
     * @param string $department
     * @return BricolageReparation
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return string 
     */
    public function getDepartment()
    {
        return $this->department;
    }
}
