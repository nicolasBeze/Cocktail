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
                'name'  => 'Sex on the beach',
                'description'   => '',
                'image' => 'sex.jpg',
                'doses' => [
                    'vo3',
                    'ch2',
                    'an5',
                    'cr6'
                ]
            ],
            [
                'name'  => 'Tequila Sunrise',
                'description'   => '',
                'image' => 'tequila-sunrise.jpg',
                'doses' => [
                    'te6',
                    'or12',
                    'gr2'
                ]
            ],
            [
                'name'  => 'Afterglow',
                'description'   => '',
                'image' => 'afterglow.jpg',
                'doses' => [
                    'or8',
                    'an8',
                    'gr2'
                ]
            ],
            [
                'name'  => 'Cocaïne liquide',
                'description'   => '',
                'image' => 'cocaine.jpg',
                'doses' => [
                    'vo2',
                    'te2',
                    'cu2'
                ]
            ],
            [
                'name'  => 'Screwdriver',
                'description'   => '',
                'image' => 'screwdriver.jpg',
                'doses' => [
                    'vo4',
                    'or12'
                ]
            ],
            [
                'name'  => 'Blue Shark',
                'description'   => '',
                'image' => 'blueshark.jpg',
                'doses' => [
                    'vo4',
                    'te4',
                    'cu1'
                ]
            ],
            [
                'name'  => 'Bombe de bastille',
                'description'   => '',
                'image' => 'thebastillian.jpg',
                'doses' => [
                    'gr3',
                    'cu1',
                    'tr2'
                ]
            ],
            [
                'name'  => 'Volga',
                'description'   => '',
                'image' => 'volga.jpg',
                'doses' => [
                    'cu4',
                    'vo4',
                    'tr4'
                ]
            ],
            [
                'name'  => 'Brassmonkey',
                'description'   => '',
                'image' => 'brassmonkey.jpg',
                'doses' => [
                    'vo2',
                    'bl2',
                    'or12'
                ]
            ],
            [
                'name'  => 'Tequila dry cocktail',
                'description'   => '',
                'image' => 'tequila-dry.jpg',
                'doses' => [
                    'te8',
                    'tr3',
                    'ma3'
                ]
            ],
            [
                'name'  => 'French martini',
                'description'   => '',
                'image' => 'french-martini.jpg',
                'doses' => [
                    'vo5',
                    'ch1',
                    'an1'
                ]
            ],
            [
                'name'  => 'Madras',
                'description'   => '',
                'image' => 'madras.jpg',
                'doses' => [
                    'vo5',
                    'cr12',
                    'or3'
                ]
            ],
            [
                'name'  => 'Larimar',
                'description'   => '',
                'image' => 'larimar.jpg',
                'doses' => [
                    'ma4',
                    'cu3',
                    'or7'
                ]
            ],
            [
                'name'  => 'Soir de france',
                'description'   => '',
                'image' => 'soirdefrance.jpg',
                'doses' => [
                    'te6',
                    'tr4',
                    'gr3',
                    'cu1'
                ]
            ],
            [
                'name'  => 'Extradition',
                'description'   => '',
                'image' => 'extradition.jpg',
                'doses' => [
                    'vo2',
                    'cu2',
                    'ea2'
                ]
            ],
            [
                'name'  => 'Black Pearl',
                'description'   => '',
                'image' => 'black-pearl.jpg',
                'doses' => [
                    'vo6',
                    'ch3'
                ]
            ],
            [
                'name'  => 'Fêtard',
                'description'   => '',
                'image' => 'fetard.jpg',
                'doses' => [
                    'ma5',
                    'tr1',
                    'an6'
                ]
            ],
            [
                'name'  => 'Girls on Sunrise',
                'description'   => '',
                'image' => 'girls.jpg',
                'doses' => [
                    'vo4',
                    'tr3',
                    'or10',
                    'gr1'
                ]
            ],
            [
                'name'  => 'Sunburn',
                'description'   => '',
                'image' => 'sunburn.jpg',
                'doses' => [
                    'tr3',
                    'te3',
                    'cr8'
                ]
            ],
            [
                'name'  => 'TNT2',
                'description'   => '',
                'image' => 'tnt2.jpg',
                'doses' => [
                    'or4',
                    'tr4',
                    'bl4'
                ]
            ],
            [
                'name'  => 'Crantini',
                'description'   => '',
                'image' => 'crantini.jpg',
                'doses' => [
                    'vo5',
                    'cr4'
                ]
            ],
            [
                'name'  => 'Bob Greenstock',
                'description'   => '',
                'image' => 'gne.jpg',
                'doses' => [
                    'vo4',
                    'sc1',
                    'cu2',
                    'gr1',
                    'or8'
                ]
            ],
            [
                'name'  => 'Leviathan',
                'description'   => '',
                'image' => 'lavian.jpg',
                'doses' => [
                    'co6',
                    'ma3',
                    'or3',
                    'tr1'
                ]
            ],
            [
                'name'  => 'Pink Palace',
                'description'   => '',
                'image' => 'pink-palace.jpg',
                'doses' => [
                    'vo3',
                    'ch3',
                    'cr4',
                    'ea8',
                ]
            ],
            [
                'name'  => 'French Pearl',
                'description'   => '',
                'image' => 'frenchpearl.jpg',
                'doses' => [
                    'co3',
                    'tr3'
                ]
            ],
            [
                'name'  => 'Dark Purple',
                'description'   => '',
                'image' => 'darkpurple.jpg',
                'doses' => [
                    'gr3',
                    'cu2',
                    'vo2'
                ]
            ],
            [
                'name'  => 'Olympic',
                'description'   => '',
                'image' => 'olympic.jpg',
                'doses' => [
                    'co4',
                    'tr1',
                    'or2'
                ]
            ],
            [
                'name'  => 'Madmix',
                'description'   => '',
                'image' => 'madmix.jpg',
                'doses' => [
                    'te6',
                    'gr1',
                    'bl8',
                    'cu1'
                ]
            ],
            [
                'name'  => '007 Pineapple',
                'description'   => '',
                'image' => '007-pineapple.jpg',
                'doses' => [
                    'ma2',
                    'vo6',
                    'an12'
                ]
            ],
            [
                'name'  => 'Ice bet',
                'description'   => '',
                'image' => 'ice-bet.jpg',
                'doses' => [
                    'te3',
                    'tr3'
                ]
            ],
            [
                'name'  => 'Planteur',
                'description'   => '',
                'image' => 'planteur.jpg',
                'doses' => [
                    'br6',
                    'cr2',
                    'an2',
                    'or2',
                    'gr1'
                ]
            ],
            [
                'name'  => 'Planter\'s Punch',
                'description'   => '',
                'image' => 'planterP.jpg',
                'doses' => [
                    'br6',
                    'ci2',
                    'or2',
                    'gr1'
                ]
            ],
            [
                'name'  => 'Petit Punch Vieux',
                'description'   => '',
                'image' => 'petit-punch-vieux.jpg',
                'doses' => [
                    'br4',
                    'sc1',
                    'ci1'
                ]
            ],
            [
                'name'  => 'Apple Jack',
                'description'   => '',
                'image' => 'jack_rose.jpg',
                'doses' => [
                    'ci1',
                    'gr1',
                    'co5'
                ]
            ],
            [
                'name'  => 'Russian',
                'description'   => '',
                'image' => 'russian.jpg',
                'doses' => [
                    'vo6',
                    'tr3',
                    'ci1',
                    'gr1',
                    'an3',
                    'cr3',
                    'or3'
                ]
            ],
            [
                'name'  => 'Daiquiri',
                'description'   => '',
                'image' => 'daiquirii.jpg',
                'doses' => [
                    'sc1',
                    'ci2',
                    'bl4'
                ]
            ],
            [
                'name'  => 'Side-car',
                'description'   => '',
                'image' => 'sidecar2.jpg',
                'doses' => [
                    'tr2',
                    'ci2',
                    'co5'
                ]
            ],
            [
                'name'  => 'Margarita',
                'description'   => '',
                'image' => 'margarita2.jpg',
                'doses' => [
                    'ci2',
                    'tr3',
                    'te5'
                ]
            ],
            [
                'name'  => 'cosmopolitan',
                'description'   => '',
                'image' => 'cosmopolitan.jpg',
                'doses' => [
                    'ci1',
                    'tr2',
                    'vo4',
                    'cr4'
                ]
            ],
            [
                'name'  => 'El Diablo',
                'description'   => '',
                'image' => 'eldiablo.jpg',
                'doses' => [
                    'ci1',
                    'gr2',
                    'te4',
                    'ea12'
                ]
            ],
            [
                'name'  => 'Cognac Sour',
                'description'   => '',
                'image' => 'cognacsour.jpg',
                'doses' => [
                    'sc2',
                    'ci2',
                    'co5'
                ]
            ],
            [
                'name'  => 'Blue Lagoon',
                'description'   => '',
                'image' => 'blue-lagoon.jpg',
                'doses' => [
                    'ci2',
                    'cu3',
                    'vo4'
                ]
            ],
            [
                'name'  => 'Kamikaze blue',
                'description'   => '',
                'image' => 'kamiblue.jpg',
                'doses' => [
                    'ci2',
                    'vo2',
                    'cu2'
                ]
            ],
            [
                'name'  => 'Red lion',
                'description'   => '',
                'image' => 'red_lion.jpg',
                'doses' => [
                    'ci1',
                    'tr3',
                    'te2',
                    'or1'
                ]
            ],
            [
                'name'  => 'Mary Pickford',
                'description'   => '',
                'image' => 'marypickford.jpg',
                'doses' => [
                    'gr1',
                    'bl4',
                    'an3'
                ]
            ],
            [
                'name'  => 'Bella luna',
                'description'   => '',
                'image' => 'belle-lune.jpg',
                'doses' => [
                    'ci2',
                    'an6',
                    'or10'
                ]
            ],
            [
                'name'  => 'Fruits cup',
                'description'   => '',
                'image' => 'fruits-cup.jpg',
                'doses' => [
                    'ci3',
                    'gr1',
                    'or12',
                    'an6'
                ]
            ],
            [
                'name'  => 'Fruit Punch',
                'description'   => '',
                'image' => 'fruit-punch.jpg',
                'doses' => [
                    'gr1',
                    'ci3',
                    'or8',
                    'an6',
                    'cr6'
                ]
            ],
            [
                'name'  => 'Florida',
                'description'   => '',
                'image' => 'florida.jpg',
                'doses' => [
                    'gr3',
                    'ci2',
                    'or10'
                ]
            ],
            [
                'name'  => 'Allez les bleus',
                'description'   => '',
                'image' => 'allez-les-bleus.jpg',
                'doses' => [
                    'ci1',
                    'co3',
                    'cu1'
                ]
            ],
            [
                'name'  => 'Bacardi Cocktail',
                'description'   => '',
                'image' => 'bacardi.jpg',
                'doses' => [
                    'gr1',
                    'ci2',
                    'bl5'
                ]
            ],
            [
                'name'  => 'Ponche Caribenu',
                'description'   => '',
                'image' => 'ponche-caribenu.jpg',
                'doses' => [
                    'ci1',
                    'bl3',
                    'or7'
                ]
            ],
            [
                'name'  => 'Hasta Siempre',
                'description'   => '',
                'image' => 'hasta-siempre.jpg',
                'doses' => [
                    'br4',
                    'cu3',
                    'an8'
                ]
            ],
            [
                'name'  => 'Zizi coincoin',
                'description'   => '',
                'image' => 'zizi-coincoin.jpg',
                'doses' => [
                    'ci4',
                    'tr8'
                ]
            ],
            [
                'name'  => 'Cointreaupolitan',
                'description'   => '',
                'image' => 'cointreaupolitan.jpg',
                'doses' => [
                    'ci2',
                    'tr5',
                    'cr3'
                ]
            ],
            [
                'name'  => 'Balalaïka',
                'description'   => '',
                'image' => 'balalaika-troika.jpg',
                'doses' => [
                    'ci2',
                    'tr2',
                    'vo3'
                ]
            ],
            [
                'name'  => 'Basic martini',
                'description'   => '',
                'image' => 'vodkatini.jpg',
                'doses' => [
                    'ci1',
                    'ma2',
                    'vo5'
                ]
            ],
            [
                'name'  => 'Cendrillon',
                'description'   => '',
                'image' => 'cendrillon.jpg',
                'doses' => [
                    'ci3',
                    'or3',
                    'an3'
                ]
            ],
            [
                'name'  => 'Spider bite',
                'description'   => '',
                'image' => 'Spiderbite.jpg',
                'doses' => [
                    'ci1',
                    'te3'
                ]
            ],
            [
                'name'  => 'Cape Codder',
                'description'   => '',
                'image' => 'cape_codder.jpg',
                'doses' => [
                    'ci1',
                    'vo5',
                    'cr16'
                ]
            ],
            [
                'name'  => 'Purple Cosmopolitan',
                'description'   => '',
                'image' => 'purplecos.jpg',
                'doses' => [
                    'ci1',
                    'vo4',
                    'cu2',
                    'cr3'
                ]
            ],
            [
                'name'  => 'Cosmo Créole',
                'description'   => '',
                'image' => 'creolecosmo.jpg',
                'doses' => [
                    'ci1',
                    'bl4',
                    'cr4'
                ]
            ],
            [
                'name'  => 'Chill out',
                'description'   => '',
                'image' => 'chillout.jpg',
                'doses' => [
                    'ci1',
                    'br4',
                    'tr4'
                ]
            ],
            [
                'name'  => 'Viva Villa',
                'description'   => '',
                'image' => 'vivavilla.jpg',
                'doses' => [
                    'sc1',
                    'ci2',
                    'te4'
                ]
            ],
            [
                'name'  => 'Pikaki',
                'description'   => '',
                'image' => 'pikaki.jpg',
                'doses' => [
                    'ci2',
                    'gr1',
                    'br4',
                    'or2',
                    'an1'
                ]
            ],
            [
                'name'  => 'Halloween Black Spider',
                'description'   => '',
                'image' => 'halloween-black-spider.jpg',
                'doses' => [
                    'ci2',
                    'tr2',
                    'vo2',
                    'cr2'
                ]
            ],
            [
                'name'  => 'Wodka gimlet',
                'description'   => '',
                'image' => 'wodka-gimlet.jpg',
                'doses' => [
                    'ci2',
                    'vo4'
                ]
            ],
            [
                'name'  => 'Martini blue',
                'description'   => '',
                'image' => 'm2blu.jpg',
                'doses' => [
                    'sc1',
                    'ci2',
                    'ma2',
                    'cu3'
                ]
            ],
            [
                'name'  => 'Tequila Collins',
                'description'   => '',
                'image' => 'tequila-collins.jpg',
                'doses' => [
                    'sc1',
                    'ci2',
                    'te4',
                    'ea8'
                ]
            ],
            [
                'name'  => 'Cactus jack',
                'description'   => '',
                'image' => 'cactus.jpg',
                'doses' => [
                    'ci1',
                    'te1',
                    'cu1',
                    'an1',
                    'or2'
                ]
            ],
            [
                'name'  => 'Cointreau Bubbles',
                'description'   => '',
                'image' => 'bubbles.jpg',
                'doses' => [
                    'ci1',
                    'tr4',
                    'ea8'
                ]
            ],
            [
                'name'  => 'Razzita',
                'description'   => '',
                'image' => 'razzita.jpg',
                'doses' => [
                    'ci1',
                    'br5'
                ]
            ],
            [
                'name'  => 'Springtime Cooler',
                'description'   => '',
                'image' => 'springtimecooler.jpg',
                'doses' => [
                    'sc1',
                    'ci3',
                    'vo4',
                    'cu2',
                    'or6'
                ]
            ],
            [
                'name'  => 'Cointreaupirinha',
                'description'   => '',
                'image' => 'cointreaupirinha.jpg',
                'doses' => [
                    'ci2',
                    'tr4'
                ]
            ],
            [
                'name'  => 'Peg o\' My Heart',
                'description'   => '',
                'image' => 'pego.jpg',
                'doses' => [
                    'ci3',
                    'gr2',
                    'bl6'
                ]
            ],
            [
                'name'  => 'Vera Rush',
                'description'   => '',
                'image' => 'verarush.jpg',
                'doses' => [
                    'br6',
                    'an4'
                ]
            ],
            [
                'name'  => 'Chambord célébration',
                'description'   => '',
                'image' => 'chambord-celebration.jpg',
                'doses' => [
                    'ci1',
                    'ch4',
                    'vo2',
                    'ea8'
                ]
            ],
            [
                'name'  => 'Turquoise Blue',
                'description'   => '',
                'image' => 'turquoise-blue.jpg',
                'doses' => [
                    'ci2',
                    'tr1',
                    'bl2',
                    'cu2',
                    'an3'
                ]
            ],
            [
                'name'  => 'Simpson bay',
                'description'   => '',
                'image' => 'simpson-bay.jpg',
                'doses' => [
                    'gr1',
                    'cu2',
                    'br4'
                ]
            ],
            [
                'name'  => 'Punch agrume',
                'description'   => '',
                'image' => 'punch-agrume.jpg',
                'doses' => [
                    'ci2',
                    'bl4',
                    'or6'
                ]
            ],
            [
                'name'  => 'Tchaker',
                'description'   => '',
                'image' => 'tchaker.jpg',
                'doses' => [
                    'ci1',
                    'gr1',
                    'te3',
                    'an6'
                ]
            ]
        ];
    }
}
