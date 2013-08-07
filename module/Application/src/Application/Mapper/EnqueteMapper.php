<?php

namespace Application\Mapper;

use Application\Entity\Enquete;
use Exception;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Description of EnqueteMapper
 *
 * @author Jimmy
 */
class EnqueteMapper
{

    private $gateway;

    public function __construct(AdapterInterface $adapter)
    {
        $this->gateway = new TableGateway('enquete', $adapter);
    }

    /**
     * récupère une enquête par son id
     * 
     *  @return Enquete
     */
    public function getById($id)
    {
        return $enquete;
    }
            
    /**
     * récpère la liste d'enquetes pour un membre
     *  
     * @return Enquete[] Liste des enquetes
     */
    public function getAllByIdUser($idUser)
    {
        $idUser = (int) $idUser;
        $resultSet = $this->gateway->select(array('user_id' => $idUser));
        if (!$resulset) {
            throw new Exception("Could not find resulset for $idUser");
        }

        foreach ($resultSet as $row) {
            $enquete = new Enquete();

            $hydrator = new ClassMethods();
            $hydrator->hydrate((array) $row, $enquete);

            $listeEnquetes[] = $enquete;
        }

        return $listeEnquetes;
    }
    
    /**
     * création d'une enquête
     *
     * @param Enquete 
     *  @return bool
     */
    public function add(Enquete $enquete)
    {
    }
            
    
    /**
     * modification d'une enquête
     *
     * @param Enquete 
     *  @return bool
     */
    public function edit(Enquete $enquete)
    {
    }
            
    
    /**
     * suppression d'une enquête
     *
     * @param int
     *  @return bool
     */
    public function delete($id)
    {
    }
            

}