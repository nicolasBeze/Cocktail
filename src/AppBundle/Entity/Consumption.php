<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 29/04/16
 * Time: 19:14
 */

namespace Cocktail\Entity;


class Consumption {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var Cocktail
     */
    private $cocktail;

    /**
     * @var Datetime
     */
    private $date;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Cocktail
     */
    public function getCocktail()
    {
        return $this->cocktail;
    }

    /**
     * @param Cocktail $cocktail
     */
    public function setCocktail(Cocktail $cocktail)
    {
        $this->cocktail = $cocktail;
    }

    /**
     * @return Datetime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param Datetime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


}