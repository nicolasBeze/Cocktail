<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cocktail;
use AppBundle\Form\FilterCocktailType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
    public function indexAction(Request $request)
    {
        $cocktailsRepository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Cocktail');

        $form = $this->createForm(FilterCocktailType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cocktails = $cocktailsRepository->findCocktailWithDrink($form->get('drink')->getData());
        } else {
            if ($request->query->get('soft', false)) {
                $cocktails = $cocktailsRepository->findByAlcohol(false);
            } else {
                $cocktails = $cocktailsRepository->findAll();
            }
        }

        return $this->render('default/index.html.twig', [
            'cocktails' => $cocktails,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/cocktail/{cocktail}", name="showCocktail", requirements={"id" = "\d+"})
     * @ParamConverter("cocktail")
     */
    public function showAction(Cocktail $cocktail)
    {
        $cocktail = $this->get('cocktail_handler')->remainingVolume($cocktail);

        return $this->render('default/show.html.twig', [
            'cocktail' => $cocktail
        ]);
    }
}
