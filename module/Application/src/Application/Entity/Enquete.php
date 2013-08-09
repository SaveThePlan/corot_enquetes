<?php

namespace Application\Entity;

/*
 * Class Entity Enquete
 */

/**
 * Description of Enquete
 *
 */
class Enquete {
    

    /**
     *
     * @var int
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $titre;

    /**
     *
     * @var string
     */
    protected $description;
    
    /**
     *
     * @var int
     */
    protected $nbReponses;


    private $listeQuestions = array();

    private $listeResultats = array();
    
    function __construct($id = 0, $titre = "", $description ="") {
        $this->setId($id);
        $this->setTitre($titre);
        $this->setDescription($description);
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = (int)$id;
        return $this;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = (string)$titre;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = (string)$description;
        return $this;
    }

    public function getListeQuestions() {
        return $this->listeQuestions;
    }

    public function addListeQuestions(Question $question) {
        $this->listeQuestions[] = $question;
        return $this;
    }

    /**
     * 
     * @param array(Question) $listeQuestions
     * @return \Application\Entity\Enquete
     */
    public function setListeQuestions($listeQuestions) { // ce setter est un peu exceptionnel, il permet un ajout direct du tableau complet
        $this->listeQuestions = $listeQuestions;
        return $this;
    }

    
    public function getNbReponses() {
        return $this->nbReponses;
    }

    public function setNbReponses($nbReponses) {
        $this->nbReponses = (int)$nbReponses;
        return $this;
    }
    
    public function getListeResultats() {
        return $this->listeResultats;
    }

    public function addListeResultats(Resultat $resultat) {
        $this->listeResultats[] = $resultat;
        return $this;
    }
    
    public function setListeResultats($listeResultats) {
        $this->listeResultats = $listeResultats;
        return $this;
    }







}

