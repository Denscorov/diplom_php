<?php
/**
 * Created by PhpStorm.
 * User: den
 * Date: 31.05.17
 * Time: 16:13
 */

namespace AppBundle\Controller\Web;

use AppBundle\Entity\Question;
use AppBundle\Entity\Theme;
use AppBundle\Form\QuestionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class QuestionController extends Controller
{
    /**
     * @Route("/create/{theme_id}", name="create_question")
     * @Method({"POST"})
     */
    public function createAction($theme_id, Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
        }
        $question = new Question();
        $form = $this->createEntityForm($question, QuestionType::class, 'create_question',['theme_id'=>$theme_id]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $question->setTheme($this->getDoctrine()->getRepository(Theme::class)->find($theme_id));
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Питання створено!!!');
            return new JsonResponse(array('message' => 'Success!'), 200);
        }

        $response = new JsonResponse(
            array(
                'message' => 'Error',
                'form' => $this->renderView('AppBundle:Form:form.html.twig',
                    array(
                        'entity' => $question,
                        'form' => $form->createView(),
                    ))), 400);

        return $response;
    }

    /**
     * @Route("/edit/{id}/{theme_id}", name="edit_question")
     */
    public function editAction($id, $theme_id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $course = $em->getRepository(Question::class)->find($id);
        if (!$course) {
            throw $this->createNotFoundException(
                'No news found for id ' . $id
            );
        }
        $form = $this->createForm(QuestionType::class, $course);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $object = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Питання редаговано!!!');
            return $this->redirectToRoute('questions_by_theme',['id'=>$theme_id]);
        }
        return $this->render('AppBundle:page2:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

//    /**
//     * @Route("/delete/{id}", name="web_delete_theme")
//     */
//    public function deleteAction($id)
//    {
//        $theme = $this->getDoctrine()->getRepository(Theme::class)->find($id);
//        if (!$theme != null) {
//            throw $this->createNotFoundException(
//                'No news found for id ' . $id
//            );
//        }
//        $em = $this->getDoctrine()->getManager();
//        $em->remove($theme);
//        $em->flush();
//        $this->get('session')->getFlashBag()->add('failed', 'Тему видалено!!!');
//        return $this->redirectToRoute('list_entity');
//    }

    private function createEntityForm($entity, $type, $route, $params=null)
    {
        $form = $this->createForm($type, $entity,
            array(
                'action' => $this->generateUrl($route, $params),
                'method' => 'POST',
            ));

        return $form;
    }
}