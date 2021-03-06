<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

/**
 * Course
 *
 * @ORM\Table(name="course")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CourseRepository")
 * @JMS\ExclusionPolicy("ALL")
 */
class Course
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     * @ORM\OrderBy({"name" = "ASC"})
     * @Assert\NotBlank()
     * @JMS\Expose
     */
    private $name;

    /**
     * @var Module
     * @ORM\OneToMany(targetEntity="Module", mappedBy="course", cascade={"persist", "remove"})
     * @JMS\MaxDepth(1)
     * @JMS\Expose
     */
    private $modules;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Course
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * @param mixed $modules
     */
    public function setModules($modules)
    {
        $this->modules = $modules;
    }

    public function addModule(Module $module){
        $module->setCourse($this);
        $this->modules->add($module);
    }

    public function removeModule(Module $module){
        $this->modules->remove($module);
    }

    function __toString()
    {
        return $this->name;
    }

}

