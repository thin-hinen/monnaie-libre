<?php

namespace Ml\PrestationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CovoiturageType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('villeDepart','text')
            ->add('lieuRDV','text', array (
									'label' => 'Lieu de rendez-vous'))
			->add('villeArrivee','text')
            ->add('lieuDeDepose','text', array (
									'label' => 'Lieu de dépose'))
            ->add('detours','text', array (
									'label' => 'Détours',
									'required' => false))
            ->add('dateDepart','date', array (
									'label' => 'Date de départ'))
            ->add('dureeEstimee','text', array (
									'label' => 'Durée estimée (min)'))
            ->add('distanceEstimee','text', array (
									'label' => 'Distance estimée (km)'))
            ->add('transportDeColis','text', array(
									'required' => false))
            ->add('tailleDesBagages','text', array(
									'label' => 'Taille des bagages (kg)'))
            ->add('vehicule','text', array (
									'label' => 'Véhicule'))
            ->add('fumeur','choice', array(
									'choices' => array (
										true => 'Oui',
										false => 'Non')))
            ->add('animaux','choice', array(
									'choices' => array (
										true => 'Oui',
										false => 'Non')))
            ->add('musique','choice', array(
									'choices' => array (
										true => 'Oui',
										false => 'Non')))
            ->add('titre','text')
            ->add('commentaire','textarea', array(
									'required' => false))
            /*->add('dateCreation')
            ->add('signaler')
            ->add('visibilite')
            ->add('user')*/
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ml\PrestationBundle\Entity\Covoiturage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ml_prestationbundle_covoiturage';
    }
}
