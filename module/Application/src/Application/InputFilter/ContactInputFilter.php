<?php

namespace Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class ContactInputFilter extends InputFilter {
    
    function __construct() 
    {
        /*
         * prénom
         * Validator
         * - obligatoire
         * - max 50 char
         * Filter
         * - suppr espace avant et après
         * - stripTags (XSS)
         */
        $input = new Input("prenom");
//        $input->isRequired();
        
        $validator = new NotEmpty();
        $validator->setMessage("prénom obligatoire", NotEmpty::IS_EMPTY);
        $input->getValidatorChain()->addValidator($validator);
        
        $validator = new StringLength();
        $validator->setMax(50)
                ->setMessage("Le prénom est trop long (max %max% car.)", StringLength::TOO_LONG)
                ->setMin(3)
                ->setMessage("Le prénom est trop court (min %min% car.)", StringLength::TOO_SHORT)
                ;
        $input->getValidatorChain()->addValidator($validator);
        
        $filter = new StripTags();
        $input->getFilterChain()->attach($filter);
        
        $filter = new StringTrim();
        $input->getFilterChain()->attach($filter);
        
        $this->add($input);
        
        /*
         * nom
         * - obligatoire
         * - max 50 char
         */
        $input = new Input("nom");
        $input->isRequired();
        
        $validator = new StringLength();
        $validator->setMax(50)->setMin(3);
        $input->getValidatorChain()->addValidator($validator);
        
        $filter = new StripTags();
        $input->getFilterChain()->attach($filter);
        
        $filter = new StringTrim();
        $input->getFilterChain()->attach($filter);
        
        $this->add($input);
        
        /*
         * telephone
         * - optionnel
         * - max 14 char
         * - regex ?
         */
        $input = new Input("telephone");
//        $input->isRequired();
        
        $validator = new StringLength();
        $validator->setMax(14);
        $input->getValidatorChain()->addValidator($validator);
        
        $filter = new StripTags();
        $input->getFilterChain()->attach($filter);
        
        $filter = new StringTrim();
        $input->getFilterChain()->attach($filter);
        
        $this->add($input);
    }

}
