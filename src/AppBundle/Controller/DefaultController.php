<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cocktail;
use AppBundle\Entity\Drink;
use AppBundle\Form\DrinkType;
use AppBundle\Form\CocktailType;
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
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $cocktailRepository = $em->getRepository('AppBundle:Cocktail');
        $cocktail = $cocktailRepository->find($id);

        return $this->render('default/show.html.twig', [
            'cocktail' => $cocktail
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
}
