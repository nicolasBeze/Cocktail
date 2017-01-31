<?php

namespace AppBundle\Form;

use AppBundle\Entity\Drink;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class FilterCocktailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('drink', EntityType::class, [
                'class' => Drink::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->orderBy('d.name', 'ASC');
                },
                'choice_label' => 'name',
                'label' => 'Alcool',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Filtrer'
            ])
        ;
    }
}
