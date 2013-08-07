<?php

namespace Application\Mapper;

use Application\Entity\Proposition;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;

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
        return $proposition;
    }
            
    /**
     * récpère la liste de propositions pour une question
     *  
     * @return Proposition[] Liste des propositions
     */
    public function getAllByIdQuestion($idQuestion)
    {
        return $listeProposition;
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