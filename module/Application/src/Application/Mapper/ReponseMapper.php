<?php

namespace Application\Mapper;

use Application\Entity\Question;
use Application\Entity\Reponse;
use Application\Entity\Resultat;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

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
     * compte le nombre de répondants à une enquête
     *  
     * @return int
     * 
     */
    public function countRepondantsByIdEnquete($idEnquete)
    {
        $idEnquete = (int)$idEnquete;
                
        $select = new Select();
        $select->columns(array('nb' => new Expression('COUNT(uid_repondant)')), false)
                ->from($this->gateway->getTable())
                ->join('question', 'id_question = question.id', array())
                ->where(array('id_enquete' => $idEnquete));
        $resultset = $this->gateway->selectWith($select);
        
        
        if(!$resultset || $resultset->count() > 1) { // on renvoit false si aucun resultat ou plusieurs résultats
            return 0;
        }
        
        foreach ($resultset as $row) {
            $nb = $row['nb'];
        }
        
        return $nb;
    }
    
    /**
     * création d'une Reponse
     *
     * @param Reponse
     *  @return bool
     */
    public function add(Reponse $reponse)
    {
        $hydrator = new ClassMethods();
        $set = $hydrator->extract($reponse);
        
        return $this->gateway->insert($set);
        
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