<?php

namespace Application\FormUtils;

use Application\Entity\Question;
use Application\FormUtils\EnqueteFormInterface;
use Zend\Form\Form;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractEnqueteForm
 *
 * @author USER
 */
abstract class AbstractEnqueteForm 
    extends Form 
    implements EnqueteFormInterface 
{

    public function dispatcher(Question $question) {

        $method = 'question' . ucfirst($question->getType());
        if (is_callable(array($this, $method))) {
            return $this->$method($question);
        }
        
        return false; //if method not callable
        
    }

}

?>
