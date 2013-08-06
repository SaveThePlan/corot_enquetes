<?php

namespace Application\Entity;

/*
 * Class Entity Enquete
 */

/**
 * Description of Enquete
 *
 * @author stagiaire
 */
class Enquete {
    
    protected $id;
    protected $titre;
    protected $description;
    
    /**
     *
     * @var Question
     */
    private $listeQuestions = array();
    
    function __construct($id = 0, $titre = "", $description ="") {
        $this->setId($id);
        $this->setTitre($titre);
        $this->setDescription($description);
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function getListeQuestions() {
        return $this->listeQuestions;
    }

    public function addListeQuestions(Question $question) {
        $this->listeQuestions[] = $question;
        return $this;
    }



}

?>
