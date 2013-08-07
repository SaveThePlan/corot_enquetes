<?php

namespace Application\Entity;

class Proposition
{

    protected
            $id;
    protected
            $libelle;
    /**
     *
     * @var Question
     */
    private
            $question;

    function __construct($id = 0, $libelle = "", Question $question = null)
    {
        $this->id = (int) $id;
        $this->libelle = (string) $libelle;
        $this->question = $question;
    }

    public
            function getId()
    {
        return $this->id;
    }

    public
            function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public
            function getLibelle()
    {
        return $this->libelle;
    }

    public
            function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }

    public
            function getQuestion()
    {
        return $this->question;
    }

    public
            function setQuestion(Question $question)
    {
        $this->question = $question;
        return $this;
    }

}

?>
