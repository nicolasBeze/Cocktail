<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 29/04/16
 * Time: 18:24
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Dose
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DoseRepository")
 * @package AppBundle\Entity
 */
class Dose {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(name="volume", type="integer")
     * Volume to centiliter
     * @var integer
     */
    private $volume;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Drink")
     * @ORM\JoinColumn(nullable=false)
     * @var Drink
     */
    private $drink;

    /**
     * @var integer
     */
    private $remainingVolume;


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
     * @return int
     */
    public function getRemainingVolume()
    {
        return $this->remainingVolume;
    }

    /**
     * @param int $remainingVolume
     */
    public function setRemainingVolume($remainingVolume)
    {
        $this->remainingVolume = $remainingVolume;
    }
}
