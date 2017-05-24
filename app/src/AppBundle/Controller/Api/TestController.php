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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class CourseController
 * @package AppBundle\Controller\Api
 * @RouteResource("test")
 */
class TestController extends AbstractApiController
{
    public $entity = 'AppBundle:Test';
    public $entityClass = Test::class;
    public $formClass = TestType::class;

    public function postArrayAction(Request $request)
    {
        foreach ($request->request->all() as $item) {
            $object = new $this->entityClass();
            $form = $this->createForm($this->formClass, $object, array('method' => 'POST',));
            $form->handleRequest($request);
            $form->submit($item);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($object);
                $em->flush();
            } else {
                throw new BadRequestHttpException("Bad request");
            }
        }
        return new Response('{"message":"OK"}', 200);
    }
}