<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Consumption;
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
        $cocktail = $cocktailRepository->find($id);

        foreach($cocktail->getDoses() as $dose){
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

            foreach($cocktail->getDoses() as $dose){
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
}
