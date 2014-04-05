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
		// On récupère la requête
		$req = $this->get('request');
		$session = $req->getSession();		
		$u = $session->get('user');
		
		if ($u == NULL) {
			return $this->redirect($this->generateUrl('ml_user_add'));
		}
	
		/** Récupération de tout les users du site **/
		$users = $this->getDoctrine()->getManager()->getRepository('MlUserBundle:User')->findAll();

		return $this->render('MlUserBundle:User:index.html.twig', array('users'=>$users,
		  'user' => $u));
	}	

	public function seeAction()
	{
		// On récupère la requête
		$req = $this->get('request');
		$session = $req->getSession();		
		$u = $session->get('user');
		
		if ($u == NULL) {
			return $this->redirect($this->generateUrl('ml_user_add'));
		}
	
		$em=$this->getDoctrine()->getManager();
		$user=$em->getRepository('MlUserBundle:User')->findByLogin($u);
		
		/** Si l'user demandé n'existe pas **/
		if($user === null){
			//throw $this->createNotFoundException('L\'user [id'.$id.'] n\'est pas renseigné dans notre base de données');
			throw $this->createNotFoundException('L\'user 2 n\'est pas renseigné dans notre base de données');
		}
		
		/** S'il existe, il est envoyé à la vue **/
		return $this->render('MlUserBundle:User:see.html.twig', array('lastName' => $user[0]->getLastName(),
																	'firstName' => $user[0]->getFirstName(),
																	'login' => $user[0]->getLogin(),
																	'dateNaissance' => $user[0]->getDateNaissance()->format("d/m/y"),
																	'karma' => $user[0]->getKarma(),
																	'premium' => $user[0]->getPremium(),
																	'user' => $u));

	}
	
	public function addAction() {
		// On récupère la requête
		$req = $this->get('request');
		$session = $req->getSession();		
		$u = $session->get('user');
		
		if ($u != NULL) {
			return $this->redirect($this->generateUrl('ml_home_homepage'));
		}
	
		$user = new User;
		
		$form = $this->createForm(new UserType(),$user);

		if($req->getMethod() == 'POST'){
			$user_existe_deja = $this->getDoctrine()
			->getRepository('MlUserBundle:User')
			->findOneByLogin($req->request->get("form")['login']);
			
			if($user_existe_deja != NULL) {
				return $this->render('MlUserBundle:User:add.html.twig', array(
					  'form' => $form->createView(),
					  'user' => $u,
					  'erreur' => "Le login saisi est déjà pris, veuillez en choisir un autre"));
			}
		
			/**lien requête<->formulaire**/
			$form->bind($req);

			if($form->isValid()){
				$em=$this->getDoctrine()->getManager();
				$em->persist($user);
				$em->flush();

				//$this->get('session')->getFlashBag->add('inscription','Bienvenue dans notre communauté');

				return $this->redirect($this->generateUrl('ml_user_see'/*, array('id' => $user->getId())*/));
			}
		}
		/** si le formulaire n'est pas valide, on le redemande*/
		return $this->render('MlUserBundle:User:add.html.twig', array('form' => $form->createView(),
																	'user' => $u));
	}

	public function deleteAction(User $user)
	{
		// On récupère la requête
		$req = $this->get('request');
		$session = $req->getSession();		
		$u = $session->get('user');
		
		if ($u == NULL) {
			return $this->redirect($this->generateUrl('ml_user_add'));
		}
	
		$form=$this->createFormBuilder()->getForm();

		if($req->getMethod() == 'POST'){
			$form->bind($req);
			if($form->isValid()){
				$em=$this->getDoctrine()->getManager();
				$em->remove($user);
				$em->flush();

				//$this->get('session')->getFlashBag->add('désinscription','Nous sommes triste de vous voir partir... :\'-(');
				
				/** ici, plus tard, renvoyer vers l'accueil du site **/
				return $this->redirect($this->generateUrl('ml_user_homepage'));
			}
		}
		/** si le formulaire n'est pas valide, on le redemande*/
		return $this->render('MlUserBundle:User:delete.html.twig', array('user'=>$user, 
																		'form'=>$form->createView(),
																		'user' => $u));
	}
	
	public function connexionAction() {
		// On récupère la requête
		$request = $this->get('request');

		// On vérifie qu'elle est de type POST
		if ($request->getMethod() == 'POST') {
			$user = $this->getDoctrine()
						->getRepository('MlUserBundle:User')
						->findBy(array('login' => $request->request->get('login'),
										'password' => $request->request->get('mot_de_passe')));
		
			if ($user != NULL) {
				$session = new Session();
				$session->start();
			
				$session->set('user', $request->request->get('login')); 
				
				return $this->render('MlUserBundle:User:index.html.twig', array(
					'user' => $session->get('user')));
			}
			else {
				return $this->redirect($this->generateUrl('ml_user_add'));
			}
		}
	
		return $this->render('MlUserBundle:User:index.html.twig');
	}
	
	public function deconnexionAction() {
		// On récupère la requête
		$request = $this->get('request');
		$session = $request->getSession();		

		$session->invalidate();
		
		return $this->redirect($this->generateUrl('ml_user_add'));
	}

}
