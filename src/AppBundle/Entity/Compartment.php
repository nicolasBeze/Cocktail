<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 29/04/16
 * Time: 19:19
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Compartment
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompartmentRepository")
 * @package AppBundle\Entity
 */
class Compartment {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(name="libelle", type="string", length=255)
     * @var string
     */
    private $libelle;

    /**
     * @ORM\Column(name="volume", type="integer")
     * Volume to centiliter
     * @var integer
     */
    private $volume;

    /**
     * @ORM\Column(name="remaining_volume", type="integer")
     * Volume to centiliter
     * @var integer
     */
    private $remainingVolume;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Drink")
     * @ORM\JoinColumn(nullable=false)
     * @var Drink
     */
    private $drink;

    /**
     * @ORM\Column(name="pin_gpio", type="integer")
     * @var integer
     */
    private $pinGpio;


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

    /**
     * @return int
     */
    public function getPinGpio()
    {
        return $this->pinGpio;
    }

    /**
     * @param int $pinGpio
     */
    public function setPinGpio($pinGpio)
    {
        $this->pinGpio = $pinGpio;
    }

}