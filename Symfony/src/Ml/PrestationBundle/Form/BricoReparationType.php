<?php

namespace Ml\PrestationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BricoReparationType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('morningDispB')
            ->add('morningDispE')
            ->add('afternoonDispB')
            ->add('afternoonDispE')
            ->add('description')
            ->add('telNumber')
            ->add('price')
            ->add('zipCode')
            ->add('city')
            ->add('department')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ml\PrestationBundle\Entity\BricoReparation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ml_prestationbundle_bricoreparation';
    }
}
