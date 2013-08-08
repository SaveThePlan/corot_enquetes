<?php

namespace Application\InputFilter;

use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Regex;

class EnqueteInputFilter extends InputFilter
{
    public function __construct()
    {
        $input = new Input("titre");
        $input->isRequired();
        
        $this->add($input);
        
        $input = new Input("auteur");
        $input->isRequired();
        
        $this->add($input);
        
        $input = new Input("annee");
        $input->allowEmpty();
        
        $validator = new Regex('/[0-9]{4}/');
//        $validator = new Date();
//        $validator->setFormat('YYYY');
        $input->getValidatorChain()->addValidator($validator);
       
        $this->add($input);
    }
}
