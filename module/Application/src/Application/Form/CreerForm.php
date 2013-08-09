<?php

namespace Application\Form;

use Zend\Form\Element\Button;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
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

        $element = new Textarea('description');
        $element->setLabel('Description');
        $this->add($element);

        // module pour les questions
        $element = new Text('question');
        $element->setLabel('Question');
        $this->add($element);

        $element = new Radio('type');
        $element->setLabel('Type de réponse attendue')
                ->setValueOptions(array(
                    'text' => 'champ texte',
                    'nb' => 'champ numérique',
                    'qcm' => 'choix multiples'
                ))
                ->setValue('text');
        $this->add($element);

        $validerProp = new Button('ajoutprop');
        $validerProp->setLabel('ajouter une proposition')
                ->setAttributes(array('class' => 'prop'));
        $this->add($validerProp);

        $element = new Text('proposition[]');
        $element->setLabel('Propositions')->setLabelAttributes(array('class' => 'prop'))
                ->setAttributes(array('class' => 'prop'));
        $this->add($element);

        $suppQuest = new Button('suppquest');
        $suppQuest->setLabel('Supprimer la question');
        $this->add($suppQuest);

        $ajoutQuest = new Button('ajoutquest');
        $ajoutQuest->setLabel('ajouter une question')
                ->setAttributes(array('id' => 'ajoutquest'));
        $this->add($ajoutQuest);
    }

}

