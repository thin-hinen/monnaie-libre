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
		$u = $session->get('utilisateur');
	
        return $this->render('MlHomeBundle:Home:index.html.twig', array(
		  'utilisateur' => $u));
    }
}
