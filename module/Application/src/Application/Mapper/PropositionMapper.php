<?php

namespace Application\Mapper;

use Application\Entity\Proposition;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Description of EnqueteMapper
 *
 */
class PropositionMapper
{

    private $gateway;

    public function __construct(AdapterInterface $adapter)
    {
        $this->gateway = new TableGateway('proposition', $adapter);
    }

    /**
     * récupère une question par son id
     * 
     *  @return Proposition
     */
    public function getById($id)
    {
    }
            
    /**
     * récpère la liste de propositions pour une question
     *  
     * @return Proposition[] Liste des propositions
     */
    public function getAllByIdQuestion($idQuestion)
    {
        $idQuestion = (int) $idQuestion;
        $select = new Select();
        $select->from($this->gateway->getTable())
                ->where(array('id_question' => $idQuestion))
                ->order(array('id ASC'));
        $resultset = $this->gateway->selectWith($select);
        
        //si aucune enquête
        if (!$resultset) {
            return false; //renvoi faux pour pouvoir tester le retour dans le controlleur
        }

        //fetch each row into an object Enquete...
        foreach ($resultset as $row) {
            $proposition = new Proposition();

            $hydrator = new ClassMethods();
            $hydrator->hydrate((array) $row, $proposition);

            $listePropositions[] = $proposition;
        }
        
        return $listePropositions;

    }
    
    /**
     * création d'une proposition
     *
     * @param Proposition
     *  @return bool
     */
    public function add(Proposition $proposition)
    {
    }
            
    
    /**
     * modification d'une proposition
     *
     * @param Proposition
     *  @return bool
     */
    public function edit(Proposition $proposition)
    {
    }
            
    
    /**
     * suppression d'une proposition
     *
     * @param int
     *  @return bool
     */
    public function delete($id)
    {
    }
            

}