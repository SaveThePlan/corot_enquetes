<?php

namespace Application\Entity;

/**
 * Description of User
 *
 */
class User implements \ZfcUser\Entity\UserInterface {

    /**
     *
     * @var int
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $firstname;

    /**
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @var string
     */
    protected $password;

    /**
     *
     * @var array
     */
    private $listeEnquetes = array();

    
    public function __construct($id=0, $name="", $firstname="", $email="", $password="") {
        $this->setId($id);
        $this->setName($name);
        $this->setFirstname($firstname);
        $this->setEmail($email);
        $this->setPassword($password);
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = (int)$id;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = (string)$name;
        return $this;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname) {
        $this->firstname = (string)$firstname;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = (string)$email;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = (string)$password;
        return $this;
    }


    public function getListeEnquetes() {
        return $this->listeEnquetes;
    }

    public function addListeEnquetes(Enquete $enquete) {
        $this->listeEnquetes[] = $enquete;
        return $this;
    }
    
    public function getDisplayName() {
        return $this;
    }

    public function getState() {
        return $this;
    }

    public function getUsername() {
        return $this;
    }

    public function setDisplayName($displayName) {
        return $this;
    }

    public function setState($state) {
        return $this;
    }

    public function setUsername($username) {
        return $this;
    }

    

}
