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
            $this->addReference($data['ref'], $drink);
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
                'ref' => 'ma',
                'image'  => 'martini.jpg',
                'viscosity' => Drink::VISCOSITY_ALCOOL,
            ],
            [
                'name'   => 'Vodka',
                'ref' => 'vo',
                'image'  => 'vodka.jpg',
                'viscosity' => Drink::VISCOSITY_ALCOOL,
            ],
            [
                'name'   => 'Rhum blanc',
                'ref' => 'bl',
                'image'  => 'rhumblanc.jpg',
                'viscosity' => Drink::VISCOSITY_ALCOOL,
            ],
            [
                'name'   => 'Rhum brun',
                'ref' => 'br',
                'image'  => 'rhumbrun.jpg',
                'viscosity' => Drink::VISCOSITY_ALCOOL,
            ],
            [
                'name'   => 'Tequila',
                'ref' => 'te',
                'image'  => 'tequila.png',
                'viscosity' => Drink::VISCOSITY_ALCOOL,
            ],
            [
                'name'   => 'Triple sec',
                'ref' => 'tr',
                'image'  => 'triplesec.jpg',
                'viscosity' => Drink::VISCOSITY_COINTREAU,
            ],
            [
                'name'   => 'Curaçao',
                'ref' => 'cu',
                'image'  => 'curacao.jpg',
                'viscosity' => Drink::VISCOSITY_CURACAO,
            ],
            [
                'name'   => 'Cognac',
                'ref' => 'co',
                'image'  => 'cognac.jpg',
                'viscosity' => Drink::VISCOSITY_ALCOOL,
            ],
            [
                'name'   => 'Sucre de canne',
                'ref' => 'sc',
                'image'  => 'sucre-de-canne.jpg',
                'viscosity' => Drink::VISCOSITY_SUCRE_DE_CANNE,
            ],
            [
                'name'   => 'Sirop de citrons',
                'ref' => 'ci',
                'image'  => 'sirop-de-citron.jpg',
                'viscosity' => Drink::VISCOSITY_CITRON,
            ],
            [
                'name'   => 'Sirop de grenadine',
                'ref' => 'gr',
                'image'  => 'sirop-de-grenadine.jpg',
                'viscosity' => Drink::VISCOSITY_GRENADINE,
            ],
            [
                'name'   => 'Jus d\'oranges',
                'ref' => 'or',
                'image'  => 'oranges.jpg',
                'viscosity' => Drink::VISCOSITY_ORANGE,
            ],
            [
                'name'   => 'Jus de cranberry',
                'ref' => 'cr',
                'image'  => 'cranberry.jpg',
                'viscosity' => Drink::VISCOSITY_CRANBERRY,
            ],
            [
                'name'   => 'Jus d\'ananas',
                'ref' => 'an',
                'image'  => 'ananas.jpg',
                'viscosity' => Drink::VISCOSITY_ANANAS,
            ],
            [
                'name'   => 'Eau gazeuse',
                'ref' => 'ea',
                'image'  => 'perrier.jpg',
                'viscosity' => Drink::VISCOSITY_EAU_GAZEUSE,
            ],
            [
                'name'   => 'Chambord',
                'ref' => 'ch',
                'image'  => 'chambord.jpg',
                'viscosity' => Drink::VISCOSITY_CHAMBORD,
            ]
        ];
    }
}