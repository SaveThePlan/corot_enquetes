<?php

namespace Application\Controller;

use Application\Mapper\EnqueteMapper;
use Application\Mapper\QuestionMapper;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PublicController extends AbstractActionController
{

    /**
     *
     * @var Request
     */
    protected $request;

    public function indexAction()
    {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute('zfcuser');
        }
        $registerForm = $this->getServiceLocator()->get('zfcuser_register_form');
        return new ViewModel(array(
            'registerForm' => $registerForm
        ));
    }

    public function repondreAction()
    {
        //todo action répondre à un questionnaire...




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

        if ($listeQuestions) {
            $enquete->setListeQuestions($listeQuestions);
        }


        $formEnquete = new \Application\Form\EnqueteForm($enquete->getListeQuestions(), $adapter);

        
        // PAS FINI TODO
        if ($this->request->isPost()) {
            $donneesSaisies = $this->request->getPost();

            $formEnquete->setData($donneesSaisies);
            $formEnquete->setInputFilter(new \Application\InputFilter\EnqueteInputFilter($enquete->getListeQuestions(), $adapter));

            if ($form->isValid()) {
                
                
                
                
                $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $mapper = new ReponseMapper($adapter);

                $donneesFiltrees = $form->getData();

                $livre = new Livre();

                $hydrator = new ClassMethods();
                $hydrator->hydrate($donneesFiltrees, $livre);

                if ($mapper->add($livre)) {
                    $this->flashMessenger()->addSuccessMessage("Le livre {$livre->getTitre()} a bien été inséré");
                } else {
                    $this->flashMessenger()->addErrorMessage("Une erreur s'est produite pendant l'insertion de {$livre->getTitre()}");
                }

                return $this->redirect()->toRoute('home');
            }
        }




        $element = new \Zend\Form\Element\Submit("valider");
        $element->setValue("Valider")
                ->setAttribute("class", " btn btn-primary");
        $formEnquete->add($element);

        return new ViewModel(
                array(
            'enquete' => $enquete,
            'formEnquete' => $formEnquete
                )
        );
    }

}
