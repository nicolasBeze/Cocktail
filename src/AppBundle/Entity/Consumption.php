<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 29/04/16
 * Time: 19:14
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Consumption
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConsumptionRepository")
 * @package AppBundle\Entity
 */
class Consumption {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cocktail")
     * @ORM\JoinColumn(nullable=false)
     * @var Cocktail
     */
    private $cocktail;

    /**
     * @ORM\Column(name="date", type="date")
     * @var Datetime
     */
    private $date;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

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