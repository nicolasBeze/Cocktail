<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 29/04/16
 * Time: 19:19
 */

namespace Cocktail\Entity;


class Compartment {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $libelle;

    /**
     * Volume to centiliter
     * @var integer
     */
    private $volume;

    /**
     * @var Drink
     */
    private $drink;

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
     * @return int
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param int $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return Drink
     */
    public function getDrink()
    {
        return $this->drink;
    }

    /**
     * @param Drink $drink
     */
    public function setDrink(Drink $drink)
    {
        $this->drink = $drink;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

}