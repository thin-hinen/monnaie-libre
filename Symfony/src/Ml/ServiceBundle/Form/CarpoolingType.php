<?php

namespace Ml\ServiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarpoolingType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('departure','text')
            ->add('meetingPoint','text')
			->add('arrival','text')
            ->add('arrivalPoint','text')
            ->add('bends','text', array (
									'required' => false))
            ->add('departureDate','date')
            ->add('estimatedDuration','text', array (
									'label' => 'Estimated duration (min)'))
            ->add('estimatedDistance','text', array (
									'label' => 'Estimated distance (km)'))
            ->add('packageTransport','text', array(
									'required' => false))
            ->add('packageSize','text')
            ->add('car','text')
            ->add('smoker','choice', array(
									'choices' => array (
										true => 'Yes',
										false => 'No')))
            ->add('pets','choice', array(
									'choices' => array (
										true => 'Yes',
										false => 'No')))
            ->add('music','choice', array(
									'choices' => array (
										true => 'Yes',
										false => 'No')))
            ->add('title','text')
            ->add('comment','textarea', array(
									'required' => false));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ml\ServiceBundle\Entity\Carpooling'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ml_servicebundle_carpooling';
    }
}
