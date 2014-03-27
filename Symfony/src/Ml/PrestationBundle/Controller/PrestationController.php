<?php

namespace Ml\PrestationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Ml\PrestationBundle\Entity\Prestation;
use Ml\PrestationBundle\Entity\Covoiturage;
use Ml\PrestationBundle\Form\CovoiturageType;

class PrestationController extends Controller
{

	public function indexAction()
	{
		// On récupère la requête
		$req = $this->get('request');
		$session = $req->getSession();		
		$u = $session->get('utilisateur');
		
		/** Récupération de toutes les prestations du site **/
		$presta = $this->getDoctrine()->getManager()->getRepository('MlPrestationBundle:Covoiturage')->findAll();

		return $this->render('MlPrestationBundle:Prestation:index.html.twig',array('presta'=>$presta,
		  'utilisateur' => $u));
	}	

	public function seeCovoiturageAction()
	{
		// On récupère la requête
		$req = $this->get('request');
		$session = $req->getSession();		
		$u = $session->get('utilisateur');
	
		$em=$this->getDoctrine()->getManager();
		$presta=$em->getRepository('MlPrestationBundle:Covoiturage')->findById('1');
		
		/** Si la prestation demandée n'existe pas **/
		if(empty($presta) === true){
			//throw $this->createNotFoundException('Le covoiturage [id'.$id.'] n\'est pas renseigné dans notre base de données');
			throw $this->createNotFoundException('Le covoiturage n\'est pas renseigné dans notre base de données');
		}
		
		/** Si elle existe, elle est envoyée à la vue **/
		return $this->render('MlPrestationBundle:Prestation:see_covoiturage.html.twig', array('villeDepart' => $presta[0]->getVilleDepart(),
																							'villeArrivee' => $presta[0]->getVilleArrivee(),
																							'lieuRdv' => $presta[0]->getLieuRDV(),
																							'lieuDepose' => $presta[0]->getLieuDeDepose(),
																							'detours' => $presta[0]->getDetours(),
																							'dateDepart' => $presta[0]->getDateDepart()->format("d/m/y"),
																							'dureeEstimee' => $presta[0]->getDureeEstimee(),
																							'distanceEstimee' => $presta[0]->getDistanceEstimee(),
																							'transportDeColis' => $presta[0]->getTransportDeColis(),
																							'tailleDesBagages' => $presta[0]->getTailleDesBagages(),
																							'vehicule' => $presta[0]->getVehicule(),
																							'fumeur' => $presta[0]->getFumeur(),
																							'musique' => $presta[0]->getMusique(),
																							'animaux' => $presta[0]->getAnimaux(),
																							'titre' => $presta[0]->getTitre(),
																							'commentaire' => $presta[0]->getCommentaire(),
																							'utilisateur' => $u));

	}
	
	public function addCovoiturageAction(){
		// On récupère la requête
		$req = $this->get('request');
		$session = $req->getSession();		
		$u = $session->get('utilisateur');
	
		$covoiturage = new Covoiturage;
		
		$form = $this->createForm(new CovoiturageType(),$covoiturage);


		if($req->getMethod() == 'POST'){
			/**lien requête<->formulaire**/
			$form->bind($req);

			if($form->isValid()){
				$em=$this->getDoctrine()->getManager();
				$em->persist($covoiturage);
				$em->flush();

				//$this->get('session')->getFlashBag->add('ajouter', 'Votre prestation est ajoutée');

				return $this->redirect($this->generateUrl('ml_prestation_see_covoiturage'));
			}
		}
		/** si le formulaire n'est pas valide, on le redemande*/
		return $this->render('MlPrestationBundle:Prestation:add_covoiturage.html.twig', array('form' => $form->createView(),
		  'utilisateur' => $u));
	}

	public function deleteCovoiturageAction(/*Prestation $presta*/)
	{
		// On récupère la requête
		$req = $this->get('request');
		$session = $req->getSession();		
		$u = $session->get('utilisateur');
	
		$em=$this->getDoctrine()->getManager();
		$presta=$em->getRepository('MlPrestationBundle:Covoiturage')->findById('3');
		
		$em->remove($presta[0]);
		$em->flush();

		//$this->get('session')->getFlashBag->add('supprimer','Votre prestation a été supprimé');
		return $this->redirect($this->generateUrl('ml_prestation_homepage'));
	}
	
}
