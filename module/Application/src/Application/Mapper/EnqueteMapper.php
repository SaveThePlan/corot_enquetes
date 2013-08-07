<?php

namespace Application\Mapper;

use Application\Entity\Enquete;
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
     *  @return \Application\Entity\Enquete[] Liste des enquetes
     */
    public function getAllByIdUser($idUser)
    {
        $idUser = (int) $idUser;
        $resultSet = $this->gateway->select(array('user_id' => $idUser));
        if (!$resulset) {
            throw new \Exception("Could not find resulset for $idUser");
        }

        foreach ($resultSet as $row) {
            $enquete = new Enquete();

            $hydrator = new ClassMethods();
            $hydrator->hydrate((array) $row, $enquete);

            $listeEnquetes[] = $enquete;
        }

        return $listeEnquetes;
    }

}