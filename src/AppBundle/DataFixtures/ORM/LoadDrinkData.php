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
                'name'   => 'Whisky',
                'image'  => 'vodka-pomme.jpg',
            ],
            [
                'name'   => 'Vodka',
                'image'  => 'vodka-pomme.jpg',
            ],
            [
                'name'   => 'Rhum blanc',
                'image'  => 'vodka-pomme.jpg',
            ],
            [
                'name'   => 'Rhum brun',
                'image'  => 'vodka-pomme.jpg',
            ],
            [
                'name'   => 'Tequila',
                'image'  => 'vodka-pomme.jpg',
            ],
            [
                'name'   => 'Triple sec',
                'image'  => 'vodka-pomme.jpg',
            ],
            [
                'name'   => 'Curaçao bleu',
                'image'  => 'vodka-pomme.jpg',
            ],
            [
                'name'   => 'Passoa',
                'image'  => 'vodka-pomme.jpg',
            ],
            [
                'name'   => 'Sucre de canne',
                'image'  => 'vodka-pomme.jpg',
            ],
            [
                'name'   => 'Sirop de citrons',
                'image'  => 'vodka-pomme.jpg',
            ],
            [
                'name'   => 'Sirop de grenadine',
                'image'  => 'vodka-pomme.jpg',
            ],
            [
                'name'   => 'Jus d\'oranges',
                'image'  => 'vodka-pomme.jpg',
            ],
            [
                'name'   => 'Jus de pommes',
                'image'  => 'vodka-pomme.jpg',
            ],
            [
                'name'   => 'Jus d\'ananas',
                'image'  => 'vodka-pomme.jpg',
            ]
        ];
    }
}