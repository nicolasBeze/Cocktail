<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 29/04/16
 * Time: 18:19
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Drink
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DrinkRepository")
 * @package Cocktail\Entity
 */
class Drink {

    const VISCOSITY_ALCOOL = 1.74;
    const VISCOSITY_COINTREAU = 2.31;
    const VISCOSITY_ANANAS = 1.67;
    const VISCOSITY_ORANGE = 1.63;
    const VISCOSITY_CRANBERRY = 1.37;
    const VISCOSITY_CITRON = 7.46;
    const VISCOSITY_GRENADINE = 10;
    const VISCOSITY_SUCRE_DE_CANNE = 20;
    const VISCOSITY_CURACAO = 1;
    const VISCOSITY_CHAMBORD = 1;
    const VISCOSITY_EAU_GAZEUSE = 1;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @var Image
     */
    private $image;

    /**
     * @ORM\Column(name="viscosity", type="float")
     * @var float
     */
    private $viscosity;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param Image $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getViscosity()
    {
        return $this->viscosity;
    }

    /**
     * @param int $viscosity
     */
    public function setViscosity($viscosity)
    {
        $this->viscosity = $viscosity;
    }


}