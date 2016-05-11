<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompartmentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = [
            '70cl' => 70,
            '75cl' => 75,
            '1L' => 100,
            '1.5L' => 150,
            '2L' => 200,
        ];
        $builder
            ->add('drink', EntityType::class, array(
                'class' => 'AppBundle:Drink',
                'choice_label' => 'name',
            ))
            ->add('volume', ChoiceType::class, array(
                'choices'  => $choices
            ))
            ->add('save', SubmitType::class, array('label' => 'Changer la boisson'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Compartment'
        ));
    }
}
