<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 04/05/2016
 * Time: 14:46
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Compartment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCompartmentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->arrayData() as $data){
            $compartment = new Compartment();
            $compartment->setDrink($this->getReference($data['drink']));
            $compartment->setlibelle($data['libelle']);
            $compartment->setVolume($data['volume']);
            $manager->persist($compartment);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }

    public function arrayData()
    {
        return [
            [
                'drink'   => 'Whisky',
                'libelle'  => 'Compartiment 1',
                'volume' => 70,
            ],
            [
                'drink'   => 'Vodka',
                'libelle'  => 'Compartiment 2',
                'volume' => 70,
            ],
            [
                'drink'   => 'Rhum blanc',
                'libelle'  => 'Compartiment 3',
                'volume' => 70,
            ],
            [
                'drink'   => 'Rhum brun',
                'libelle'  => 'Compartiment 4',
                'volume' => 70,
            ],
            [
                'drink'   => 'Tequila',
                'libelle'  => 'Compartiment 5',
                'volume' => 70,
            ],
            [
                'drink'   => 'Triple sec',
                'libelle'  => 'Compartiment 6',
                'volume' => 70,
            ],
            [
                'drink'   => 'Curaçao bleu',
                'libelle'  => 'Compartiment 7',
                'volume' => 70,
            ],
            [
                'drink'   => 'Passoa',
                'libelle'  => 'Compartiment 8',
                'volume' => 70,
            ],
            [
                'drink'   => 'Sucre de canne',
                'libelle'  => 'Compartiment 9',
                'volume' => 70,
            ],
            [
                'drink'   => 'Sirop de citrons',
                'libelle'  => 'Compartiment 10',
                'volume' => 75,
            ],
            [
                'drink'   => 'Sirop de grenadine',
                'libelle'  => 'Compartiment 11',
                'volume' => 75,
            ],
            [
                'drink'   => 'Jus d\'oranges',
                'libelle'  => 'Compartiment 12',
                'volume' => 100,
            ],
            [
                'drink'   => 'Jus de pommes',
                'libelle'  => 'Compartiment 13',
                'volume' => 100,
            ],
            [
                'drink'   => 'Jus d\'ananas',
                'libelle'  => 'Compartiment 14',
                'volume' => 100,
            ]
        ];
    }
}