<?php

namespace Application\Entity;
 
class Resultat {
    
    protected $resultat = array();
    
    
    public function __construct() {
    }
    
    public function getResultat() {
        return $this->resultat;
    }

    public function setResultat(Array $resultat) {
        $this->resultat = $resultat;
        return $this;
    }


   
}

