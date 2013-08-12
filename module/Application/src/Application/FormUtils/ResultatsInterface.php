<?php

namespace Application\FormUtils;

use Application\Entity\Question;

/**
 *
 * @author USER
 */
interface ResultatsInterface {
    
    const BASE_NAME = 'resultat';

    public function dispatcher(Question $question);

    public function resultatText(Question $question);

    public function resultatNb(Question $question);

    public function resultatQcm(Question $question);

}
