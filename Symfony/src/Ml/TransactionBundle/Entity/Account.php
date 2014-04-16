<?php

namespace Ml\TransactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ml\TransactionBundle\Exception\TransactionException;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Account
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ml\TransactionBundle\Entity\AccountRepository")
 */
class Account
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
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var float
     *
     * @Assert\Range(max=0)
     * @ORM\Column(name="authorizedOverdraft", type="float")
     */
    private $authorizedOverdraft;

    /*********************/
    /***** ACCESSORS *****/
    /*********************/
    
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
     * Set amount
     *
     * @param float $amount
     * @return Account
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }
    
    /**
     * Set authorizedOverdraft
     *
     * @param float $authorizedOverdraft
     * @return Account
     */
    public function setAuthorizedOverdraft($authorizedOverdraft)
    {
        $this->authorizedOverdraft = $authorizedOverdraft;

        return $this;
    }

    /**
     * Get authorizedOverdraft
     *
     * @return float 
     */
    public function getAuthorizedOverdraft()
    {
        return $this->authorizedOverdraft;
    }
    
    /***********************/
    /***** CONSTRUCTOR *****/
    /***********************/
    
    public function __construct($amount=0.0,$authorizedOverdraft=0.0) {
        /* Par défaut, aucun découvert n'est autorisé */
        $this->amount = $amount;
        $this->authorizedOverdraft = $authorizedOverdraft;
    }
    
    /*******************/
    /***** METHODS *****/
    /*******************/
    
    /**
     * Credit the amount
     * 
     * @return float The new amount
     */
     private function pay($amount) {
        $this->amount += $amount;
        
        return $this->amount;
     }
     
     /**
     * Debit the amount
     * 
     * @return float The new amount
     */
     private function withdraw($amount) {
     
        $this->amount -= $amount;
        
        return $this->amount;
     }

    /**
     * Pay another account
     *
     * @return The transaction done
     */    
    public function payment(&$target,$amount,$flag="") {
        
        /* Test des préconditions : la cible existe, le montant est positif et le compte peut effectuer le paiement. */
        if(get_class($target) != "Ml\TransactionBundle\Entity\Account") throw new \Exception("Invalid argument : ".get_class($target));
        if($amount <= 0) throw new TransactionException("\$amount argument has to be positive.");
        if($this->getAmount()-$amount < $this->authorizedOverdraft) throw new RefusedTransactionException("Insufficient fund.");
        
        $this->withdraw($amount);
        $target->pay($amount);
            
        return new Transaction($this,$target,$amount,$flag);
  
    }

}
