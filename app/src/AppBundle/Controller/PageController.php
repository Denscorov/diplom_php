<?php
/**
 * Created by PhpStorm.
 * User: den
 * Date: 31.05.17
 * Time: 14:51
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Answer;
use AppBundle\Entity\Course;
use AppBundle\Entity\Module;
use AppBundle\Entity\Question;
use AppBundle\Entity\Theme;
use AppBundle\Form\AnswerType;
use AppBundle\Form\CourseType;
use AppBundle\Form\ModuleType;
use AppBundle\Form\QuestionType;
use AppBundle\Form\ThemeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    /**
     * @Route("/list-entity", name="list_entity")
     * @Method({"GET"})
     */
    public function getListEntityAction(){
        $list = $this->getDoctrine()->getRepository(Course::class)->findAll();
        $formCourse = $this->createEntityForm(new Course(), CourseType::class, 'create_course', []);
        $formModule = $this->createEntityForm(new Module(), ModuleType::class, 'create_module', []);
        $formTheme = $this->createEntityForm(new Theme(), ThemeType::class, 'create_theme', []);
        return $this->render('AppBundle:page2:list.html.twig',[
            'list' => $list,
            'formCourse' => $formCourse->createView(),
            'formModule' => $formModule->createView(),
            'formTheme' => $formTheme->createView()
        ]);
    }

    /**
     * @Route("/list-questions/theme/{id}", name="questions_by_theme")
     * @Method("GET")
     */
    public function getQuestionByThemeAction($id){
        $questions = $this->getDoctrine()->getRepository(Question::class)->getQuestionByThemeId($id);

        $formQuestion = $this->createEntityForm(new Question(),QuestionType::class,'create_question',['theme_id'=>$id]);
        $formAnswer = $this->createEntityForm(new Answer(),AnswerType::class,'create_question',['theme_id'=>$id]);


        return $this->render('AppBundle:page2:list-questions.html.twig',[
            'questions' => $questions,
            'formQuestion' => $formQuestion->createView(),
            'formAnswer' => $formAnswer->createView(),
            'theme_id' => $id
        ]);
    }



    /**
     * @param $entity
     * @param $type
     * @param $route
     * @return \Symfony\Component\Form\Form
     */
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