<?php

namespace Ml\TransactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ml\TransactionBundle\Entity\Account;

class TransactionController extends Controller
{
    public function indexAction()
    {
		// On récupère la requête
		$req = $this->get('request');
		$session = $req->getSession();		
		$u = $session->get('user');
		
		if ($u == NULL) {
			return $this->redirect($this->generateUrl('ml_user_add'));
		}
	
        $em = $this->getDoctrine()->getManager();
        
        $compte1 = new Account(100.0);
        $compte2 = new Account(100.0);
        
        $transaction = ($compte1->payment($compte2,50,"Test"));
        
        $em->persist($compte1);
        $em->persist($compte2);
        $em->persist($transaction);
        
        $em->flush();
        
        return $this->render('MlTransactionBundle:Transaction:index.html.twig', array('transaction' => $transaction,
			'user' => $u));
    }
}
