<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 29/04/16
 * Time: 19:14
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Dose", cascade={"persist"})
     * @var ArrayCollection
     */
    private $doses;
    /**
     * @ORM\Column(name="date", type="date")
     * @var Datetime
     */
    private $date;

    public function __construct()
    {
        $this->date = new \DateTime();
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
     * @param Collection $doses
     */
    public function setDoses(Collection $doses)
    {
        $this->doses = $doses;
    }

    /**
     * @param Dose $dose
     */
    public function addDose(Dose $dose)
    {
        if ($this->doses->contains($dose)) {
            return;
        }

        $this->doses->add($dose);
    }

    /**
     * @param Dose $dose
     */
    public function removeDose(Dose $dose)
    {
        $this->doses->removeElement($dose);
    }

    /**
     * @return ArrayCollection Dose
     */
    public function getDoses()
    {
        return $this->doses;
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
