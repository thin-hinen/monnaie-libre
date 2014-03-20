<?php

namespace Ml\PrestationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Ml\PrestationBundle\Entity\Prestation;

class PrestationController extends Controller
{

	public function indexAction()
	{
		/** Récupération de toutes les prestations du site **/
		$presta = $this->getDoctrine()->getManager()->getRepository('MlPrestationBundle:Prestation')->findAll();

		return $this->render('MlPrestationBundle:Prestation:index.html.twig',array('presta'=>$presta));
	}	

	public function seeAction()
	{
		$em=$this->getDoctrine()->getManager();
		$presta=$em->getRepository('MlPrestationBundle:Prestation')->find($id);
		
		/** Si la prestation demandée n'existe pas **/
		if($presta === null){
			throw $this->createNotFoundException('La prestation [id'.$id.'] n\'est pas renseigné dans notre base de données');
		}
		
		/** Si elle existe, elle est envoyée à la vue **/
		return $this->render('MlPrestationBundle:Prestation:seePresta.html.twig',array('presta'=>$presta));

	}
	
	public function addAction(){
		$presta = new Prestation;
		
		$form = $this->createForm(new Prestation(),$presta);

		$req=$this->getRequest();
		if($req->getMethod() == 'POST'){
			/**lien requête<->formulaire**/
			$form->bind($req);

			if($form->isValid()){
				$em=$this->getDoctrine()->getManager();
				$em->persist($presta);
				$em->flush;

				$this->get('session')->getFlashBag->add('ajouter','Votre prestation est ajoutée');

				return $this->redirect($this->generateUrl('ml_presta_see',array('id'=>$presta->getId())));
			}
		}
		/** si le formulaire n'est pas valide, on le redemande*/
		return $this->render('MlPrestationBundle:Prestation:addPresta.html.twig', array('form'=>$form->createView()));
	}

	public function deleteAction(Prestation $presta)
	{
		$form=$this->createFormBuilder()->getForm();
		$req = $this->getRequest();
		if($req->getMethod() == 'POST'){
			$form->bind($req);
			if($form->isValid()){
				$em=$this->getDoctrine()->getManager();
				$em->remove($presta);
				$em->flush();

				$this->get('session')->getFlashBag->add('supprimer','Votre prestation a été supprimé');
				return $this->redirect($this->generateUrl('ml_presta_index'));
			}
		}
		/** si le formulaire n'est pas valide, on le redemande*/
		return $this->render('MlPrestationBundle:Prestation:delete.html.twig', array('presta'=>$presta,'form'=>$form->createView()));
	}
	
}
