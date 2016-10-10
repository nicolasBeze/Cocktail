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
            $compartment->setPinGpio($data['pin']);
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
                'drink'   => 'Martini',
                'libelle'  => 'Compartiment 1',
                'remainingVolume' => 90,
                'volume' => 100,
                'pin' => 1,
            ],
            [
                'drink'   => 'Curaçao',
                'libelle'  => 'Compartiment 2',
                'remainingVolume' => 45,
                'volume' => 50,
                'pin' => 0,
            ],
            [
                'drink'   => 'Cognac',
                'libelle'  => 'Compartiment 3',
                'remainingVolume' => 45,
                'volume' => 50,
                'pin' => 2,
            ],
            [
                'drink'   => 'Tequila',
                'libelle'  => 'Compartiment 4',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 15,
            ],
            [
                'drink'   => 'Rhum brun',
                'libelle'  => 'Compartiment 5',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 21,
            ],
            [
                'drink'   => 'Rhum blanc',
                'libelle'  => 'Compartiment 6',
                'remainingVolume' => 0,
                'volume' => 70,
                'pin' => 10,
            ],
            [
                'drink'   => 'Triple sec',
                'libelle'  => 'Compartiment 7',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 14,
            ],
            [
                'drink'   => 'Vodka',
                'libelle'  => 'Compartiment 8',
                'remainingVolume' => 90,
                'volume' => 100,
                'pin' => 13,
            ],
            [
                'drink'   => 'Sucre de canne',
                'libelle'  => 'Compartiment 9',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 3,
            ],
            [
                'drink'   => 'Sirop de citrons',
                'libelle'  => 'Compartiment 10',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 11,
            ],
            [
                'drink'   => 'Sirop de grenadine',
                'libelle'  => 'Compartiment 11',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 7,
            ],
            [
                'drink'   => 'Jus d\'oranges',
                'libelle'  => 'Compartiment 12',
                'remainingVolume' => 90,
                'volume' => 100,
                'pin' => 5,
            ],
            [
                'drink'   => 'Jus de cranberry',
                'libelle'  => 'Compartiment 13',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 4,
            ],
            [
                'drink'   => 'Jus d\'ananas',
                'libelle'  => 'Compartiment 14',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 16,
            ]
        ];
    }
}