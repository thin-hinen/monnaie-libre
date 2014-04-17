<?php

namespace Ml\TransactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ml\TransactionBundle\Entity\Account;
use Ml\TransactionBundle\Form\TransactionType;
use Ml\UserBundle\Entity\User;

class TransactionController extends Controller
{
    public function indexAction() {
		/* Test connexion */
		$req = $this->get('request');
		
        try {		
		    $login = $this->container->get('ml.session')->sessionExist($req);
		}
		catch (\Exception $e) {
		    return $this->redirect($this->generateUrl('ml_user_add'));		    
		}
		
        $user = $this->getDoctrine()
			->getRepository('MlUserBundle:User')
			->findOneByLogin($login);

		// On récupère les transactions sortantes
		$outTransactions = $this->getDoctrine()->getManager()->getRepository('MlTransactionBundle:Transaction')->findBy(array("debitedAccount" => $user),array('date' => 'DESC'));
		
		// Puis les entrantes
		$inTransactions = $this->getDoctrine()->getManager()->getRepository('MlTransactionBundle:Transaction')->findBy(array("creditedAccount" => $user),array('date' => 'DESC'));
		
		return $this->render('MlTransactionBundle:Transaction:index.html.twig', array(
		  'outTransactions' => $outTransactions,
		  'inTransactions' => $inTransactions,
		  'user' => $user));
    }
}
