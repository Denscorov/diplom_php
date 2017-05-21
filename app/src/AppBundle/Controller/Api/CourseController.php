<?php
/**
 * Created by PhpStorm.
 * User: den
 * Date: 21.05.17
 * Time: 8:30
 */

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Course;
use AppBundle\Form\CourseType;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * Class CourseController
 * @package AppBundle\Controller\Api
 * @RouteResource("course")
 */
class CourseController extends AbstractApiController
{
    public $entity = 'AppBundle:Course';
    public $entityClass = Course::class;
    public $formClass = CourseType::class;
}