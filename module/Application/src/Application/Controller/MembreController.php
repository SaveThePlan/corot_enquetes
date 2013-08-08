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

//use Zend\Mvc\Controller\AbstractActionController;


use Application\Mapper\EnqueteMapper;
use Zend\View\Model\ViewModel;
use ZfcUser\Controller\UserController;

class MembreController extends UserController
{

    /**
     * index membre = liste enquêtes
     * 
     * @return ViewModel
     */
    public function indexAction()
    {
        /* test authentification user */
        $this->userAuth();

        
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $mapperEnquete = new EnqueteMapper($adapter);

        /* création de la liste d'enquêtes */
        $enquetes = $mapperEnquete->getAllByIdUser(1); // pour test
//        $enquetes = $mapperEnquete->getAllByIdUser($this->zfcUserAuthentication()->getIdentity()->getId());

        return new ViewModel(
                array(
                'enquetes' => $enquetes 
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
    
    public function effacerAction()
    {
        return new ViewModel(
                array(
                //'enquetes' => $enquetes 
                )
        );
    }

    /**
     * check user authentification.
     * redirect on 'login page' if fail, othewise don't do anything 
     * 
     * @return void
     */
    private function userAuth()
    {
        /* redirection vers page de login si user inconnu... */
        // desactivé pour le moment car pénible de se connecter à chaque fois...
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute(static::ROUTE_LOGIN);
        }
    }
    
    
}