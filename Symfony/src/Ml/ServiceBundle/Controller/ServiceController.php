<?php

namespace Ml\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Ml\ServiceBundle\Entity\Service;
use Ml\ServiceBundle\Entity\Carpooling;
use Ml\ServiceBundle\Entity\CarpoolingUser;
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
					$carpoolings = $this->getDoctrine()->getManager()->getRepository('MlServiceBundle:Carpooling')->findByVisibility(true);
					$services[] = $carpoolings;
				}
			}
			else {
				/** Récupération de toutes les Services du site **/
				$carpoolings = $this->getDoctrine()->getManager()->getRepository('MlServiceBundle:Carpooling')->findByVisibility(true);
				$services[] = $carpoolings;
			}
		}
		else {
			/** Récupération de toutes les Services du site **/
			$carpoolings = $this->getDoctrine()->getManager()->getRepository('MlServiceBundle:Carpooling')->findByVisibility(true);
			$services[] = $carpoolings;
		}
		
		return $this->render('MlServiceBundle:Service:index.html.twig', array(
		  'servicess'=>$services,
		  'user' => $u));
	}	

	public function seeCarpoolingAction($carpooling = null)
	{
		$em=$this->getDoctrine()->getManager();
		$data_carpooling=$em->getRepository('MlServiceBundle:Carpooling')->findOneById($carpooling);
		
		// Si le Service demandé n'existe pas 
		if($data_carpooling == null){
			return $this->redirect($this->generateUrl('ml_service_homepage'));
		}
		
		if($data_carpooling->getVisibility() == false) {
			return $this->redirect($this->generateUrl('ml_service_homepage'));
		}
		
		// On récupère la requête
		$req = $this->get('request');
		$session = $req->getSession();		
		$u = $session->get('user');
		
		if ($u == NULL) {
			return $this->redirect($this->generateUrl('ml_user_add'));
		}
		
		if($req->getMethod() != 'POST'){			
			//Si elle existe, elle est envoyée à la vue 
			return $this->render('MlServiceBundle:Service:see_carpooling.html.twig', array(
																						'departure' => $data_carpooling->getDeparture(),
																						'arrival' => $data_carpooling->getArrival(),
																						'meetingPoint' => $data_carpooling->getMeetingPoint(),
																						'arrivalPoint' => $data_carpooling->getArrivalPoint(),
																						'bends' => $data_carpooling->getBends(),
																						'departureDate' => $data_carpooling->getDepartureDate()->format("d/m/y"),
																						'creationDate' => $data_carpooling->getCreationDate()->format("d/m/y"),
																						'estimatedDuration' => $data_carpooling->getEstimatedDuration(),
																						'estimatedDistance' => $data_carpooling->getEstimatedDistance(),
																						'packageTransport' => $data_carpooling->getPackageTransport(),
																						'packageSize' => $data_carpooling->getPackageSize(),
																						'car' => $data_carpooling->getCar(),
																						'smoker' => $data_carpooling->getSmoker(),
																						'music' => $data_carpooling->getMusic(),
																						'pets' => $data_carpooling->getPets(),
																						'title' => $data_carpooling->getTitle(),
																						'comment' => $data_carpooling->getComment(),
																						'price' => $data_carpooling->getPrice(),
																						'creator' => $data_carpooling->getUser()->getLogin(),
																						'user' => $u));
		}
		else {				
			$current_user = $em->getRepository('MlUserBundle:User')->findOneByLogin($u);
			
			$carpoolingUser = new CarpoolingUser;
			
			$carpoolingUser->setApplicant($current_user);
			$carpoolingUser->setCarpooling($data_carpooling);
			
			$em->persist($carpoolingUser);
			$em->flush();
			
			$data_carpooling->setVisibility(false);
			
			$em->persist($data_carpooling);
			$em->flush();

			return $this->redirect($this->generateUrl('ml_service_homepage'));
		}
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
