<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 04/05/2016
 * Time: 14:59
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Cocktail;
use AppBundle\Entity\Image;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCocktailData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->arrayData() as $data){
            $image = new Image();
            $image->setAlt($data['image']);
            $image->setUrl($data['image']);

            $cocktail = new Cocktail();
            $cocktail->setName($data['name']);
            $cocktail->setDescription($data['description']);
            $cocktail->setImage($image);
            foreach ($data['doses'] as $dose){
                $cocktail->addDose($this->getReference($dose));
            }
            $manager->persist($cocktail);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }

    public function arrayData()
    {
        return [
            [
                'name'  => 'Tequila Sunrise',
                'description'   => '',
                'image' => 'tequila-sunrise.jpg',
                'doses' => [
                    'Tequila6',
                    'Jus d\'oranges12',
                    'Sirop de grenadine2'
                ]
            ],
            [
                'name'  => 'Vodka Pomme',
                'description'   => '',
                'image' => 'vodka-pomme.jpg',
                'doses' => [
                    'Vodka3',
                    'Jus de pommes10'
                ]
            ],
            [
                'name'  => 'Vodka Pomme',
                'description'   => '',
                'image' => 'vodka-pomme.jpg',
                'doses' => [
                    'Vodka3',
                    'Jus de pommes10'
                ]
            ],
            [
                'name'  => 'Vodka Pomme',
                'description'   => '',
                'image' => 'vodka-pomme.jpg',
                'doses' => [
                    'Vodka3',
                    'Jus de pommes10'
                ]
            ],
            [
                'name'  => 'Vodka Pomme',
                'description'   => '',
                'image' => 'vodka-pomme.jpg',
                'doses' => [
                    'Vodka3',
                    'Jus de pommes10'
                ]
            ],
            [
                'name'  => 'Vodka Pomme',
                'description'   => '',
                'image' => 'vodka-pomme.jpg',
                'doses' => [
                    'Vodka3',
                    'Jus de pommes10'
                ]
            ],
            [
                'name'  => 'Vodka Pomme',
                'description'   => '',
                'image' => 'vodka-pomme.jpg',
                'doses' => [
                    'Vodka3',
                    'Jus de pommes10'
                ]
            ],
            [
                'name'  => 'Vodka Pomme',
                'description'   => '',
                'image' => 'vodka-pomme.jpg',
                'doses' => [
                    'Vodka3',
                    'Jus de pommes10'
                ]
            ],
            [
                'name'  => 'Vodka Pomme',
                'description'   => '',
                'image' => 'vodka-pomme.jpg',
                'doses' => [
                    'Vodka3',
                    'Jus de pommes10'
                ]
            ],
            [
                'name'  => 'Vodka Pomme',
                'description'   => '',
                'image' => 'vodka-pomme.jpg',
                'doses' => [
                    'Vodka3',
                    'Jus de pommes10'
                ]
            ],
            [
                'name'  => 'Vodka Pomme',
                'description'   => '',
                'image' => 'vodka-pomme.jpg',
                'doses' => [
                    'Vodka3',
                    'Jus de pommes10'
                ]
            ],
            [
                'name'  => 'Vodka Pomme',
                'description'   => '',
                'image' => 'vodka-pomme.jpg',
                'doses' => [
                    'Vodka3',
                    'Jus de pommes10'
                ]
            ]

        ];
    }
}
