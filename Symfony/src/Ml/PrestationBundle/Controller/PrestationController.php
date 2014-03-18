<?php

namespace Ml\PrestationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Ml\PrestationBundle\Entity\Prestation;

class PrestationController extends Controller
{
	public function indexAction()
	{
		return $this->render('MlPrestationBundle:Prestation:index.html.twig');
	}
	
}
