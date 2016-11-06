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

        $drinks = [
            'ma', 'vo', 'bl', 'br',
            'te', 'tr', 'cu', 'co',
            'sc', 'ci', 'gr', 'or',
            'cr', 'an', 'ea', 'ch'
            ];
        $dataDoses = [];
        foreach($drinks as $drink){
            for($i = 1; $i < 25; $i++){
                $dataDoses[] = [
                    'drink'   => $drink,
                    'volume' => $i,
                ];
            }
        }
        return $dataDoses;
    }
}