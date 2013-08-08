<?php

namespace Application\Form;

use Zend\Form\Element\Text;
use Zend\Form\Form;

class VilleForm extends Form {
    
    public function __construct() {
        parent::__construct("contact");
        
        $element = new Text('cp');
        $element->setLabel("Code postal")
                ->setAttribute('id', "cp");
        $this->add($element);
        
        $element = new Text('nom_ville');
        $element->setLabel("Nom de la ville")
                ->setAttribute('id', "nom_ville");
        $this->add($element);
        
        $element = new Text('site');
        $element->setLabel("Site internet")
                ->setAttributes(array(
                    "type" => "url",
                    "id" => "site")
                );
        $this->add($element);
        
        
    }
}

