<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 04/05/2016
 * Time: 14:29
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Dose;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDoseData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->arrayData() as $data){
            $dose = new Dose();
            $dose->setDrink($this->getReference($data['drink']));
            $dose->setVolume($data['volume']);
            $manager->persist($dose);
            $this->addReference($data['drink'].$data['volume'], $dose);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }

    public function arrayData()
    {
        return [
            [
                'drink'   => 'Whisky',
                'volume' => 2,
            ],
            [
                'drink'   => 'Whisky',
                'volume' => 4,
            ],
            [
                'drink'   => 'Whisky',
                'volume' => 6,
            ],
            [
                'drink'   => 'Vodka',
                'volume' => 2,
            ],
            [
                'drink'   => 'Vodka',
                'volume' => 3,
            ],
            [
                'drink'   => 'Vodka',
                'volume' => 4,
            ],
            [
                'drink'   => 'Vodka',
                'volume' => 5,
            ],
            [
                'drink'   => 'Rhum blanc',
                'volume' => 2,
            ],
            [
                'drink'   => 'Rhum blanc',
                'volume' => 4,
            ],
            [
                'drink'   => 'Rhum blanc',
                'volume' => 6,
            ],
            [
                'drink'   => 'Rhum brun',
                'volume' => 2,
            ],
            [
                'drink'   => 'Rhum brun',
                'volume' => 4,
            ],
            [
                'drink'   => 'Rhum brun',
                'volume' => 6,
            ],
            [
                'drink'   => 'Tequila',
                'volume' => 2,
            ],
            [
                'drink'   => 'Tequila',
                'volume' => 4,
            ],
            [
                'drink'   => 'Tequila',
                'volume' => 6,
            ],
            [
                'drink'   => 'Triple sec',
                'volume' => 70,
            ],
            [
                'drink'   => 'Curaçao bleu',
                'volume' => 4,
            ],
            [
                'drink'   => 'Curaçao bleu',
                'volume' => 8,
            ],
            [
                'drink'   => 'Curaçao bleu',
                'volume' => 12,
            ],
            [
                'drink'   => 'Passoa',
                'volume' => 8,
            ],
            [
                'drink'   => 'Sucre de canne',
                'volume' => 3,
            ],
            [
                'drink'   => 'Sirop de citrons',
                'volume' => 2,
            ],
            [
                'drink'   => 'Sirop de citrons',
                'volume' => 3,
            ],
            [
                'drink'   => 'Sirop de grenadine',
                'volume' => 2,
            ],
            [
                'drink'   => 'Sirop de grenadine',
                'volume' => 3,
            ],
            [
                'drink'   => 'Jus d\'oranges',
                'volume' => 10,
            ],
            [
                'drink'   => 'Jus d\'oranges',
                'volume' => 12,
            ],
            [
                'drink'   => 'Jus d\'oranges',
                'volume' => 15,
            ],
            [
                'drink'   => 'Jus de pommes',
                'volume' => 10,
            ],
            [
                'drink'   => 'Jus de pommes',
                'volume' => 12,
            ],
            [
                'drink'   => 'Jus de pommes',
                'volume' => 15,
            ],
            [
                'drink'   => 'Jus d\'ananas',
                'volume' => 10,
            ],
            [
                'drink'   => 'Jus d\'ananas',
                'volume' => 12,
            ],
            [
                'drink'   => 'Jus d\'ananas',
                'volume' => 15,
            ]
        ];
    }
}