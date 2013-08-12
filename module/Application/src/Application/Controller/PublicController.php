<?php

namespace Application\Controller;

use Application\Entity\Reponse;
use Application\Form\EnqueteForm;
use Application\InputFilter\EnqueteInputFilter;
use Application\Mapper\EnqueteMapper;
use Application\Mapper\QuestionMapper;
use Application\Mapper\ReponseMapper;
use Zend\Form\Element\Submit;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\View\Model\ViewModel;
use Zend\XmlRpc\Request;

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


        $formEnquete = new EnqueteForm($enquete->getListeQuestions(), $adapter);

        if ($this->request->isPost()) {
            $donneesSaisies = $this->request->getPost();

            $formEnquete->setData($donneesSaisies);

            $formEnquete->setInputFilter(new EnqueteInputFilter($enquete->getListeQuestions(), $adapter));

            if ($formEnquete->isValid()) {
                echo 'valid';

                $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $mapper = new ReponseMapper($adapter);

                $donneesFiltrees = $formEnquete->getData();

                // générer un id pour le repondant
                $uiRepondant = uniqid('', false);
                foreach ($donneesFiltrees as $nameQ => $valueQ) {
                    $tabQ = explode('_', $nameQ);
                    $idQ = $tabQ[2];
                    $typeQ = $tabQ[1];

                    // Si QCM
                    if ($typeQ == "qcm") {
                        $enr = array(
                            "uid_repondant" => $uiRepondant,
                            "contenu" => NULL,
                            "id_question" => $idQ,
                            "id_proposition" => $valueQ
                        );
                    } else {
                        $enr = array(
                            "uid_repondant" => $uiRepondant,
                            "contenu" => $valueQ,
                            "id_question" => $idQ,
                            "id_proposition" => NULL
                        );
                    }

                    $reponse = new Reponse();

                    $hydrator = new ClassMethods();
                    $hydrator->hydrate($enr, $reponse);

                    if ($mapper->add($reponse)) {
                        $this->flashMessenger()->addSuccessMessage("Merci d'avoir répondu à cette enquête");
                    } else {
                        $this->flashMessenger()->addErrorMessage("Une erreur s'est produite pendant l'envoi du formulaire");
                    }
                }




                return $this->redirect()->toRoute('home');
            }
        }


        $element = new Submit("valider");
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
