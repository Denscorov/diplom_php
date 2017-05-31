<?php
/**
 * Created by PhpStorm.
 * User: den
 * Date: 31.05.17
 * Time: 16:13
 */

namespace AppBundle\Controller\Web;

use AppBundle\Entity\Theme;
use AppBundle\Form\ThemeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ThemeController extends Controller
{
    /**
     * @Route("/create", name="create_theme")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
        }
        $course = new Theme();
        $form = $this->createEntityForm($course, ThemeType::class, 'create_theme');
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($course);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Тему створено!!!');
            return new JsonResponse(array('message' => 'Success!'), 200);
        }

        $response = new JsonResponse(
            array(
                'message' => 'Error',
                'form' => $this->renderView('AcmeDemoBundle:Demo:form.html.twig',
                    array(
                        'entity' => $course,
                        'form' => $form->createView(),
                    ))), 400);

        return $response;
    }

    /**
     * @Route("/edit/{id}", name="edit_theme")
     */
    public function editAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $course = $em->getRepository(Theme::class)->find($id);
        if (!$course) {
            throw $this->createNotFoundException(
                'No news found for id ' . $id
            );
        }
        $form = $this->createForm(ThemeType::class, $course);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $object = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Тему редаговано!!!');
            return $this->redirectToRoute('list_entity');
        }
        return $this->render('AppBundle:page2:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", name="web_delete_theme")
     */
    public function deleteAction($id)
    {
        $theme = $this->getDoctrine()->getRepository(Theme::class)->find($id);
        if (!$theme != null) {
            throw $this->createNotFoundException(
                'No news found for id ' . $id
            );
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($theme);
        $em->flush();
        $this->get('session')->getFlashBag()->add('failed', 'Тему видалено!!!');
        return $this->redirectToRoute('list_entity');
    }

    private function createEntityForm($entity, $type, $route)
    {
        $form = $this->createForm($type, $entity,
            array(
                'action' => $this->generateUrl($route),
                'method' => 'POST',
            ));

        return $form;
    }
}