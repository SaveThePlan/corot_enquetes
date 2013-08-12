<?php

namespace Application\Controller;

use Application\Entity\Proposition;
use Application\Entity\Question;
use Application\Entity\Reponse;
use Application\Form\EnqueteForm;
use Application\InputFilter\EnqueteInputFilter;
use Application\Mapper\EnqueteMapper;
use Application\Mapper\QuestionMapper;
use Application\Mapper\ReponseMapper;
use Zend\Form\Element;
use Zend\Form\Element\Submit;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\XmlRpc\Request;

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

        // submit here !
        if ($this->request->isPost()) {
            $donneesSaisies = $this->request->getPost();

            $formEnquete->setData($donneesSaisies);

            $formEnquete->setInputFilter(new EnqueteInputFilter($enquete->getListeQuestions(), $adapter));

            if ($formEnquete->isValid()) {

                $mapperReponse = new ReponseMapper($adapter);

                $donneesFiltrees = $formEnquete->getData();

                // générer un id pour le repondant
                $uidRepondant = uniqid('', false);

                foreach ($formEnquete->getElements() as $element) /* @var $element Element */ {
                    //(dé)construction de l'id question
                    $idQuestion = (int) substr($element->getName(), strlen(EnqueteForm::BASE_NAME));

                    //instance de réponse (avec pointeurs vers question et proposition)
                    $reponse = new Reponse();
                    $reponse->setUidRepondant($uidRepondant);
                    $reponse->setQuestion(new Question($idQuestion));

                    if ($element instanceof Element\Radio || $element instanceof Element\Select) {
                        $reponse->setProposition(new Proposition((int) $element->getValue()));
                    } else {
                        //element n'est ni radio ni select
                        $reponse->setContenu($element->getValue());
                    }

                    //ajout à la liste de réponse de l'enquête
                    $enquete->addListeReponses($reponse);
                }

                if ($mapper->saveResponses($enquete, $mapperReponse)) {
                    $this->flashMessenger()->addSuccessMessage("Merci d'avoir répondu à cette enquête");
                } else {
                    $this->flashMessenger()->addErrorMessage("Une erreur s'est produite pendant l'envoi du formulaire");
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
