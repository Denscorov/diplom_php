<?php
/**
 * Created by PhpStorm.
 * User: den
 * Date: 21.05.17
 * Time: 8:59
 */

namespace AppBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use JMS\Serializer\SerializationContext;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
/**
 * Abstract Api Controller.
 *
 */
abstract class AbstractApiController extends FOSRestController
{
    public $entity = 'BoboyanTradeBundle:Demo';

    public $entityClass = '\Boboyan\TradeBundle\Entity\Demo';

    public $formClass = 'Boboyan\TradeBundle\Form\DemoType';

    /**
     * List all objects.
     *
     * @ApiDoc(
     *     resource=true
     * )
     *
     * @QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing objects.")
     * @QueryParam(name="limit", requirements="\d+", default="5", description="How many objects to return.")
     *
     *
     * @param Request $request the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     *
     */
    public function cgetAction(Request $request/*, ParamFetcherInterface $paramFetcher*/)
    {
        $offset = $request->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $request->get('limit');
        $limit = null == $limit ? 100 : $limit;
        return $objects = $this->get('doctrine')->getManager()->getRepository($this->entity)
            ->findBy(array()/* $criteria */, null /* $orderBy */, $limit, $offset);
    }

    /**
     * Fetch an object or throw an 404 Exception.
     *
     * @ApiDoc(
     * )
     *
     * @View()
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function getAction($id)
    {
        if (!($object = $this->get('doctrine')->getManager()->getRepository($this->entity)->find($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        }
        return $object;
    }

    /**
     * Create a Object from the submitted data.
     *
     * @ApiDoc()
     *
     * @View()
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     *
     * @throws BadRequestHttpException
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request)
    {
        $object = new $this->entityClass();

        $form = $this->createForm($this->formClass, $object, array('method' => 'POST',));
        $form->handleRequest($request);
        $form->submit($request->request->all());
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($object);
            $em->flush();
            return $object;
        } else {
            throw new BadRequestHttpException("Bad request");
        }
    }

    /**
     * Update object
     *
     * @ApiDoc()
     *
     * @View()
     *
     * @param int $id
     *
     * @return Response
     *
     * @throws NotFoundHttpException
     * @throws BadRequestHttpException
     * @Security("has_role('ROLE_USER')")
     */
    public function putAction($id, Request $request)
    {
        $object = $this->get('doctrine')->getManager()->getRepository($this->entity)->find($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        }

        $form = $this->createForm($this->formClass, $object, array('method' => 'PUT'));
        if ($request->getMethod() == 'PUT') {
            $form->handleRequest($request);
            $form->submit($request->request->all());
            if ($form->isValid() && $form->isSubmitted()) {
                $em = $this->getDoctrine()->getManager();
                $object = $form->getData();
                $em->persist($object);
                $em->flush();
                return $object;
            } else {
                throw new BadRequestHttpException("Bad request");
            }
        }
    }

    /**
     * Delete Object
     *
     * @ApiDoc()
     *
     * @param int $id
     *
     * @View()
     *
     * @throws NotFoundHttpException
     * @Security("has_role('ROLE_USER')")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $object = $em->getRepository($this->entity)->find($id);
        if (!$object) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        }
        $em->remove($object);
        $em->flush();
    }
}