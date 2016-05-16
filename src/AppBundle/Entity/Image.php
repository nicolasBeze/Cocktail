<?php
/**
 * Created by PhpStorm.
 * User: nicolasbeze
 * Date: 07/05/16
 * Time: 22:17
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
// N'oubliez pas ce use :
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Image
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 * @package AppBundle\Entity
 */
class Image
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(name="url", type="string", length=255)
     * @var string
     */
    private $url;

    /**
     * @ORM\Column(name="alt", type="string", length=255)
     * @var string
     */
    private $alt;

    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
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
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param mixed $alt
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }

    public function upload()
    {
        if (null === $this->file) {
            return;
        }
        $name = $this->file->getClientOriginalName();
        $this->file->move($this->getUploadRootDir(), $name);
        $this->url = $name;
        $this->alt = $name;
    }

    public function getUploadDir()
    {
        return 'bundles/app/images';
    }

    protected function getUploadRootDir()
    {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

}