<?php

namespace Application\Entity;



class Question
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
     * @var string
     */
    protected $type; /* attention il s'agit d'une enum en SQL : text, nb, qcm */

    /**
     *
     * @var array
     */
    private $listeChoix = array();


    public function __construct($id=0, $libelle="", $type="")
    {
        $this->setId($id);
        $this->setLibelle($libelle);
        $this->setType($type);
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
        $this->libelle = (string) $libelle;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = (string) $type;
        return $this;
    }

    public function getListeChoix()
    {
        return $this->listeChoix;
    }

    public function addListeChoix(Proposition $choix)
    {
        $this->listeChoix[] = $choix;
        return $this;
    }
    

}