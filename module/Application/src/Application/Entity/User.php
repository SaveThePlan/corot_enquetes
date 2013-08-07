<?php

namespace Application\Entity;

/**
 * Description of User
 *
 */
class User {

    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $mdp;
    private $listeEnquetes = array();

    public function __construct($nom = "", $prenom = "", $email = "", $mdp = "") {
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setEmail($email);
        $this->setMdp($mdp);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = (int) $id;
        return $this;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = (string) $nom;
        return $this;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = (string) $prenom;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = (string) $email;
        return $this;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function setMdp($mdp) {
        $this->mdp = (string) $mdp;
        return $this;
    }

    public function getListeEnquetes() {
        return $this->listeEnquetes;
    }

    public function addListeEnquetes(Enquete $enquete) {
        $this->listeEnquetes[] = $enquete;
        return $this;
    }

}
