<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = [];
        for($i = 1; $i <= 20; $i++){
            $choices[$i.'cl'] = $i;
        }
        $builder
            ->add('volume', ChoiceType::class, array(
                'choices'  => $choices
            ))
            ->add('drink', EntityType::class, array(
                'class' => 'AppBundle:Drink',
                'choice_label' => 'name',
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Dose'
        ));
    }
}
