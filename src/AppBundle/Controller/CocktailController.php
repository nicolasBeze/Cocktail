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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
}