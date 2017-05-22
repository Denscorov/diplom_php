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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    /**
     * @param $id
     * Get("/{id}", name="theme")
     */
    public function getThemeAction($id){
        if (!($object = $this->get('doctrine')->getManager()->getRepository($this->entity)->getQuestionByThemeId($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        }
        return $object;
    }
}