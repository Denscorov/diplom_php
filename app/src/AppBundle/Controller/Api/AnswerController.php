<?php
/**
 * Created by PhpStorm.
 * User: den
 * Date: 21.05.17
 * Time: 8:30
 */

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Answer;
use AppBundle\Form\AnswerType;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * Class CourseController
 * @package AppBundle\Controller\Api
 * @RouteResource("answer")
 */
class AnswerController extends AbstractApiController
{
    public $entity = 'AppBundle:Answer';
    public $entityClass = Answer::class;
    public $formClass = AnswerType::class;
}