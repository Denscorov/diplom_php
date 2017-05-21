<?php
/**
 * Created by PhpStorm.
 * User: den
 * Date: 21.05.17
 * Time: 8:30
 */

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Theme;
use AppBundle\Form\ThemeType;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * Class CourseController
 * @package AppBundle\Controller\Api
 * @RouteResource("theme")
 */
class ThemeController extends AbstractApiController
{
    public $entity = 'AppBundle:Theme';
    public $entityClass = Theme::class;
    public $formClass = ThemeType::class;
}