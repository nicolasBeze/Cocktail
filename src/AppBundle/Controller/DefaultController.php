<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cocktail;
use AppBundle\Entity\Compartment;
use AppBundle\Entity\Consumption;
use AppBundle\Entity\Dose;
use AppBundle\Entity\Drink;
use AppBundle\Form\AjustmentType;
use AppBundle\Form\CompartmentType;
use AppBundle\Form\DrinkType;
use AppBundle\Form\CocktailType;
use AppBundle\Form\MakeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cocktailRepository = $em->getRepository('AppBundle:Cocktail');
        $cocktails = $cocktailRepository->findAll();

        return $this->render('default/index.html.twig', [
            'cocktails' => $cocktails
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/cocktail/{id}", name="showCocktail", requirements={"id" = "\d+"})
     */
    public function showAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $compartmentRepository = $em->getRepository('AppBundle:Compartment');
        $cocktailRepository = $em->getRepository('AppBundle:Cocktail');

        /** @var Cocktail $cocktail */
        $cocktail = $cocktailRepository->find($id);

        /** @var Dose $dose */
        foreach($cocktail->getDoses() as $dose){
            /** @var Compartment $compartment */
            $compartment = $compartmentRepository->findOneBy(array('drink' => $dose->getDrink()));
            if($dose->getVolume() > $compartment->getRemainingVolume()){
                $dose->setRemainingVolume($compartment->getRemainingVolume());
            }
        }

        $form = $this->createForm(MakeType::class, $cocktail);

        if ($form->handleRequest($request)->isValid()) {

            $consumption = new Consumption();
            $consumption->setCocktail($cocktail);
            $em->persist($consumption);

            /** @var Dose $dose */
            foreach($cocktail->getDoses() as $dose){
                /** @var Compartment $compartment */
                $compartment = $compartmentRepository->findOneBy(array('drink' => $dose->getDrink()));
                $compartment->setRemainingVolume($compartment->getRemainingVolume() - $dose->getVolume());
                $em->persist($compartment);
            }
            $em->flush();
            /** TODO enlever 1 cl raspberry */
            return $this->redirectToRoute('showCocktail', array('id' => $id));
        }

        return $this->render('default/show.html.twig', [
            'cocktail' => $cocktail,
            'form' => $form->createView()
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/reserve", name="reserve")
     */
    public function reserveAction()
    {
        $em = $this->getDoctrine()->getManager();

        $compartmentRepository = $em->getRepository('AppBundle:Compartment');
        $compartments = $compartmentRepository->findAll();

        return $this->render('default/reserve.html.twig', [
            'compartments' => $compartments
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/reserve/{id}", name="showReserve", requirements={"id" = "\d+"})
     */
    public function showReserveAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $compartmentRepository = $em->getRepository('AppBundle:Compartment');
        /** @var Compartment $compartment */
        $compartment = $compartmentRepository->find($id);

        $form = $this->createForm(CompartmentType::class, $compartment);

        if ($form->handleRequest($request)->isValid()) {
            $compartment->setRemainingVolume($compartment->getVolume());
            $em->persist($compartment);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', printf('%s contient maintenant %s de %d cl.', $compartment->getLibelle(), $compartment->getDrink()->getName(), $compartment->getRemainingVolume()));
            return $this->redirectToRoute('reserve');
        }

        $formAjustment = $this->createForm(AjustmentType::class, $compartment);

        if ($formAjustment->handleRequest($request)->isValid()) {
            $compartment->setRemainingVolume($compartment->getRemainingVolume() - 1);
            $em->persist($compartment);
            $em->flush();
            /** TODO enlever 1 cl raspberry */
            return $this->redirectToRoute('showReserve', array('id' => $id));
        }

        return $this->render('default/reserveshow.html.twig', [
            'compartment' => $compartment,
            'form' => $form->createView(),
            'formAjustment' => $formAjustment->createView()
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/list/drink", name="drink")
     */
    public function drinkAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $drinkRepository = $em->getRepository('AppBundle:Drink');
        $drinks = $drinkRepository->findAll();

        $drink = new Drink();
        $form = $this->createForm(DrinkType::class, $drink);

        if ($form->handleRequest($request)->isValid()) {
            $drink->getImage()->upload();
            $em->persist($drink);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', printf('%s bien enregistrée.', $drink->getName()));
            return $this->redirectToRoute('drink');
        }

        return $this->render('default/drink.html.twig', [
            'drinks' => $drinks,
            'form' => $form->createView()
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/drink/{id}", name="deleteDrink", requirements={"id" = "\d+"})
     */
    public function deleteDrinkAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $drinkRepository = $em->getRepository('AppBundle:Drink');
        $drink = $drinkRepository->find($id);
        $em->remove($drink);
        $em->flush();

        return $this->redirectToRoute('drink');

    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/list/cocktail", name="cocktail")
     */
    public function cocktailAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $cocktailRepository = $em->getRepository('AppBundle:Cocktail');
        $cocktails = $cocktailRepository->findAll();

        $cocktail = new Cocktail();
        $form = $this->createForm(CocktailType::class, $cocktail);

        if ($form->handleRequest($request)->isValid()) {
            $cocktail->getImage()->upload();
            $em->persist($cocktail);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', printf('%s bien enregistrée.', $cocktail->getName()));
            return $this->redirectToRoute('cocktail');
        }

        return $this->render('default/cocktail.html.twig', [
            'cocktails' => $cocktails,
            'form' => $form->createView()
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/cocktail/{id}", name="deleteCocktail", requirements={"id" = "\d+"})
     */
    public function deleteCocktailAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $cocktailRepository = $em->getRepository('AppBundle:Cocktail');
        $cocktail = $cocktailRepository->find($id);
        $em->remove($cocktail);
        $em->flush();

        return $this->redirectToRoute('cocktail');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/consommation", name="consumption")
     */
    public function consumptionAction()
    {
        $em = $this->getDoctrine()->getManager();

        $consumptionRepository = $em->getRepository('AppBundle:Consumption');
        /** @var Consumption $consumptions */
        $consumptions = $consumptionRepository->findAll();

        $statisticCocktail = [];
        /** @var Consumption $consumption */
        foreach($consumptions as $consumption){

            if(!empty($statisticCocktail[$consumption->getCocktail()->getId()])){
                $statisticCocktail[$consumption->getCocktail()->getId()] += 1;
            }else{
                $statisticCocktail[$consumption->getCocktail()->getId()] = 1;
            }
        }

        return $this->render('default/consumption.html.twig', [
            'consumptions' => $consumptions,
            'statisticCocktail' => $statisticCocktail
        ]);
    }
}
