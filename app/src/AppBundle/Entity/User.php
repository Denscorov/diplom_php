<?php
/**
 * Created by PhpStorm.
 * User: den
 * Date: 20.05.17
 * Time: 17:31
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Student", mappedBy="teacher")
     */
    private $students;

    public function __construct()
    {
        parent::__construct();
        $this->students = new ArrayCollection();
    }

    public function AddStudent($student){
        $this->students->add($student);
    }

    public function RemoveStudent($student){
        $this->students->remove($student);
    }

    /**
     * @return mixed
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param mixed $students
     */
    public function setStudents($students)
    {
        $this->students = $students;
    }



}