<?php
/**
 * Created by PhpStorm.
 * User: den
 * Date: 31.05.17
 * Time: 14:51
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Course;
use AppBundle\Entity\Module;
use AppBundle\Entity\Theme;
use AppBundle\Form\CourseType;
use AppBundle\Form\ModuleType;
use AppBundle\Form\ThemeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    /**
     * @Route("/list-entity", name="list-entity")
     * @Method({"GET"})
     */
    public function getListEntityAction(){
        $list = $this->getDoctrine()->getRepository(Course::class)->findAll();
        $formCourse = $this->createEntityForm(new Course(), CourseType::class);
        $formModule = $this->createEntityForm(new Module(), ModuleType::class);
        $formTheme = $this->createEntityForm(new Theme(), ThemeType::class);
        return $this->render('AppBundle:page2:list.html.twig',[
            'list' => $list,
            'formCourse' => $formCourse->createView(),
            'formModule' => $formModule->createView(),
            'formTheme' => $formTheme->createView()
        ]);
    }

//    /**
//     * @Route("/create-course", name="create-course")
//     * @Method("POST")
//     */
//    public function createCourseAction(Request $request)
//    {
//        if (!$request->isXmlHttpRequest()) {
//            return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
//        }
//        $course = new Course();
//        $form = $this->createCreateForm($course);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($course);
//            $em->flush();
//
//            return new JsonResponse(array('message' => 'Success!'), 200);
//        }
//
//        $response = new JsonResponse(
//            array(
//                'message' => 'Error',
//                'form' => $this->renderView('AcmeDemoBundle:Demo:form.html.twig',
//                    array(
//                        'entity' => $course,
//                        'form' => $form->createView(),
//                    ))), 400);
//
//        return $response;
//    }

    private function createEntityForm($entity, $type)
    {
        $form = $this->createForm($type, $entity,
            array(
                'action' => $this->generateUrl('list-entity'),
                'method' => 'POST',
            ));

        return $form;
    }
}