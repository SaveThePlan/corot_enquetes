<?php

namespace Application\InputFilter;

use Zend\InputFilter\Input;
use Application\Entity\Question;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Regex;
use Zend\Db\Adapter\Adapter;
use Application\Mapper\PropositionMapper;

class CreerInputFilter extends InputFilter
{
    /**
     *
     * @var PropositionMapper
     */
    //protected $mapperPropositions;
    
    /**
     * $listeQuestions est un tableau d'objets Question
     * 
     * @param array $listeQuestions
     */
    public function __construct($listeQuestions, Adapter $adapter) {
       // parent::__construct("enquete");
        
       // $this->mapperPropositions = new PropositionMapper($adapter);
        
        
        
        
        foreach ($listeQuestions as $question) /* @var $question Question */
        {
            switch ($question->getType()) {

                case "qcm":
                    $filtre = $this->questionQcm($question);
                    break;

                case "nb":
                    $filtre = $this->questionNb($question);
                    break;

                case "text":
                default:
                    $filtre = $this->questionText($question);
                    break;
            }
            
            $this->add($filtre);
        }
    }
    
    
     private function questionText(Question $question)
    {
         
        $filtre = new Input('question_text_'.$question->getId());
        $filtre->isRequired();
        //$filtre->allowEmpty();
        
        return $filtre;
    }
    
    private function questionNb(Question $question)
    {
        $filtre = new Input('question_nb_'.$question->getId());
        $filtre->isRequired();
        /*
        $validator = new Regex('/[0-9]{4}/');

        $input->getValidatorChain()->addValidator($validator);
        */
        return $filtre;
    }
    
    
    private function questionQcm(Question $question)
    {
        $filtre = new Input('question_qcm_'.$question->getId());
        $filtre->isRequired();
        return $filtre;
    }
    
}
