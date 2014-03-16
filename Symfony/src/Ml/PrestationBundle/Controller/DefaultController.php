<?php

namespace Ml\PrestationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MlPrestationBundle:Default:index.html.twig', array('name' => $name));
    }
}
