<?php

namespace Ml\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Ml\UserBundle\Entity\User;
use Ml\UserBundle\Form\UserType;

class UserController extends Controller
{
	public function indexAction()
	{
		/* Test connexion */
		$req = $this->get('request');
		try {		
		    $user = $this->sessionExist($req);
		}
		catch (\Exception $e) {
		    return $this->redirect($this->generateUrl('ml_user_add'));		    
		}

	
		/* Récupération de tout les users du site */
		//$users = $this->getDoctrine()->getManager()->getRepository('MlUserBundle:User')->findAll();

		return $this->render('MlUserBundle:User:index.html.twig', array(/*'users'=>$users,*/
		  'user' => $user));
	}	

	public function seeAction()
	{
		/* Test connexion */
		$req = $this->get('request');		
		$user = $this->sessionExist($req);
	
		/** S'il existe, il est envoyé à la vue **/
		return $this->render('MlUserBundle:User:see.html.twig', array('user' => $user));

	}
	
	public function addAction()
	{
		/* Test connexion */
		$req = $this->get('request');	
		try {	
		    $this->sessionExist($req);
		}
		catch (\Exception $e) {
		    /* Création d'un nouvel utilisateur */	
		    $user = new User;
		
		    $form = $this->createForm(new UserType(),$user);

		    /* Vérification de non doublon du login */
		    if($req->getMethod() == 'POST'){
			    $form->bind($req);
			    $userExisteDeja = $this->getDoctrine()
			    ->getRepository('MlUserBundle:User')
			    ->findOneByLogin($form->getData()->getLogin());
			
			    /* Doublon -> inscription impossible */
			    if($userExisteDeja != NULL) {
				    return $this->render('MlUserBundle:User:add.html.twig', array(
					      'form' => $form->createView(),
					      'erreur' => "Le login saisi est déjà pris, veuillez en choisir un autre"));
			    }
		
			    /* Aucun doublon -> inscription possible. Génération du formulaire d'inscription */

			    if($form->isValid()){
				    $em=$this->getDoctrine()->getManager();
				    $em->persist($user);
				    $em->flush();

				    $this->get('session')->getFlashBag()->add('inscription','Bienvenue dans notre communauté');
				    $this->get('session')->set('login', $form->getData()->getLogin()); 

				    return $this->redirect($this->generateUrl('ml_user_see'));
			    }
		    }
		    /* Formulaire non valide -> rechargement de la page */
		    return $this->render('MlUserBundle:User:add.html.twig', array('form' => $form->createView()));
		}
		return $this->redirect($this->generateUrl('ml_user_see'));		
	}

	public function deleteAction(User $user)
	{
		/* Test connexion */
		$req = $this->get('request');
		$user=$this->sessionExist($req);
	
		$form=$this->createFormBuilder()->getForm();

		/* Demande de formulaire de désinscription */
		if($req->getMethod() == 'POST'){
			$form->bind($req);
			if($form->isValid()){
				$em=$this->getDoctrine()->getManager();
				$em->remove($user);
				$em->flush();


				/* Redirection vers l'accueil du site */
				return $this->redirect($this->generateUrl('ml_user_homepage'));
			}
		}
		/* Formulaire non valide -> rechargement de la page */
		return $this->render('MlUserBundle:User:delete.html.twig', array('user'=>$user,
																		'form'=>$form->createView()));
	}
	
	public function connexionAction() {
		// On récupère la requête
		$request = $this->get('request');

		/* Demande de connexion */
		if ($request->getMethod() == 'POST') {
			$user = $this->getDoctrine()
						->getRepository('MlUserBundle:User')
						->findBy(array('login' => $request->request->get('login'),
										'password' => $request->request->get('mot_de_passe')));
			/* login+password OK -> redirection vers notre page */
			if ($user != NULL) {
				$session = new Session();
				$session->start();
			
				$session->set('login', $request->request->get('login')); 
				
				return $this->render('MlUserBundle:User:index.html.twig', array(
					'user' => $this->sessionExist($request)));
			}
			else { /* login+password FAIL -> redirection inscription */
				return $this->redirect($this->generateUrl('ml_user_add'));
			}
		}
	
		/* Premier accès à la page de connexion */
		return $this->render('MlUserBundle:User:index.html.twig');
	}
	
	public function deconnexionAction() {
		// On récupère la requête
		$request = $this->get('request');
		$session = $request->getSession();		

		/* Deconnexion -> redirection vers la page d'accueil */
		$session->invalidate();
		return $this->redirect($this->generateUrl('ml_user_add'));
	}

	private function sessionExist($req){
		// On récupère la requête
		$session = $req->getSession();		
		$login = $session->get('login');

		/* Si on est pas logger -> redirection vers la page d'inscription */
		if ($login == NULL) {
			throw new \Exception("Non connecté");//$this->redirect($this->generateUrl('ml_user_add'));
		}
		
		return $this->getDoctrine()
			->getRepository('MlUserBundle:User')
			->findOneByLogin($login);;
	}
	

}
