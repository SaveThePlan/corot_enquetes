<?php

namespace Application\Entity;

class Proposition
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
    protected $libelle;
    
    /**
     *
     * @var Question
     */
    private $question;

    function __construct($id = 0, $libelle = "", Question $question = null)
    {
        $this->setId($id);
        $this->setLibelle($libelle);
        $this->question = $question;
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

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = (string)$libelle;
        return $this;
    }

    /**
     * 
     * @return Question
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

}

