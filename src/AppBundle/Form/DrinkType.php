<?php

namespace AppBundle\Form;

use AppBundle\Entity\Drink;
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
        $drink = new Drink();
        $viscosity = [];
        foreach($drink->constantList() as $key => $value){
            $viscosity[$key] = $value;
        }
        $builder
            ->add('name')
            ->add('viscosity', ChoiceType::class, array(
                'choices'  => $viscosity
            ))
            ->add('image', ImageType::class)
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
