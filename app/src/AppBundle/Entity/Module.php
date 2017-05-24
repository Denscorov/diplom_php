<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

/**
 * Module
 *
 * @ORM\Table(name="module")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ModuleRepository")
 * @JMS\ExclusionPolicy("ALL")
 */
class Module
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
     * @Assert\NotBlank()
     * @JMS\Expose
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="modules", cascade={"persist"})
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
     * 
     */
    private $course;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Theme", mappedBy="module", cascade={"persist", "remove"})
     * @JMS\MaxDepth(1)
     * @JMS\Expose
     */
    private $themes;

    public function __construct() {
        $this->themes = new ArrayCollection();
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
     * @return Module
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
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param mixed $course
     */
    public function setCourse($course)
    {
        $this->course = $course;
    }

    public function addTheme($theme){
        $theme->setModule($this);
        $this->themes->add($theme);
    }

    public function removeTheme($theme){
        $this->themes->remove($theme);
    }

    function __toString()
    {
        return $this->name;
    }

}

