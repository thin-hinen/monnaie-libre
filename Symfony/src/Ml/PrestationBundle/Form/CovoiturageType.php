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
            ->add('ville','text')
            ->add('lieuRDV','text')
            ->add('lieuDeDepose','text')
            ->add('detours','text')
            ->add('dateDepart','date')
            ->add('dureeEstimee','text')
            ->add('distanceEstimee','text')
            ->add('transportDeColis','text')
            ->add('tailleDesBagages','text')
            ->add('vehicule','text')
            ->add('fumeur','checkbox', array('required' => false))
            ->add('animaux','checkbox', array('required' => false))
            ->add('musique','checkbox', array('required' => false))
            ->add('titre','text')
            ->add('commentaire','textarea')
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
