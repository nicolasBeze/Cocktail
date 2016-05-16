<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 16/05/2016
 * Time: 13:35
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Drink;
use AppBundle\Form\DrinkType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DrinkController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/drink", name="drink")
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

        return $this->render('drink/index.html.twig', [
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
}