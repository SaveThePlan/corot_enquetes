<?php

namespace Application\Mapper;

use Application\Entity\Question;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

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
        
        $idEnquete = (int)$idEnquete;
        
        $resultset = $this->gateway->select(array('id_enquete' => $idEnquete));
        
        if(!$resultset) {
            return FALSE;
        }
        
        $listeQuestions = array();
        
        foreach ($resultset as $row) {
            $question = new Question();
            
            $hydrator = new ClassMethods();
            $hydrator->hydrate((array)$row, $question);
            
            $listeQuestions[] = $question;
        }
        
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