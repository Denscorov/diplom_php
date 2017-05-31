<?php

namespace AppBundle\Form;

use AppBundle\Entity\Answer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Tests\Fixtures\ChoiceSubType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', null, [
                'label' => 'Текст питання'
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'З багатьма вірнми відповідями' => 0,
                    'З однією вірною відповідю' => 1,
                    'Відповідь вводиться' => 2,
                ],
                'label' => 'Тип відповідей питання'
            ])
            ->add('level', ChoiceType::class, [
                'choices' => [
                    'Екстернат' => 0,
                    'Заочна форма' => 1,
                    'Заочна та стаціонар' => 2,
                    'Стаціонар' => 3,
                ],
                'label' => 'Рівень складності'
            ])
            ->add('myEquivalent', null, [
                'label' => 'Еквівалентні питання'
            ])
            ->add('answers', CollectionType::class, array(
                'label' => 'Відповіді',
                'entry_type' => AnswerType::class,
                'allow_add'    => true,
                'by_reference' => false,
                'attr' => [
                    'class' => 'answers_div'
                ]
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Question',
            'csrf_protection' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_question';
    }


}
