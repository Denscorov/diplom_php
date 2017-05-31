<?php
/**
 * Created by PhpStorm.
 * User: den
 * Date: 31.05.17
 * Time: 16:13
 */

namespace AppBundle\Controller\Web;

use AppBundle\Entity\Course;
use AppBundle\Form\CourseType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CourseController extends Controller
{
    /**
     * @Route("/create", name="create_course")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
        }
        $course = new Course();
        $form = $this->createEntityForm($course, CourseType::class, 'create_course', []);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($course);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Курс добавлено!!!');
            return new JsonResponse(array('message' => 'Success!'), 200);
        }

        $response = new JsonResponse(
            array(
                'message' => 'Error',
                'form' => $this->renderView('AppBundle:Form:form.html.twig',
                    array(
                        'entity' => $course,
                        'form' => $form->createView(),
                    ))), 400);

        return $response;
    }

    /**
     * @Route("/edit/{id}", name="edit_course")
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $course = $em->getRepository(Course::class)->find($id);
        if (!$course) {
            throw $this->createNotFoundException(
                'No news found for id ' . $id
            );
        }
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $object = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Курс редаговано!!!');
            return $this->redirectToRoute('list_entity');
        }
        return $this->render('AppBundle:page2:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", name="web_delete_course")
     */
    public function deleteAction($id)
    {
        $course = $this->getDoctrine()->getRepository(Course::class)->find($id);
        if (!$course != null) {
            throw $this->createNotFoundException(
                'No news found for id ' . $id
            );
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($course);
        $em->flush();
        $this->get('session')->getFlashBag()->add('failed', 'Курс видалено!!!');
        return $this->redirectToRoute('list_entity');
    }

    /**
     * @param $entity
     * @param $type
     * @param $route
     * @return \Symfony\Component\Form\Form
     */
    private function createEntityForm($entity, $type, $route, $params = null)
    {
        $form = $this->createForm($type, $entity,
            array(
                'action' => $this->generateUrl($route, $params),
                'method' => 'POST',
            ));

        return $form;
    }
}