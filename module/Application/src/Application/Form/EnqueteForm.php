<?php //

namespace Application\Form;

use Application\Entity\Proposition;
use Application\Entity\Question;
use Application\FormUtils\AbstractEnqueteForm;
use Application\Mapper\PropositionMapper;
use Zend\Db\Adapter\Adapter;
use Zend\Form\Element\Number;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;



class EnqueteForm extends AbstractEnqueteForm {

    /**
     *
     * @var PropositionMapper
     */
    protected $mapperPropositions;

    /**
     * $listeQuestions est un tableau d'objets Question
     * 
     * @param array $listeQuestions
     */
    public function __construct($listeQuestions, Adapter $adapter) {
        parent::__construct("enquete");

        $this->mapperPropositions = new PropositionMapper($adapter);

        foreach ($listeQuestions as $question) /* @var $question Question */ {
            
            if($element = $this->dispatcher($question)) {
                $this->add($element);
            }
            
        }
    }

    public function questionText(Question $question) {
        $element = new Text('question_text_' . $question->getId());
        $element->setLabel($question->getLibelle())
                ->setAttributes(array(
                    'id' => 'question' . $question->getId()
        ));

        return $element;
    }

    public function questionNb(Question $question) {
        $element = new Number('question_nb_' . $question->getId());
        $element->setLabel($question->getLibelle())
                ->setAttributes(array(
                    'id' => 'question' . $question->getId()
        ));

        return $element;
    }

    public function questionQcm(Question $question) {
        $listechoix = $this->mapperPropositions->getAllByIdQuestion($question->getId());

        $options = array();

        foreach ($listechoix as $choix) { /* @var $choix Proposition */
            $options[$choix->getId()] = $choix->getLibelle();
        }

        // si il y a moins de 5 réponses possibles, on affiche des boutons radio
        if (count($listechoix) < 5) {
            $element = new Radio('question_qcm_' . $question->getId());
        } else {

            //sinon on affiche une liste
            $element = new Select('question_qcm_' . $question->getId());
        }

        $element->setLabel($question->getLibelle());
        $element->setValueOptions($options)
                ->setValue($listechoix[0]->getId());

        return $element;
    }

}
