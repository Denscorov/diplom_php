<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * User
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"list"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"list"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Groups({"list","write"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     * @Groups({"list","write"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"list","write"})
     */
    private $type;

    /**
     * @Groups({"list","write"})
     */
    protected $email;

    /**
     * @Groups({"list","write"})
     */
    protected $username;

    /**
     * @Groups({"write"})
     */
    protected $password;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Test", mappedBy="user")
     */
    private $tests;

    public function __construct() {
        $this->test = new ArrayCollection();
        $this->enabled = false;
        $this->roles = array();
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
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getTests()
    {
        return $this->tests;
    }

    /**
     * @param mixed $tests
     */
    public function setTests($tests)
    {
        $this->tests = $tests;
    }


}

