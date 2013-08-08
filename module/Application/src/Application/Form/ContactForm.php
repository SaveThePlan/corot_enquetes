<?php

namespace Application\Form;

use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class ContactForm extends Form {
    
    public function __construct() {
        parent::__construct("contact");
        
        
        // get villes
        $gateway = new \Application\Gateway\VilleGateway();
        $listVilles = $gateway->getAll("cp");
        
        $arrayCP = array();
        foreach ($listVilles as $v) { /* @var $v \Application\Entity\Ville */
            $arrayCP[$v->getCp()] = $v->getCp().' '.$v->getNom_ville();
        }
        //fin get villes
                
//        $this->add(array(
//            "name" => "prenom",
//            "type" => "text",
//            "options" => array(
//                "label" => "Prénom"
//            )
//        ));
        
        $element = new Text('prenom');
        $element->setLabel("Prénom")
                ->setAttribute('id', "prenom");
        $this->add($element);
        
        $element = new Text('nom');
        $element->setLabel("Nom")
                ->setAttribute('id', "nom");
        $this->add($element);
        
        $element = new Text('telephone');
        $element->setLabel("Téléphone")
                ->setAttributes(array(
                    "type" => "tel",
                    "id" => "telephone")
                );
        $this->add($element);
        
        $select = new Select("cp");
        $select->setLabel("Code postal");
        $select->setValueOptions($arrayCP);
        $this->add($select);
        
        
//        $submit = new \Zend\Form\Element\Submit('submit');
//        $submit->setValue('Valider');
//        $this->add($submit);
        
    }
}

