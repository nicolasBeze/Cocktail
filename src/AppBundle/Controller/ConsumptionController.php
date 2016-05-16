<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 16/05/2016
 * Time: 13:45
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConsumptionController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/consommation", name="consumption")
     */
    public function consumptionAction()
    {
        $em = $this->getDoctrine()->getManager();

        $consumptionRepository = $em->getRepository('AppBundle:Consumption');
        $consumptions = $consumptionRepository->findAll();

        $statisticCocktail = [];
        foreach($consumptions as $consumption){

            if(!empty($statisticCocktail[$consumption->getCocktail()->getId()])){
                $statisticCocktail[$consumption->getCocktail()->getId()] += 1;
            }else{
                $statisticCocktail[$consumption->getCocktail()->getId()] = 1;
            }
        }

        return $this->render('consumption/index.html.twig', [
            'consumptions' => $consumptions,
            'statisticCocktail' => $statisticCocktail
        ]);
    }
}