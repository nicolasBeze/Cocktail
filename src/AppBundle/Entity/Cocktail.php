<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 29/04/16
 * Time: 18:15
 */

namespace Cocktail\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class Cocktail
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $image;

    /**
     * @var ArrayCollection
     */
    private $doses;

    public function __construct()
    {
        $this->doses = new ArrayCollection();
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
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @param Dose $dose
     * @return $this
     */
    public function addDose(Dose $dose)
    {
        $this->doses[] = $dose;

        return $this;
    }

    /**
     * @param Dose $dose
     */
    public function removeDose(Dose $dose)
    {
        $this->doses->removeElement($dose);
    }

    /**
     * @return ArrayCollection
     */
    public function getDoses()
    {
        return $this->doses;
    }




}