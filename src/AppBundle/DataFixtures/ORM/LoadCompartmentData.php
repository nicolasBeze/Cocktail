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
            $compartment->setPinGpio(1);
            $compartment->setRemainingVolume($data['remainingVolume']);
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
                'remainingVolume' => 60,
                'volume' => 70,
            ],
            [
                'drink'   => 'Vodka',
                'libelle'  => 'Compartiment 2',
                'remainingVolume' => 50,
                'volume' => 70,
            ],
            [
                'drink'   => 'Rhum blanc',
                'libelle'  => 'Compartiment 3',
                'remainingVolume' => 36,
                'volume' => 70,
            ],
            [
                'drink'   => 'Rhum brun',
                'libelle'  => 'Compartiment 4',
                'remainingVolume' => 12,
                'volume' => 70,
            ],
            [
                'drink'   => 'Tequila',
                'libelle'  => 'Compartiment 5',
                'remainingVolume' => 8,
                'volume' => 70,
            ],
            [
                'drink'   => 'Triple sec',
                'libelle'  => 'Compartiment 6',
                'remainingVolume' => 0,
                'volume' => 70,
            ],
            [
                'drink'   => 'Curaçao bleu',
                'libelle'  => 'Compartiment 7',
                'remainingVolume' => 24,
                'volume' => 70,
            ],
            [
                'drink'   => 'Passoa',
                'libelle'  => 'Compartiment 8',
                'remainingVolume' => 70,
                'volume' => 70,
            ],
            [
                'drink'   => 'Sucre de canne',
                'libelle'  => 'Compartiment 9',
                'remainingVolume' => 18,
                'volume' => 70,
            ],
            [
                'drink'   => 'Sirop de citrons',
                'libelle'  => 'Compartiment 10',
                'remainingVolume' => 75,
                'volume' => 75,
            ],
            [
                'drink'   => 'Sirop de grenadine',
                'libelle'  => 'Compartiment 11',
                'remainingVolume' => 75,
                'volume' => 75,
            ],
            [
                'drink'   => 'Jus d\'oranges',
                'libelle'  => 'Compartiment 12',
                'remainingVolume' => 10,
                'volume' => 100,
            ],
            [
                'drink'   => 'Jus de pommes',
                'libelle'  => 'Compartiment 13',
                'remainingVolume' => 20,
                'volume' => 100,
            ],
            [
                'drink'   => 'Jus d\'ananas',
                'libelle'  => 'Compartiment 14',
                'remainingVolume' => 30,
                'volume' => 100,
            ]
        ];
    }
}