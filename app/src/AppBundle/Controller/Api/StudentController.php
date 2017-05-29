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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CourseController
 * @package AppBundle\Controller\Api
 * @RouteResource("student")
 */
class StudentController extends AbstractApiController
{
    public $entity = 'AppBundle:Student';
    public $entityClass = Student::class;
    public $formClass = StudentType::class;

    /**
     * @param $id
     * Put("/{id}/{is_active}", name="active")
     */
    public function putActiveAction($id, $is_active)
    {
        if (!($object = $this->get('doctrine')->getManager()->getRepository($this->entity)->find($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        }
        $object->setIsActive($is_active);
        $em = $this->getDoctrine()->getManager();
        $em->persist($object);
        $em->flush();
        return $object;
    }

    /**
     * @param $id
     * Get("/{login}/{password}", name="auth")
     */
    public function getAuthAction($login, $password)
    {
        if (!($object = $this->get('doctrine')->getManager()->getRepository($this->entity)->findBy(['login'=>$login, 'password'=>$password]))) {
            throw new NotFoundHttpException(sprintf('User with login \'%s\' and password \'%s\' was not found.', $login, $password));
        }
$object[0]->setIsActive(true);
$em = $this->getDoctrine()->getManager();
        $em->persist($object[0]);
        $em->flush();
        return $object[0];
    }


}
