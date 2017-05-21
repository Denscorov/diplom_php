<?php
/**
 * Created by PhpStorm.
 * User: den
 * Date: 21.05.17
 * Time: 8:30
 */

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Module;
use AppBundle\Form\ModuleType;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * Class CourseController
 * @package AppBundle\Controller\Api
 * @RouteResource("module")
 */
class ModuleController extends AbstractApiController
{
    public $entity = 'AppBundle:Module';
    public $entityClass = Module::class;
    public $formClass = ModuleType::class;
}