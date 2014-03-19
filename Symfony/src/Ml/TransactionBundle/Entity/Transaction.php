<?php

namespace Ml\TransactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var float
     *
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
     private $debtor;

    /**
     * @ORM\ManyToOne(targetEntity="Ml\TransactionBundle\Entity\Account",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
     private $creditor;

    /**
     * Create a new transaction with parameters.
     */
    public function __constructor($debtor,$creditor,$amount,$flag) {
        $this->setDebtor($debtor);
        $this->setCreditor($creditor);
        $this->setAmount($amount);
        $this->setFlag($flag);
        $this->setDate(time());
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
     * Set debtor
     *
     * @param \Ml\TransactionBundle\Entity\Account $debtor
     * @return Transaction
     */
    public function setDebtor(\Ml\TransactionBundle\Entity\Account $debtor)
    {
        $this->debtor = $debtor;

        return $this;
    }

    /**
     * Get debtor
     *
     * @return \Ml\TransactionBundle\Entity\Account 
     */
    public function getDebtor()
    {
        return $this->debtor;
    }

    /**
     * Set creditor
     *
     * @param \Ml\TransactionBundle\Entity\Account $creditor
     * @return Transaction
     */
    public function setCreditor(\Ml\TransactionBundle\Entity\Account $creditor)
    {
        $this->creditor = $creditor;

        return $this;
    }

    /**
     * Get creditor
     *
     * @return \Ml\TransactionBundle\Entity\Account 
     */
    public function getCreditor()
    {
        return $this->creditor;
    }
}
