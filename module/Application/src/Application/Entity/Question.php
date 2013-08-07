<?php

namespace Application\Entity;

class Question
{

    protected 
            $id;
    protected 
            $libelle;
    protected 
            $type;
    private
            $listChoix = array();

    function __construct($id=0, $libelle="", $type="")
    {
        $this->id = (int) $id;
        $this->libelle = (string) $libelle;
        $this->type = (string) $type;
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
        $this->libelle = (string) $libelle;
        return $this;
    }

    public
            function getType()
    {
        return $this->type;
    }

    public
            function setType($type)
    {
        $this->type = (string) $type;
        return $this;
    }

    public
            function getListChoix()
    {
        return $this->listChoix;
    }

    public
            function addListChoix(Proposition $choix)
    {
        $this->listChoix[] = $choix;
        return $this;
    }

}

?>
