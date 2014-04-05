<?php

namespace Ml\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Ml\ServiceBundle\Entity\Service;
use Ml\ServiceBundle\Entity\Carpooling;
use Ml\ServiceBundle\Form\CarpoolingType;
use Ml\UserBundle\Entity\User;

class ServiceController extends Controller
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
		
		if ($req->getMethod() == 'POST') {
			$carpooling = false;
		
			if ($req->request->get('type') != null) {
				foreach ($req->request->get('type') as $cle => $valeur) {
					if ($valeur == 'carpooling') {
						$carpooling = true;
					}
				}
				
				if ($carpooling == true) {
					$carpoolings = $this->getDoctrine()->getManager()->getRepository('MlServiceBundle:Carpooling')->findAll();
					$services[] = $carpoolings;
				}
			}
		}
		else {
			/** Récupération de toutes les Services du site **/
			$carpoolings = $this->getDoctrine()->getManager()->getRepository('MlServiceBundle:Carpooling')->findAll();
			$services[] = $carpoolings;
		}
		return $this->render('MlServiceBundle:Service:index.html.twig', array(
		  'servicess'=>$services,
		  'user' => $u));
	}	

	public function seeCarpoolingAction($carpooling = null)
	{
		// On récupère la requête
		$req = $this->get('request');
		$session = $req->getSession();		
		$u = $session->get('user');
		
		if ($u == NULL) {
			return $this->redirect($this->generateUrl('ml_user_add'));
		}
	
		$em=$this->getDoctrine()->getManager();
		$service=$em->getRepository('MlServiceBundle:Carpooling')->findOneById($carpooling);
		
		// Si le Service demandé n'existe pas 
		if($service == null){
			return $this->redirect($this->generateUrl('ml_service_homepage'));
		}
		
		//Si elle existe, elle est envoyée à la vue 
		return $this->render('MlServiceBundle:Service:see_carpooling.html.twig', array(
																					'departure' => $service->getDeparture(),
																					'arrival' => $service->getArrival(),
																					'meetingPoint' => $service->getMeetingPoint(),
																					'arrivalPoint' => $service->getArrivalPoint(),
																					'bends' => $service->getBends(),
																					'departureDate' => $service->getDepartureDate()->format("d/m/y"),
																					'creationDate' => $service->getCreationDate()->format("d/m/y"),
																					'estimatedDuration' => $service->getEstimatedDuration(),
																					'estimatedDistance' => $service->getEstimatedDistance(),
																					'packageTransport' => $service->getPackageTransport(),
																					'packageSize' => $service->getPackageSize(),
																					'car' => $service->getCar(),
																					'smoker' => $service->getSmoker(),
																					'music' => $service->getMusic(),
																					'pets' => $service->getPets(),
																					'title' => $service->getTitle(),
																					'comment' => $service->getComment(),
																					'price' => $service->getPrice(),
																					'creator' => $service->getUser()->getLogin(),
																					'user' => $u));
	}
	
	public function addCarpoolingAction(){
		// On récupère la requête
		$req = $this->get('request');
		$session = $req->getSession();		
		$u = $session->get('user');
		
		if ($u == NULL) {
			return $this->redirect($this->generateUrl('ml_user_add'));
		}
	
		$carpooling = new Carpooling;
		
		$form = $this->createForm(new CarpoolingType(),$carpooling);


		if($req->getMethod() == 'POST'){
			//lien requête<->form
			$form->bind($req);

			if($form->isValid()){			
				$em=$this->getDoctrine()->getManager();
				
				$current_user=$em->getRepository('MlUserBundle:User')->findOneByLogin($u);
				$carpooling->setUser($current_user);
				
				$em->persist($carpooling);
				$em->flush();

				//$this->get('session')->getFlashBag->add('ajouter', 'Votre service est ajoutée');
				
				$carpooling_id = $carpooling->getId();

				return $this->redirect($this->generateUrl('ml_service_see_carpooling', array('carpooling' => $carpooling_id)));
			}
		}
		// si le form n'est pas valide, on le redemande
		return $this->render('MlServiceBundle:Service:add_carpooling.html.twig', array(
			'form' => $form->createView(),
		    'user' => $u));
	}

	public function deleteCarpoolingAction(/*Service $service*/)
	{
		// On récupère la requête
		$req = $this->get('request');
		$session = $req->getSession();		
		$u = $session->get('user');
		
		if ($u == NULL) {
			return $this->redirect($this->generateUrl('ml_user_add'));
		}
	
		$em=$this->getDoctrine()->getManager();
		$service=$em->getRepository('MlServiceBundle:Carpooling')->findById('3');
		
		$em->remove($service[0]);
		$em->flush();

		//$this->get('session')->getFlashBag->add('supprimer','Votre service a été supprimé');
		return $this->redirect($this->generateUrl('ml_service_homepage'));
	}
}
