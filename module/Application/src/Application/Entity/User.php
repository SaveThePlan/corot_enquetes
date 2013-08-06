<?php
namespace Application\Entity;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author corot
 */
class User {
    protected $id;
    /**
     * 
     * @var string
     */
    
    protected $nom;
    /**
     * 
     * @var string
     */
    
    protected $prenom;
    /**
     * 
     * @var string
     */
    
    protected $email;
    /**
     * 
     * @var string
     */
    
    protected $mdp;
    /**
     * 
     * @var array
     */
    
    private $listeEnquetes=array();
   
    function __construct($nom, $prenom, $email, $mdp) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
        
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
            $this->nom = (string)$nom;
            return $this;
        }

        public function getPrenom() {
            return $this->prenom;
        }

        public function setPrenom($prenom) {
            $this->prenom = (string)$prenom;
            return $this;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = (string)$email;
            return $this;
        }

        public function getMdp() {
            return $this->mdp;
        }

        public function setMdp($mdp) {
            $this->mdp = (string)$mdp;
            return $this;
        }

        public function getListeEnquetes() {
            return $this->listeEnquetes;
        }

        public function setListeEnquetes($listeEnquetes) {
            $this->listeEnquetes = (array) $listeEnquetes;
            return $this;
        }


}
