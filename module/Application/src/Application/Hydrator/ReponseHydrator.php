<?php

namespace Application\Hydrator;

use Application\Entity\Proposition;
use Application\Entity\Question;
use Application\Entity\Reponse;
use Zend\Stdlib\Exception\InvalidArgumentException as InvalidArgumentException2;
use Zend\Stdlib\Hydrator\ClassMethods;
use ZfcUser\Mapper\UserInterface;
use ZfcUser\Validator\Exception\InvalidArgumentException;

class ReponseHydrator extends ClassMethods
{
    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     * @throws InvalidArgumentException
     */
    public function extract($object)
    {
        if (!$object instanceof Reponse) {
            throw new InvalidArgumentException2('$object must be an instance of Application\Entity\Reponse');
        }
        /* @var $object UserInterface*/
        $data = parent::extract($object);
        $data = $this->mapField('question', 'id_question', $data);
        $data = $this->mapField('proposition', 'id_proposition', $data);
        if(!strlen($data['contenu'])) {
            unset($data['contenu']);
        } else {
            unset($data['id_proposition']);
        }
        return $data;
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return UserInterface
     * @throws InvalidArgumentException
     */
//    public function hydrate(array $data, $object)
//    {
//        if (!$object instanceof UserEntityInterface) {
//            throw new Exception\InvalidArgumentException('$object must be an instance of ZfcUser\Entity\UserInterface');
//        }
//        $data = $this->mapField('id', 'id', $data);
//        $data = $this->mapField('user_id', 'id', $data);
//        return parent::hydrate($data, $object);
//    }

    protected function mapField($keyFrom, $keyTo, array $array)
    {
        $array[$keyTo] = ($array[$keyFrom] instanceof Question || 
                          $array[$keyFrom] instanceof Proposition)? $array[$keyFrom]->getId() : NULL;
        unset($array[$keyFrom]);
        return $array;
    }
}
