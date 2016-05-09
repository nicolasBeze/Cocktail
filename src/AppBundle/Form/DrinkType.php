<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DrinkType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('image', ImageType::class)
            ->add('volume', ChoiceType::class, array(
                'choices'  => array(
                    '70 cl' => 70,
                    '75 cl' => 75,
                    '1 L' => 100,
                    '1.5 L' => 150,
                    '2 L' => 200,
                )
            ))
            ->add('save', SubmitType::class, array('label' => 'Créer'))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Drink'
        ));
    }
}
