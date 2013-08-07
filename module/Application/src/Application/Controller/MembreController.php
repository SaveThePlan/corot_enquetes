<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author stagiaire
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MembreController extends \ZfcUser\Controller\UserController
{

    /**
     * index membre = liste enquêtes
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute(static::ROUTE_LOGIN);
        }
        //$tableGateway = $this->getServiceLocator()->get('AlbumTableGateway');
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $mapperEnquete = new EnqueteMapper($adapter);

        $enquetes = $mapperEnquete->getAllByUser($this->zfcUserAuthentication()->getIdentity()->getId());

        return new ViewModel(
                array(
                //'enquetes' => $enquetes 
                )
        );
    }
    
    public function creerAction()
    {
        return new ViewModel(
                array(
                //'enquetes' => $enquetes 
                )
        );
    }

    
    public function modifierAction()
    {
        return new ViewModel(
                array(
                //'enquetes' => $enquetes 
                )
        );
    }

    
    public function supprimerAction()
    {
        return new ViewModel(
                array(
                //'enquetes' => $enquetes 
                )
        );
    }

    
    public function apercuAction()
    {
        return new ViewModel(
                array(
                //'enquetes' => $enquetes 
                )
        );
    }

    
    public function consulterAction()
    {
        return new ViewModel(
                array(
                //'enquetes' => $enquetes 
                )
        );
    }

}
