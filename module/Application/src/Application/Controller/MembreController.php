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

use Zend\View\Model\ViewModel;

class MembreController extends \ZfcUser\Controller\UserController
{

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

}