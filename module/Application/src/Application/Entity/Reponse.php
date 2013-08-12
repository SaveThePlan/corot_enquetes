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
    

    
    // Suppresion des prop questions et choix
    /**
     *
     * @var Question
     */
    private $question;

    /**
     *
     * @var Proposition
     */
    private $proposition;
    
    
    
    function __construct($id=0, $uidRepondant="", $contenu="", Question $question = NULL, Proposition $proposition = NULL) {
        $this->setId($id);
        $this->setUidRepondant($uidRepondant);
        $this->setContenu($contenu);
        $this->question = $question;
        $this->proposition = $proposition;
    }

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
    public function getProposition()
    {
        return $this->proposition;
    }

    public function setProposition(Proposition $proposition)
    {
        $this->proposition = $proposition;
        return $this;
    }



}