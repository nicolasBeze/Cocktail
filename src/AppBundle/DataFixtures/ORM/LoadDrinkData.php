<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Drink;
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
            $drink = new Drink();
            $drink->setName($data['name']);
            $drink->setImage($data['image']);
            $drink->setVolume($data['volume']);
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
                'image'  => '',
                'volume' => 70,
            ],
            [
                'name'   => 'Vodka',
                'image'  => '',
                'volume' => 70,
            ],
            [
                'name'   => 'Rhum blanc',
                'image'  => '',
                'volume' => 70,
            ],
            [
                'name'   => 'Rhum brun',
                'image'  => '',
                'volume' => 70,
            ],
            [
                'name'   => 'Tequila',
                'image'  => '',
                'volume' => 70,
            ],
            [
                'name'   => 'Triple sec',
                'image'  => '',
                'volume' => 70,
            ],
            [
                'name'   => 'Curaçao bleu',
                'image'  => '',
                'volume' => 70,
            ],
            [
                'name'   => 'Passoa',
                'image'  => '',
                'volume' => 70,
            ],
            [
                'name'   => 'Sucre de canne',
                'image'  => '',
                'volume' => 70,
            ],
            [
                'name'   => 'Sirop de citrons',
                'image'  => '',
                'volume' => 75,
            ],
            [
                'name'   => 'Sirop de grenadine',
                'image'  => '',
                'volume' => 75,
            ],
            [
                'name'   => 'Jus d\'oranges',
                'image'  => '',
                'volume' => 100,
            ],
            [
                'name'   => 'Jus de pommes',
                'image'  => '',
                'volume' => 100,
            ],
            [
                'name'   => 'Jus d\'ananas',
                'image'  => '',
                'volume' => 100,
            ]
        ];
    }
}