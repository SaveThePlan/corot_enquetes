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


use Application\Form\CreerForm;
use Application\Form\EnqueteForm;
use Application\Mapper\EnqueteMapper;
use Application\Mapper\QuestionMapper;
use Application\Mapper\ReponseMapper;
use Zend\Http\Request;
use Zend\View\Model\ViewModel;
use ZfcUser\Controller\UserController;

class MembreController extends UserController
{

    /**
     *
     * @var Request
     */
    protected $request;

    /**
     * index membre = liste enquêtes
     * 
     * @return ViewModel
     */
    public function indexAction()
    {
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

    public function creerAction()
    {
        $formCreation = new CreerForm();

        if ($this->request->isPost()) {
            $donneesSaisies = $this->request->getPost()->toArray(); // == $_POST
            //remplir form avec les POST
            $formCreation->setData($donneesSaisies);
            
            // Input filter 
            
            //echo '<pre>';
            //var_dump($donneesSaisies);
            //echo '</pre>';
            // Creation de l objet Enquete
            $enqueteEntity = new \Application\Entity\Enquete;
            $enqueteEntity->setTitre($donneesSaisies['titre']);
            $enqueteEntity->setDescription($donneesSaisies['description']);
            //echo '<pre>';
            var_dump($enqueteEntity);
            //echo '</pre>';
            //unset($donneesSaisies['titre']);
            //unset($donneesSaisies['description']);
            // $count = count($donneesSaisies)/3;
            //var_dump($formCreation);
            // Liste de questions
            /* foreach() {

              }
             * 
             */
            
            // Creation de la liste de Questions
            $i = 0;
            while (isset($donneesSaisies['question' . $i], $donneesSaisies['type' . $i]) && strlen($donneesSaisies['question' . $i])) {
                var_dump($donneesSaisies['question' . $i]);



                $question = new \Application\Entity\Question(
                        0, $donneesSaisies['question' . $i], $donneesSaisies['type' . $i]);

                if ($donneesSaisies['type' . $i] == 'qcm') {
                    // si les 2 premieres questions ne sont pas chaine vide on garde la question
                    if (isset($donneesSaisies['proposition' . $i][0], $donneesSaisies['proposition' . $i][1]) && strlen($donneesSaisies['proposition' . $i][0]) && $donneesSaisies['proposition' . $i][1] != "") {
                        //echo 'merde :'.$donneesSaisies['proposition' . $i].'<br />';
                        echo 'taille:'.strlen($donneesSaisies['proposition' . $i][0]).'<br />';
                        foreach ($donneesSaisies['proposition' . $i] as $value) {
                            $proposition = new \Application\Entity\Proposition(0, $value);
                            $question->addListeChoix($proposition);
                        }
                    }
                    else {
                        unset($question);
                    }
                }
                
                $listeQuestions[] = $question;
                
                var_dump($question);




                $i++;
            }

            
            $formCreation->setInputFilter(new \Application\InputFilter\CreerInputFilter($listeQuestions, $adapter));
//            //valider le form selon les inputfilter
//            if($formCreation->isValid()){
//                $donneesFiltrees = $formCreation->getData();
//                
//                $gateway = new ContactGateway();
//                $contact = new Contact();
//                
//                //remplir l'objet avec le tableau de valeursn en utilisant les setters (ou mm)
//                $hydrator = new ClassMethods();
//                $hydrator->hydrate($donneesFiltrees, $contact);
//                $contact->setVille(new Ville($donneesFiltrees['cp']));
//                
//                
//                if($gateway->insert($contact)) {
//                    $this->flashMessenger()->addSuccessMessage("le contact a bien été créé");
//                } else {
//                    $this->flashMessenger()->addErrorMessage("une erreur est survenue, le contact n'a pu être créé");
//                }
//                
//                return $this->redirect()->toRoute('liste_contacts');
//            }
        }

        return new ViewModel(
                array(
            'formCreation' => $formCreation
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

    public function consulterAction()
    {
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

        $enquete->setListeQuestions($listeQuestions);

        $mapperResultat = new ReponseMapper($adapter);
        $listeResultats = $mapperResultat->countRepondantsByIdEnquete($idEnquete);

        $enquete->setListeQuestions($listeQuestions);

        $formEnquete = new EnqueteForm($listeQuestions, $adapter);

        return new ViewModel(
                array(
            'enquete' => $enquete,
            'formEnquete' => $formEnquete
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
//        if (!$this->zfcUserAuthentication()->hasIdentity()) {
//            return $this->redirect()->toRoute(static::ROUTE_LOGIN);
//        }

        return;
    }

}