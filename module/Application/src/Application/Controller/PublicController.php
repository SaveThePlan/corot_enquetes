<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PublicController extends AbstractActionController {

    /**
     *
     * @var Request
     */
    protected $request;

    public function indexAction() {
        //todo page accueil (inscription et connexion)
        return new ViewModel(
                array(
                //'enquetes' => $enquetes 
                )
        );
    }

    public function repondreAction() {
        //todo action répondre à un questionnaire...
        return new ViewModel(
                array(
                //'enquetes' => $enquetes 
                )
        );
    }

}
