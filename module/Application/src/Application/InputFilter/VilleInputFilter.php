<?php

namespace Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\Uri;

class VilleInputFilter extends InputFilter {
    
    function __construct() 
    {
        /*
         * cp
         * Validator
         * - obligatoire
         * - 5 char
         * Filter
         * - suppr espace avant et après
         * - stripTags (XSS)
         */
        $input = new Input("cp");
        
        $validator = new NotEmpty();
        $validator->setMessage("le code postal est obligatoire", NotEmpty::IS_EMPTY);
        $input->getValidatorChain()->addValidator($validator);
        
        $validator = new StringLength();
        $validator->setMax(5)
                ->setMessage("Le code postal doit faire %max% caractères", StringLength::TOO_LONG)
                ->setMin(5)
                ->setMessage("Le code postal doit faire %min% caractères", StringLength::TOO_SHORT)
                ;
        $input->getValidatorChain()->addValidator($validator);
        
        $filter = new StripTags();
        $input->getFilterChain()->attach($filter);
        
        $filter = new StringTrim();
        $input->getFilterChain()->attach($filter);
        
        $this->add($input);
        
        /*
         * nom_ville
         * Validator
         * - obligatoire
         * - min 5 char
         * - max 50 char
         * Filter
         * - suppr espace avant et après
         * - stripTags (XSS)
         */
        $input = new Input("cp");
        
        $validator = new NotEmpty();
        $validator->setMessage("le nom de la ville est obligatoire", NotEmpty::IS_EMPTY);
        $input->getValidatorChain()->addValidator($validator);
        
        $validator = new StringLength();
        $validator->setMax(50)
                ->setMessage("Le nom de la ville doit faire %max% caractères maximum", StringLength::TOO_LONG)
                ->setMin(2)
                ->setMessage("Le nom de la ville doit faire %min% caractères minimum", StringLength::TOO_SHORT)
                ;
        $input->getValidatorChain()->addValidator($validator);
        
        $filter = new StripTags();
        $input->getFilterChain()->attach($filter);
        
        $filter = new StringTrim();
        $input->getFilterChain()->attach($filter);
        
        $this->add($input);
        
        /*
         * nom_ville
         * Validator
         * - obligatoire
         * - min 5 char
         * - max 50 char
         * Filter
         * - suppr espace avant et après
         * - stripTags (XSS)
         */
        $input = new Input("site");
        
        $validator = new Uri();
        $validator->setMessage("cet adresse ne semble pas valide", Uri::INVALID);
        $input->getValidatorChain()->addValidator($validator);
        
        $filter = new StripTags();
        $input->getFilterChain()->attach($filter);
        
        $filter = new StringTrim();
        $input->getFilterChain()->attach($filter);
        
        $this->add($input);
        
    }
        

}
