<?php

namespace Application\Entity;

/**
 * Description of Reponse
 *
 * @author Jimmy
 */
class Reponse
{

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
        $this->id = $id;
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

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion(Question $question)
    {
        $this->question = $question;
        return $this;
    }

    public function getChoix()
    {
        return $this->choix;
    }

    public function setChoix(Proposition $choix)
    {
        $this->choix = $choix;
        return $this;
    }

}