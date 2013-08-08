<?php

namespace Application\Controller;

use Application\Mapper\EnqueteMapper;
use Application\Mapper\QuestionMapper;
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
        
        $idEnquete = (int)$this->params('id');
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $mapper = new EnqueteMapper($adapter);
        
        $enquete = $mapper->getById($idEnquete);
        
        if(!$enquete) {
            $this->flashMessenger()->addErrorMessage("L'enquête demandée est inaccessible !");
            return $this->redirect()->toRoute('listeEnquetes');
        }
        
        //enquete ok : récupération de la liste des questions
        $mapperQuestion = new QuestionMapper($adapter);
        $listeQuestions = $mapperQuestion->getAllByIdEnquete($idEnquete);
        
        if($listeQuestions) {
            $enquete->setListeQuestions($listeQuestions);
        }
        
        
        $formEnquete = new \Application\Form\EnqueteForm($enquete->getListeQuestions(), $adapter);
                
        return new ViewModel(
                array(
                'enquete' => $enquete,
                'formEnquete' => $formEnquete
                )
        );
        
        return new ViewModel(
                array(
                //'enquetes' => $enquetes 
                )
        );
    }

}
