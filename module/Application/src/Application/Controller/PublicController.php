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
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute('zfcuser');
        }
        $registerForm = $this->getServiceLocator()->get('zfcuser_register_form');
        return new ViewModel(array(
            'registerForm' => $registerForm
        ));
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
