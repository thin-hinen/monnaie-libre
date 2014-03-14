<?php

namespace Ml\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Ml\UserBundle\Entity\User;

class UserController extends Controller
{
	public function indexAction()
	{
		return $this->render('MlUserBundle:User:index.html.twig');
	}
	
}