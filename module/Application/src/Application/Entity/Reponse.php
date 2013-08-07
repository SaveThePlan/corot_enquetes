<?php

namespace Application\Entity;

/**
 * Description of Reponse
 *
 * @author Jimmy
 */
class Reponse
{

    /**
     *
     * @var int
     */
    protected $id;

    /**
     *
     * @var string 
     */
    protected $uidRepondant;

    /**
     *
     * @var string 
     */
    protected $contenu;

    /**
     *
     * @var Question
     */
    private $question;

    /**
     *
     * @var Proposition
     */
    private $choix;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int)$id;
        return $this;
    }

    public function getUidRepondant()
    {
        return $this->uidRepondant;
    }

    public function setUidRepondant($uidRepondant)
    {
        $this->uidRepondant = (string) $uidRepondant;
        return $this;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = (string) $contenu;
        return $this;
    }

    /**
     * 
     * @return \Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion(Question $question)
    {
        $this->question = $question;
        return $this;
    }

    /**
     * 
     * @return \Entity\Proposition
     */
    public function getChoix()
    {
        return $this->choix;
    }

    public function setChoix(Proposition $choix)
    {
        $this->choix = $choix;
        return $this;
    }
    
    function __construct($id=0, $uidRepondant="", $contenu="", Question $question = NULL, Proposition $choix = NULL) {
        $this->setId($id);
        $this->setUidRepondant($uidRepondant);
        $this->setContenu($contenu);
        $this->question = $question;
        $this->choix = $choix;
    }


}