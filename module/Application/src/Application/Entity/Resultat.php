<?php

namespace Application\Entity;
 
class Resultat {
    
    protected $min;
    protected $max;
    protected $avg;
    protected $sum;
    
    private $listeReponses = array();
    
    function __construct($min="", $max="", $avg="", $sum="", $listeReponses="") {
        $this->min = $min;
        $this->max = $max;
        $this->avg = $avg;
        $this->sum = $sum;
        $this->listeReponses = $listeReponses;
    }
    
    
    public function getMin() {
        return $this->min;
    }

    public function setMin($min) {
        $this->min = (int)$min;
        return $this;
    }

    public function getMax() {
        return $this->max;
    }

    public function setMax($max) {
        $this->max = (int)$max;
        return $this;
    }

    public function getAvg() {
        return $this->avg;
    }

    public function setAvg($avg) {
        $this->avg = (int)$avg;
        return $this;
    }

    public function getSum() {
        return $this->sum;
    }

    public function setSum($sum) {
        $this->sum = (int)$sum;
        return $this;
    }

    public function getListeReponses() {
        return $this->listeReponses;
    }

    public function addListeReponses(Reponse $reponse) {
        $this->listeReponses[] = $reponse;
        return $this;
    }



    
    
    
    
    
    
   
}

