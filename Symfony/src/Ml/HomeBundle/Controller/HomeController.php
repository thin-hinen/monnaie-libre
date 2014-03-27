<?php

namespace Ml\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('MlHomeBundle:Home:index.html.twig');
    }
}
