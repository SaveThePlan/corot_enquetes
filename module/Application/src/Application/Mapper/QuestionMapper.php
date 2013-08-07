<?php

namespace Application\Mapper;

use Application\Entity\Question;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;

/**
 * Description of EnqueteMapper
 *
 * @author Jimmy
 */
class QuestionMapper
{

    private $gateway;

    public function __construct(AdapterInterface $adapter)
    {
        $this->gateway = new TableGateway('question', $adapter);
    }

    /**
     * récupère une question par son id
     * 
     *  @return Question
     */
    public function getById($id)
    {
        return $question;
    }
            
    /**
     * récpère la liste de questions pour une enquête
     *  
     * @return Question[] Liste des questions
     */
    public function getAllByIdEnquete($idEnquete)
    {
        return $listeQuestions;
    }
    
    /**
     * création d'une question
     *
     * @param Question 
     *  @return bool
     */
    public function add(Question $question)
    {
    }
            
    
    /**
     * modification d'une question
     *
     * @param Question
     *  @return bool
     */
    public function edit(Question $question)
    {
    }
            
    
    /**
     * suppression d'une question
     *
     * @param int
     *  @return bool
     */
    public function delete($id)
    {
    }
            

}