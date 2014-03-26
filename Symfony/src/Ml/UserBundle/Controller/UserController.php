<?php

namespace Ml\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Ml\UserBundle\Entity\User;
use Ml\UserBundle\Form\UserType;

class UserController extends Controller
{
	public function indexAction()
	{
		/** Récupération de tout les users du site **/
		$users = $this->getDoctrine()->getManager()->getRepository('MlUserBundle:User')->findAll();

		return $this->render('MlUserBundle:User:index.html.twig',array('users'=>$users));
	}	

	public function seeAction()
	{
		$em=$this->getDoctrine()->getManager();
		$user=$em->getRepository('MlUserBundle:User')->find('2');
		
		/** Si l'utilisateur demandé n'existe pas **/
		if($user === null){
			//throw $this->createNotFoundException('L\'utilisateur [id'.$id.'] n\'est pas renseigné dans notre base de données');
			throw $this->createNotFoundException('L\'utilisateur 2 n\'est pas renseigné dans notre base de données');
		}
		
		/** S'il existe, il est envoyé à la vue **/
		return $this->render('MlUserBundle:User:see.html.twig', array('lastName' => $user->getLastName(),
																	'firstName' => $user->getFirstName(),
																	'login' => $user->getLogin(),
																	'dateNaissance' => $user->getDateNaissance()->format("d/m/y"),
																	'karma' => $user->getKarma(),
																	'premium' => $user->getPremium()));

	}
	
	public function addAction(){
		$user = new User;
		
		$form = $this->createForm(new UserType(),$user);

		$req=$this->getRequest();

		if($req->getMethod() == 'POST'){
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
		return $this->render('MlUserBundle:User:add.html.twig', array('form' => $form->createView()));
	}

	public function deleteAction(User $user)
	{
		$form=$this->createFormBuilder()->getForm();
		$req = $this->getRequest();
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
		return $this->render('MlUserBundle:User:delete.html.twig', array('user'=>$user, 'form'=>$form->createView()));
	}

}
