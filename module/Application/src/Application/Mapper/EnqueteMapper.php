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
class EnqueteMapper {

    private $gateway;

    public function __construct(AdapterInterface $adapter) {
        $this->gateway = new TableGateway('enquete', $adapter);
    }

    /**
     * récupère une enquête par son id
     * 
     *  @return Enquete
     */
    public function getById($id) {
        $id = (int) $id;

//        $resultset = $this->gateway->select(array('id' => $id));

        $select = new \Zend\Db\Sql\Select();
        $select->from($this->gateway->getTable())
                ->where(array('id' => $id));

        $resultset = $this->gateway->selectWith($select);


        if (!$resultset || $resultset->count() > 1) { // on renvoit false si aucun resultat ou plusieurs résultats
            return FALSE;
        }

        //Une seule ligne dans resultset = OK
        $enquete = new Enquete();
        $hydrator = new ClassMethods();

        $hydrator->hydrate($resultset->toArray()[0], $enquete);

        return $enquete;
    }

    /**
     * récpère la liste d'enquetes pour un membre
     *  
     * @return Enquete[] Liste des enquetes
     */
    public function getAllByIdUser($idUser) {
        $idUser = (int) $idUser;
        $select = new \Zend\Db\Sql\Select();
        $select->from($this->gateway->getTable())
                ->where(array('id_user' => $idUser))
                ->order(array('id ASC'));
        $resultset = $this->gateway->selectWith($select);

        //si aucune enquête
        if (!$resultset) {
            return false; //renvoi faux pour pouvoir tester le retour dans le controlleur
        }

        //fetch each row into an object Enquete...
        foreach ($resultset as $row) {
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
    public function add(Enquete $enquete) {
        
    }

    /**
     * modification d'une enquête
     *
     * @param Enquete 
     *  @return bool
     */
    public function edit(Enquete $enquete) {
        
    }

    /**
     * suppression d'une enquête
     *
     * @param int
     *  @return bool
     */
    public function delete($id) {
        
    }

    /**
     * 
     * @param \Application\Entity\Enquete $enquete
     * @param \Application\Mapper\ReponseMapper $mapperRep
     * 
     * @return bool
     */
    public function saveResponses(Enquete $enquete, ReponseMapper $mapperReponse) {

        $this->gateway->getAdapter()->getDriver()->getConnection()->beginTransaction();

        try {

            foreach ($enquete->getListeReponses() as $reponse) { /* @var $reponse \Application\Entity\Reponse */
                $transaction = $mapperReponse->add($reponse);
            }
            
        } catch (\PDOException $e) {
            $this->gateway->getAdapter()->getDriver()->getConnection()->rollback();
            return FALSE;
        }
        $this->gateway->getAdapter()->getDriver()->getConnection()->commit();
        return true;
    }

}
