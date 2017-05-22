<?php
/**
 * Created by PhpStorm.
 * User: den
 * Date: 21.05.17
 * Time: 8:30
 */

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Test;
use AppBundle\Form\TestType;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * Class CourseController
 * @package AppBundle\Controller\Api
 * @RouteResource("test")
 */
class TestController extends AbstractApiController
{
    public $entity = 'AppBundle:Test';
    public $entityClass = TestType::class;
    public $formClass = Test::class;
}