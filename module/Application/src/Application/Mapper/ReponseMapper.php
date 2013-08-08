<?php

namespace Application\Mapper;

use Application\Entity\Question;
use Application\Entity\Reponse;
use Application\Entity\Resultat;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;

/**
 * Description of EnqueteMapper
 *
 */
class ReponseMapper
{

    private $gateway;

    public function __construct(AdapterInterface $adapter)
    {
        $this->gateway = new TableGateway('reponse', $adapter);
    }

    /**
     * récupère une reponse par son id
     * 
     *  @return Reponse
     */
    public function getById($id)
    {
        return $reponse;
        
    }
            
    /**
     * récpère la liste de reponses pour une question
     *  
     * @return Reponse[] Liste des reponses
     */
    public function getAllByIdQuestion($idQuestion)
    {
        return $listeReponse;
    }
    
    /**
     * création d'une Reponse
     *
     * @param Reponse
     *  @return bool
     */
    public function add(Reponse $reponse)
    {
    }
            
    
    /**
     * suppression d'une reponse
     *
     * @param int
     *  @return bool
     */
    public function delete($id)
    {
    }
            
    
    /**
     * suppression des reponses à une question
     *
     * @param int
     *  @return bool
     */
    public function deleteAllByQuestion($idQuestion)
    {
    }
    
    /**
     * 
     * @param Question $question
     * @return Resultat
     */
    public function resultatByQuestion(Question $question)
    {
    }
    
    /**
     * 
     * @param int $idQuestion
     * @return array
     */
    protected function resultatText($idQuestion)
    {
    }
            
    
    /**
     * 
     * @param int $idQuestion
     * @return array
     */
    protected function resultatNb($idQuestion)
    {
    }
            
    
    /**
     * 
     * @param int $idQuestion
     * @return array
     */
    protected function resultatQcm($idQuestion)
    {
    }
            

}