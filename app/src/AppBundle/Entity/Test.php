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
     * @Groups({"read"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"read","write"})
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"read","write"})
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="QCount", type="integer")
     * @Assert\NotBlank()
     * @Groups({"read","write"})
     */
    private $qCount;

    /**
     * @var int
     *
     * @ORM\Column(name="QTCount", type="integer")
     * @Assert\NotBlank()
     * @Groups({"read","write"})
     */
    private $qTCount;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="tests")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     * @Groups({"read","write"})
     */
    private $student;

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
     * Set type
     *
     * @param string $type
     *
     * @return Test
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Test
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set qCount
     *
     * @param integer $qCount
     *
     * @return Test
     */
    public function setQCount($qCount)
    {
        $this->qCount = $qCount;

        return $this;
    }

    /**
     * Get qCount
     *
     * @return int
     */
    public function getQCount()
    {
        return $this->qCount;
    }

    /**
     * Set qTCount
     *
     * @param integer $qTCount
     *
     * @return Test
     */
    public function setQTCount($qTCount)
    {
        $this->qTCount = $qTCount;

        return $this;
    }

    /**
     * Get qTCount
     *
     * @return int
     */
    public function getQTCount()
    {
        return $this->qTCount;
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

}

