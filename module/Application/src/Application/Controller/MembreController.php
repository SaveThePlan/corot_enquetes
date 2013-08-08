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


use Application\Form\EnqueteForm;
use Application\Mapper\EnqueteMapper;
use Application\Mapper\QuestionMapper;
use Zend\View\Model\ViewModel;
use ZfcUser\Controller\UserController;

class MembreController extends UserController {

    /**
     * index membre = liste enquêtes
     * 
     * @return ViewModel
     */
    public function indexAction() {
        /* authentification user */
        $this->userAuth();

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $mapperEnquete = new EnqueteMapper($adapter);

        /* création de la liste d'enquêtes */
        $enquetes = $mapperEnquete->getAllByIdUser(1); // pour test
//        $enquetes = $mapperEnquete->getAllByIdUser($this->zfcUserAuthentication()->getIdentity()->getId());

        if (!$enquetes) {
            $this->flashMessenger()->addInfoMessage("Vous n'avez pas encore créé d'enquête.");
        }

        return new ViewModel(
                array(
            'enquetes' => $enquetes
                )
        );
    }

    public function creerAction() {
        $formCreation = new \Application\Form\CreerForm();

        return new ViewModel(
                array(
            'formCreation' => $formCreation
                )
        );
    }

    public function modifierAction() {
        return new ViewModel(
                array(
//'enquetes' => $enquetes 
                )
        );
    }

    public function supprimerAction() {
        return new ViewModel(
                array(
//'enquetes' => $enquetes 
                )
        );
    }

    public function apercuAction() {
        $this->userAuth();
// TODO sécurité : comment tester si l'enquête demandée appartient bien à l'utilisateur...
// peut-être en passant par une liste d'enquêtes stckées dans le user ?
//recupère le paramètre get de l'url
        $idEnquete = (int) $this->params('id');
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $mapper = new EnqueteMapper($adapter);

        $enquete = $mapper->getById($idEnquete);

        if (!$enquete) {
            $this->flashMessenger()->addErrorMessage("L'enquête demandée est inaccessible !");
            return $this->redirect()->toRoute('listeEnquetes');
        }

//enquete ok : récupération de la liste des questions
        $mapperQuestion = new QuestionMapper($adapter);
        $listeQuestions = $mapperQuestion->getAllByIdEnquete($idEnquete);

        $formEnquete = new EnqueteForm($listeQuestions, $adapter);

        return new ViewModel(
                array(
            'enquete' => $enquete,
            'formEnquete' => $formEnquete
                )
        );
    }

    public function consulterAction() {
        return new ViewModel(
                array(
                //'enquetes' => $enquetes 
                )
        );
    }

    public function effacerAction() {
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
    private function userAuth() {
        /* redirection vers page de login si user inconnu... */
        // desactivé pour le moment car pénible de se connecter à chaque fois...
//        if (!$this->zfcUserAuthentication()->hasIdentity()) {
//            return $this->redirect()->toRoute(static::ROUTE_LOGIN);
//        }

        return;
    }

}