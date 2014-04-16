<?php

namespace Ml\TransactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Transaction
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ml\TransactionBundle\Entity\TransactionRepository")
 */
class Transaction
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
	 * @Assert\Date
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var float
     *
     * @Assert\GreaterThan(value=0,
	 *			     message="Amount's transaction must be positive")
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="flag", type="string", length=255)
     */
    private $flag;

    /**
     * @ORM\ManyToOne(targetEntity="Ml\TransactionBundle\Entity\Account",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
     private $debitedAccount;

    /**
     * @ORM\ManyToOne(targetEntity="Ml\TransactionBundle\Entity\Account",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
     private $creditedAccount;

    /**
     * Create a new transaction with parameters.
     */
    public function __construct($debited,$credited,$amount,$flag) {
        $this->setDebitedAccount($debited);
        $this->setCreditedAccount($credited);
        $this->setAmount($amount);
        $this->setFlag($flag);
        $this->setDate(new \DateTime());
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
     * Set date
     *
     * @param \DateTime $date
     * @return Transaction
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return Transaction
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
     * Set flag
     *
     * @param string $flag
     * @return Transaction
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return string 
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set DebitedAccount
     *
     * @param \Ml\TransactionBundle\Entity\Account $DebitedAccount
     * @return Transaction
     */
    public function setDebitedAccount(\Ml\TransactionBundle\Entity\Account $debitedAccount)
    {
        $this->debitedAccount = $debitedAccount;

        return $this;
    }

    /**
     * Get DebitedAccount
     *
     * @return \Ml\TransactionBundle\Entity\Account 
     */
    public function getDebitedAccount()
    {
        return $this->debitedAccount;
    }

    /**
     * Set CreditedAccount
     *
     * @param \Ml\TransactionBundle\Entity\Account $CreditedAccount
     * @return Transaction
     */
    public function setCreditedAccount(\Ml\TransactionBundle\Entity\Account $creditedAccount)
    {
        $this->creditedAccount = $creditedAccount;

        return $this;
    }

    /**
     * Get CreditedAccount
     *
     * @return \Ml\TransactionBundle\Entity\Account 
     */
    public function getCreditedAccount()
    {
        return $this->creditedAccount;
    }
}
