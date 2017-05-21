<?php
/**
 * Created by PhpStorm.
 * User: den
 * Date: 21.05.17
 * Time: 8:30
 */

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Question;
use AppBundle\Form\QuestionType;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * Class CourseController
 * @package AppBundle\Controller\Api
 * @RouteResource("question")
 */
class QuestionController extends AbstractApiController
{
    public $entity = 'AppBundle:Question';
    public $entityClass = Question::class;
    public $formClass = QuestionType::class;
}