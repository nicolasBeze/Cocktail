<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cocktail;
use AppBundle\Form\CocktailType;
use AppBundle\Form\CustomCocktailType;
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
     * @Route("/cocktail/{cocktail}", name="showCocktail", requirements={"id" = "\d+"})
     * @ParamConverter("cocktail")
     */
    public function showAction(Cocktail $cocktail)
    {
        $this->get('cocktail_handler')->remainingVolume($cocktail);

        $form = $this->createForm(CustomCocktailType::class, $cocktail);

        return $this->render('default/show.html.twig', [
            'cocktail' => $cocktail,
            'form' => $form->createView(),
        ]);
    }
}
