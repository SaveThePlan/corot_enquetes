<?php

namespace Application\Entity ;


class Question
{
    private $id;
    
    private $libelle;
    
    private $type;
    
    private $listChoix = array();
    
    
    function __construct($libelle="", $type="") {
        
        $this->setLibelle($libelle);
        $this->setType($type);
      
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function setLibelle($libelle) {
        $this->libelle = (string)$libelle;
        return $this;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = (string)$type;
        return $this;
    }

    public function getListChoix() {
        return $this->listChoix;
    }

    public function addListChoix(Proposition $choix) {
        $this->listChoix[] = $choix;
        return $this;
    }


    
}


?>
