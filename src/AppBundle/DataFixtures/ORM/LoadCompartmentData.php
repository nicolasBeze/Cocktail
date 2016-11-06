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
                'drink'   => 'ma',
                'libelle'  => 'Compartiment 1',
                'remainingVolume' => 90,
                'volume' => 100,
                'pin' => 1,
            ],
            [
                'drink'   => 'cu',
                'libelle'  => 'Compartiment 2',
                'remainingVolume' => 45,
                'volume' => 50,
                'pin' => 0,
            ],
            [
                'drink'   => 'co',
                'libelle'  => 'Compartiment 3',
                'remainingVolume' => 45,
                'volume' => 50,
                'pin' => 2,
            ],
            [
                'drink'   => 'te',
                'libelle'  => 'Compartiment 4',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 15,
            ],
            [
                'drink'   => 'br',
                'libelle'  => 'Compartiment 5',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 21,
            ],
            [
                'drink'   => 'bl',
                'libelle'  => 'Compartiment 6',
                'remainingVolume' => 0,
                'volume' => 70,
                'pin' => 10,
            ],
            [
                'drink'   => 'tr',
                'libelle'  => 'Compartiment 7',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 14,
            ],
            [
                'drink'   => 'vo',
                'libelle'  => 'Compartiment 8',
                'remainingVolume' => 90,
                'volume' => 100,
                'pin' => 13,
            ],
            [
                'drink'   => 'sc',
                'libelle'  => 'Compartiment 9',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 3,
            ],
            [
                'drink'   => 'ci',
                'libelle'  => 'Compartiment 10',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 11,
            ],
            [
                'drink'   => 'gr',
                'libelle'  => 'Compartiment 11',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 7,
            ],
            [
                'drink'   => 'or',
                'libelle'  => 'Compartiment 12',
                'remainingVolume' => 90,
                'volume' => 100,
                'pin' => 5,
            ],
            [
                'drink'   => 'cr',
                'libelle'  => 'Compartiment 13',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 4,
            ],
            [
                'drink'   => 'an',
                'libelle'  => 'Compartiment 14',
                'remainingVolume' => 60,
                'volume' => 70,
                'pin' => 16,
            ],
            [
                'drink'   => 'ch',
                'libelle'  => 'Compartiment 15',
                'remainingVolume' => 45,
                'volume' => 50,
                'pin' => 6,
            ],
            [
                'drink'   => 'ea',
                'libelle'  => 'Compartiment 16',
                'remainingVolume' => 70,
                'volume' => 100,
                'pin' => 12,
            ]
        ];
    }
}