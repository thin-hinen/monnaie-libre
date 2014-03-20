<?php

namespace Ml\TransactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @return The transaction done or null
     */    
    public function payment(&$target,$amount,$flag="") {
        
        $transaction = null;
        
        if($this->getAmount() >= $amount) {
        
            $this->withdraw($amount);
            $target->pay($amount);
            
            $transaction = new Transaction($this,$target,$amount,$flag);
        }
        
        return $transaction;
        
    }
}
