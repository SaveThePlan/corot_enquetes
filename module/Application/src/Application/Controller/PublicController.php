<?php

namespace Application\Controller;

use Application\Mapper\EnqueteMapper;
use Application\Mapper\QuestionMapper;
use Application\Mapper\ReponseMapper;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\Hydrator\ClassMethods;

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


        $formEnquete = new \Application\Form\EnqueteForm($enquete->getListeQuestions(), $adapter);

        if ($this->request->isPost()) {
            $donneesSaisies = $this->request->getPost();
//            echo '<pre>';
//            var_dump($donneesSaisies);
//            echo '</pre>';
            //$formEnquete->setData();
            $formEnquete->setData($donneesSaisies);
            //$formEnquete->
            $formEnquete->setInputFilter(new \Application\InputFilter\EnqueteInputFilter($enquete->getListeQuestions(), $adapter));

            if ($formEnquete->isValid()) {
                echo 'valid';

                $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $mapper = new ReponseMapper($adapter);

                $donneesFiltrees = $formEnquete->getData();
                //echo 'ok';
//                echo '<pre>';
//                var_dump($donneesFiltrees);
//                echo '</pre>';
                // générer un id pour le repondant
                $uiRepondant = uniqid('', false);
                foreach ($donneesFiltrees as $nameQ => $valueQ) {
                    $tabQ = explode('_', $nameQ);
                    $idQ = $tabQ[2];
                    //echo 'idQ' . $idQ . '<br />';
                    $typeQ = $tabQ[1];
                    //echo 'typeQ' . $typeQ . '<br />';
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




                    $reponse = new \Application\Entity\Reponse();

                    $hydrator = new ClassMethods();
                    $hydrator->hydrate($enr, $reponse);

//                    echo '<pre>';
//                    var_dump($reponse);
//                    echo '</pre>';


                    if ($mapper->add($reponse)) {
                        $this->flashMessenger()->addSuccessMessage("Merci d'avoir répondu à cette enquête");
                    } else {
                        $this->flashMessenger()->addErrorMessage("Une erreur s'est produite pendant l'envoi du formulaire");
                    }
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
