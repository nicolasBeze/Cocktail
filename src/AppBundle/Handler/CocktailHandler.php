<?php

namespace AppBundle\Handler;

use AppBundle\Entity\Cocktail;
use AppBundle\Entity\Compartment;
use AppBundle\Entity\Consumption;
use AppBundle\Entity\Dose;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;

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

    /**
     * @var SecureHandler
     */
    private $secureHandler;
    /**
     * @var ProgressBar
     */
    private $progessBar;

    public function __construct(EntityManager $em, SecureHandler $secureHandler)
    {
        $this->em = $em;
        $this->compartmentRepository = $this->em->getRepository('AppBundle:Compartment');
        $this->secureHandler = $secureHandler;
    }

    /**
     * @param ProgressBar $progressBar
     */
    public function setProgressBar(ProgressBar $progressBar)
    {
        $this->progessBar = $progressBar;
    }

    public function remainingVolume(Cocktail $cocktail){

        foreach($cocktail->getDoses() as $dose){

            $compartment = $this->compartmentRepository->findOneBy(array('drink' => $dose->getDrink()));
            if($dose->getVolume() > $compartment->getRemainingVolume()){
                $dose->setRemainingVolume($compartment->getRemainingVolume());
            }
        }
    }

    public function updateCompartment(Collection $doses){

        foreach($doses as $dose){
            $compartment = $this->compartmentRepository->findOneBy(['drink' => $dose->getDrink()]);
            $compartment->setRemainingVolume($compartment->getRemainingVolume() - $dose->getVolume());
            $this->serveDose($compartment->getPinGpio(), $dose);
            $this->em->persist($compartment);
        }
        $this->em->flush();
    }

    public function addConsumption(Collection $doses){

        $consumption = new Consumption();
        $consumption->setDoses($doses);
        $this->em->persist($consumption);
    }

    public function serveDose($pinGpio, Dose $dose){
        $timeElapsed = 0;
        $time = $dose->getVolume() * $dose->getDrink()->getViscosity();
        $sleepProcess = new Process('sleep 1');

        (new Process(sprintf('gpio mode %d out', $pinGpio)))->mustRun();
        while ($timeElapsed < $time) {
            $sleepProcess->mustRun();
            if (null !== $this->progessBar) {
                $this->progessBar->advance();
            }
            ++$timeElapsed;
        }
        (new Process(sprintf('gpio mode %d in', $pinGpio)))->mustRun();
    }

    public function serveCocktail(Collection $doses)
    {
        if ($doses->isEmpty()) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Aucune boisson dans le cocktail',
            ]);
        }

        if(!$this->secureHandler->checkAndCreateSecurity()){
            return new JsonResponse([
                'success' => false,
                'message' => 'Fait la queue, soiffard!',
            ]);
        }

        $this->addConsumption($doses);
        $this->updateCompartment($doses);
        $this->secureHandler->deletedSecurity();

        return new JsonResponse(['success' => true]);
    }
}
