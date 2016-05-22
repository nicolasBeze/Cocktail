<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 16/05/2016
 * Time: 13:42
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Cocktail;
use AppBundle\Form\CocktailType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CocktailController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/liste/cocktail", name="cocktail")
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

        return $this->render('cocktail/index.html.twig', [
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
     * @Route("/make/cocktail/{cocktail}", name="makeCocktail", requirements={"id" = "\d+"})
     * @ParamConverter("cocktail")
     */
    public function makeCocktailAction(Cocktail $cocktail)
    {
        /** todo si cocktail en cour, on envoie bouler */
        /** todo crer un fichier de bloquage */
        $this->get('cocktail_handler')->addConsumption($cocktail);
        $this->get('cocktail_handler')->updateCompartment($cocktail);
        /** todo supprimer fichier de bloquage */
        return new Response();
    }
}