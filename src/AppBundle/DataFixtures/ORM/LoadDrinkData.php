<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Drink;
use AppBundle\Entity\Image;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 04/05/2016
 * Time: 13:35
 */
class LoadDrinkData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->arrayData() as $data){
            $image = new Image();
            $image->setAlt($data['image']);
            $image->setUrl($data['image']);

            $drink = new Drink();
            $drink->setName($data['name']);
            $drink->setViscosity($data['viscosity']);
            $drink->setImage($image);

            $manager->persist($drink);
            $this->addReference($data['name'], $drink);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1; 
    }

    public function arrayData()
    {
        return [
            [
                'name'   => 'Martini',
                'image'  => 'martini.jpg',
                'viscosity' => Drink::VISCOSITY_ALCOOL,
            ],
            [
                'name'   => 'Vodka',
                'image'  => 'vodka.jpg',
                'viscosity' => Drink::VISCOSITY_ALCOOL,
            ],
            [
                'name'   => 'Rhum blanc',
                'image'  => 'rhumblanc.jpg',
                'viscosity' => Drink::VISCOSITY_ALCOOL,
            ],
            [
                'name'   => 'Rhum brun',
                'image'  => 'rhumbrun.jpg',
                'viscosity' => Drink::VISCOSITY_ALCOOL,
            ],
            [
                'name'   => 'Tequila',
                'image'  => 'tequila.png',
                'viscosity' => Drink::VISCOSITY_ALCOOL,
            ],
            [
                'name'   => 'Triple sec',
                'image'  => 'triplesec.jpg',
                'viscosity' => Drink::VISCOSITY_ALCOOL,
            ],
            [
                'name'   => 'Curaçao',
                'image'  => 'curacao.jpg',
                'viscosity' => Drink::VISCOSITY_ALCOOL,
            ],
            [
                'name'   => 'Cognac',
                'image'  => 'cognac.jpg',
                'viscosity' => Drink::VISCOSITY_ALCOOL,
            ],
            [
                'name'   => 'Sucre de canne',
                'image'  => 'sucre-de-canne.jpg',
                'viscosity' => Drink::VISCOSITY_SIROP,
            ],
            [
                'name'   => 'Sirop de citrons',
                'image'  => 'sirop-de-citron.jpg',
                'viscosity' => Drink::VISCOSITY_SIROP,
            ],
            [
                'name'   => 'Sirop de grenadine',
                'image'  => 'sirop-de-grenadine.jpg',
                'viscosity' => Drink::VISCOSITY_SIROP,
            ],
            [
                'name'   => 'Jus d\'oranges',
                'image'  => 'oranges.jpg',
                'viscosity' => Drink::VISCOSITY_JUICE,
            ],
            [
                'name'   => 'Jus de cranberry',
                'image'  => 'cranberry.jpg',
                'viscosity' => Drink::VISCOSITY_JUICE,
            ],
            [
                'name'   => 'Jus d\'ananas',
                'image'  => 'ananas.jpg',
                'viscosity' => Drink::VISCOSITY_JUICE,
            ],
            [
                'name'   => 'Eau gazeuse',
                'image'  => 'perrier.jpg',
                'viscosity' => Drink::VISCOSITY_JUICE,
            ],
            [
                'name'   => 'Chambord',
                'image'  => 'chambord.jpg',
                'viscosity' => Drink::VISCOSITY_JUICE,
            ]
        ];
    }
}