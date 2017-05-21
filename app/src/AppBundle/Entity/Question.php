<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

/**
 * Question
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionRepository")
 * @JMS\ExclusionPolicy("all")
 */
class Question
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Text", type="string", length=255)
     * @Assert\NotBlank()
     * @JMS\Expose
     */
    private $text;

    /**
     * @var int
     *
     * @ORM\Column(name="Type", type="integer")
     * @Assert\NotBlank()
     * @JMS\Expose
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="Level", type="integer")
     * @Assert\NotBlank()
     * @JMS\Expose
     */
    private $level;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Theme", inversedBy="questions")
     * @ORM\JoinColumn(name="theme_id", referencedColumnName="id")
     *
     */
    private $theme;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question", cascade={"persist", "remove"})
     * @JMS\Expose
     */
    private $answers;

    /**
     * Many Users have Many Users.
     * @ORM\ManyToMany(targetEntity="Question", mappedBy="myEquivalent")
     */
    private $equivalentWithMe;

    /**
     * Many Users have many Users.
     * @ORM\ManyToMany(targetEntity="Question", inversedBy="equivalentWithMe")
     * @ORM\JoinTable(name="equivalentQuestion",
     *      joinColumns={@ORM\JoinColumn(name="question_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="equivalent_question_id", referencedColumnName="id")}
     *      )
     * @JMS\Expose
     */
    private $myEquivalent;

    public function __construct() {
        $this->answers = new ArrayCollection();
        $this->friendsWithMe = new ArrayCollection();
        $this->myFriends = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Question
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Question
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return Question
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return mixed
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param mixed $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    /**
     * @return mixed
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param mixed $answers
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }

    /**
     * @return mixed
     */
    public function getEquivalentWithMe()
    {
        return $this->equivalentWithMe;
    }

    /**
     * @param mixed $equivalentWithMe
     */
    public function setEquivalentWithMe($equivalentWithMe)
    {
        $this->equivalentWithMe = $equivalentWithMe;
    }

    /**
     * @return mixed
     */
    public function getMyEquivalent()
    {
        return $this->myEquivalent;
    }

    /**
     * @param mixed $myEquivalent
     */
    public function setMyEquivalent($myEquivalent)
    {
        $this->myEquivalent = $myEquivalent;
    }

    function __toString()
    {
        return $this->text;
    }

    public function addAnswer(Answer $answer){
        $answer->setQuestion($this);
        $this->answers->add($answer);
    }

    public  function removeAnswer(Answer $answer){
        $this->answers->remove($answer);
    }

}

