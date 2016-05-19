<?php

namespace AppBundle\Handler;

use AppBundle\Entity\Cocktail;
use AppBundle\Entity\Compartment;
use AppBundle\Entity\Consumption;
use AppBundle\Entity\Dose;
use Doctrine\ORM\EntityManager;

/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 17/05/2016
 * Time: 13:25
 */
class CocktailHandler
{
    /** @var EntityManager */
    private $em;

    private $compartmentRepository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->compartmentRepository = $this->em->getRepository('AppBundle:Compartment');
    }
    
    public function remainingVolume(Cocktail $cocktail){
        
        foreach($cocktail->getDoses() as $dose){
            
            $compartment = $this->compartmentRepository->findOneBy(array('drink' => $dose->getDrink()));
            if($dose->getVolume() > $compartment->getRemainingVolume()){
                $dose->setRemainingVolume($compartment->getRemainingVolume());
            }
        }
        return $cocktail;
    }

    public function updateCompartment(Cocktail $cocktail){

        foreach($cocktail->getDoses() as $dose){
            $compartment = $this->compartmentRepository->findOneBy(array('drink' => $dose->getDrink()));
            $compartment->setRemainingVolume($compartment->getRemainingVolume() - $dose->getVolume());
            $this->serveDose($compartment->getPinGpio(), $dose);
            $this->em->persist($compartment);
            $this->em->flush();
        }
        return true;
    }

    public function addConsumption(Cocktail $cocktail){

        $consumption = new Consumption();
        $consumption->setCocktail($cocktail);
        $this->em->persist($consumption);
    }

    public function serveDose($pinGpio, Dose $dose){

        $time = $dose->getVolume() * $dose->getDrink()->getViscosity();
        exec(sprintf("gpio write %d 1", $pinGpio));
        sleep($time);
        exec(sprintf("gpio write %d 0", $pinGpio));
    }
}