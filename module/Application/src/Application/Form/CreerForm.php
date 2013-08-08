<?php

namespace Application\Form;

use Application\Entity\Question;
use Application\Mapper\PropositionMapper;
use Zend\Db\Adapter\Adapter;
use Zend\Form\Element\Number;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class CreerForm extends Form {

    /**
     * $listeQuestions est un tableau d'objets Question
     * 
     * @param array $listeQuestions
     */
    public function __construct() {
        parent::__construct("creer");

        $element = new Text('titre');
        $element->setLabel('Titre de l\'enquête');
        $this->add($element);
<<<<<<< HEAD
        
        $element = new \Zend\Form\Element\Textarea('description');
        $element->setLabel('Description');
        $this->add($element);
        
        
=======

        $element = new \Zend\Form\Element\Textarea('description');
        $element->setLabel('Description');
        $this->add($element);


>>>>>>> 89bbd42724997f2e0a8d74ef23e5fc9eb2c1611e
        // module pour les questions
        $element = new Text('question');
        $element->setLabel('Question');
        $this->add($element);
<<<<<<< HEAD
        
        $element = new \Zend\Form\Element\Radio('type');
        $element->setLabel('type');
=======

        $element = new \Zend\Form\Element\Radio('type');
        $element->setLabel('Type de réponse attendue');
>>>>>>> 89bbd42724997f2e0a8d74ef23e5fc9eb2c1611e
        $element->setValueOptions(array(
            'text' => 'champ texte',
            'nb' => 'champ numérique',
            'qcm' => 'choix multiples'
        ));
        $this->add($element);
<<<<<<< HEAD
        
        $element = new \Zend\Form\Element\Text('proposition');
        $element->setLabel('Proposition');
        $this->add($element);
        
=======

        $element = new \Zend\Form\Element\Text('proposition');
        $element->setLabel('Proposition')->setLabelAttributes(array('class'=>'prop'))
                ->setAttributes(array('class' => 'prop'));
        $this->add($element);

        $validerProp = new \Zend\Form\Element\Button('validprop');
        $validerProp->setValue(0)->setLabel('ajouter')
                ->setAttributes(array('class' => 'prop'));
        $this->add($validerProp);
>>>>>>> 89bbd42724997f2e0a8d74ef23e5fc9eb2c1611e
    }

}

