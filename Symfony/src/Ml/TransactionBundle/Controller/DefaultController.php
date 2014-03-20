<?php

namespace Ml\TransactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ml\TransactionBundle\Entity\Account;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $compte1 = new Account();
        $compte2 = new Account();
        $compte1->setAmount(100.0);
        $compte2->setAmount(100.0);
        
        $transaction = ($compte1->payment($compte2,50,"Test"));
        
        $em->persist($compte1);
        $em->persist($compte2);
        $em->persist($transaction);
        
        $em->flush();
        
        return $this->render('MlTransactionBundle:Default:index.html.twig', array('transaction' => $transaction));
    }
}
