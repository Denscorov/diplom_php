<?php
/**
 * Created by PhpStorm.
 * User: den
 * Date: 21.05.17
 * Time: 8:30
 */

namespace AppBundle\Controller\Api;


use AppBundle\Form\StudentType;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use AppBundle\Entity\Student;

/**
 * Class CourseController
 * @package AppBundle\Controller\Api
 * @RouteResource("student")
 */
class StudentController extends AbstractApiController
{
    public $entity = 'AppBundle:Student';
    public $entityClass = StudentType::class;
    public $formClass = Student::class;
}