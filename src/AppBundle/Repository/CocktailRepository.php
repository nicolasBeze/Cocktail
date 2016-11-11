<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Drink;
use Doctrine\ORM\EntityRepository;

/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 16/05/2016
 * Time: 13:56
 */
class CocktailRepository extends EntityRepository
{
    public function findCocktailWithDrink(Drink $drink)
    {
        return $this->createQueryBuilder('c')
            ->join('c.doses', 'd')
            ->join('d.drink', 'k')
            ->where('k = :drink')
            ->setParameter('drink', $drink)
            ->getQuery()
            ->getResult()
        ;
    }
}
