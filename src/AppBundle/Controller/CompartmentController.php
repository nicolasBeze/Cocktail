<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 16/05/2016
 * Time: 13:20
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\AjustmentType;
use AppBundle\Form\CompartmentType;
use Symfony\Component\HttpFoundation\Request;

class CompartmentController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/reserve", name="compartment")
     */
    public function reserveAction()
    {
        $em = $this->getDoctrine()->getManager();

        $compartmentRepository = $em->getRepository('AppBundle:Compartment');
        $compartments = $compartmentRepository->findAll();

        return $this->render('compartment/index.html.twig', [
            'compartments' => $compartments
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/reserve/{id}", name="showCompartment", requirements={"id" = "\d+"})
     */
    public function showReserveAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $compartmentRepository = $em->getRepository('AppBundle:Compartment');
        $compartment = $compartmentRepository->find($id);

        $form = $this->createForm(CompartmentType::class, $compartment);

        if ($form->handleRequest($request)->isValid()) {
            $compartment->setRemainingVolume($compartment->getVolume());
            $em->persist($compartment);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', printf('%s contient maintenant %s de %d cl.', $compartment->getLibelle(), $compartment->getDrink()->getName(), $compartment->getRemainingVolume()));
            return $this->redirectToRoute('compartment');
        }

        $formAjustment = $this->createForm(AjustmentType::class, $compartment);

        if ($formAjustment->handleRequest($request)->isValid()) {
            $compartment->setRemainingVolume($compartment->getRemainingVolume() - 1);
            $em->persist($compartment);
            $em->flush();
            /** TODO enlever 1 cl raspberry */
            return $this->redirectToRoute('showCompartment', array('id' => $id));
        }

        return $this->render('compartment/show.html.twig', [
            'compartment' => $compartment,
            'form' => $form->createView(),
            'formAjustment' => $formAjustment->createView()
        ]);
    }
}