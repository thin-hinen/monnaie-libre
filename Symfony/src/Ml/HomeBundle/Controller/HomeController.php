<?php

namespace Ml\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
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
	
        return $this->render('MlHomeBundle:Home:index.html.twig', array(
		  'user' => $u));
    }
}
