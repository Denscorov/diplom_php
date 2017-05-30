<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Test
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TestRepository")
 */
class Test
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="q_count", type="integer")
     * @Assert\NotBlank()
     */
    private $qcount;

    /**
     * @var int
     *
     * @ORM\Column(name="q_t_count", type="integer")
     * @Assert\NotBlank()
     */
    private $qtcount;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="tests")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    private $student;

    /**
     * @var int
     *
     * @ORM\Column(name="date", type="string")
     * @Assert\NotBlank()
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="time", type="string")
     * @Assert\NotBlank()
     */
    private $time;

    /**
     * @var int
     *
     * @ORM\Column(name="timer", type="string")
     * @Assert\NotBlank()
     */
    private $timer;

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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
     * @return int
     */
    public function getQcount()
    {
        return $this->qcount;
    }

    /**
     * @param int $qcount
     */
    public function setQcount($qcount)
    {
        $this->qcount = $qcount;
    }

    /**
     * @return int
     */
    public function getQtcount()
    {
        return $this->qtcount;
    }

    /**
     * @param int $qtcount
     */
    public function setQtcount($qtcount)
    {
        $this->qtcount = $qtcount;
    }

    /**
     * @return mixed
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param mixed $student
     */
    public function setStudent($student)
    {
        $this->student = $student;
    }

    /**
     * @return int
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param int $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param int $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getTimer()
    {
        return $this->timer;
    }

    /**
     * @param int $timer
     */
    public function setTimer($timer)
    {
        $this->timer = $timer;
    }



}

