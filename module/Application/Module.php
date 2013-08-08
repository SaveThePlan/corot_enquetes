<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Entity\User;
use Application\Mapper\UserMapper;
use Application\ZfcUser\UserHydrator;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use ZfcUser\Form\Register;
use ZfcUser\Form\RegisterFilter;
use ZfcUser\Validator\NoRecordExists;

class Module {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                /* 'UserForm' => function ($sm) {
                  $form = new \Application\Form\UserForm(null, $options);
                  return $form;
                  },
                 * 
                 */
                /*
                  'zfcuser_login_form' => function($sm) {
                  $options = $sm->get('zfcuser_module_options');
                  $form = new \ZfcUser\Form\Login(null, $options);
                  $form->add($elementOrFieldset);
                  $form->setInputFilter(new \ZfcUser\Form\LoginFilter($options));
                  return $form;
                  },
                 * 
                 */
                'zfcuser_register_form' => function ($sm) {
                    $options = $sm->get('zfcuser_module_options');
                    $form = new Register(null, $options);

                    //Ajout de champs :
                    $form->add(array(
                        'name' => 'photo',
                        'options' => array(
                            'label' => 'Photo',
                        ),
                        'attributes' => array(
                            'type' => 'text'
                        ),
                    ));


                    //$form->setCaptchaElement($sm->get('zfcuser_captcha_element'));
                    $form->setInputFilter(new RegisterFilter(
                            new NoRecordExists(array(
                        'mapper' => $sm->get('zfcuser_user_mapper'),
                        'key' => 'email'
                            )), new NoRecordExists(array(
                        'mapper' => $sm->get('zfcuser_user_mapper'),
                        'key' => 'username'
                            )), $options
                    ));
                    return $form;
                },
                //$sm->get('Album\Model\AlbumTable');
                // Override ZfcUser User Mapper factory
                'zfcuser_user_mapper' => function ($sm) {
                    $options = $sm->get('zfcuser_module_options');
                    $entityClass = $options->getUserEntityClass();

//                    $mapper = new \Application\Mapper\UserMapper($sm->get('Zend\Db\Adapter\Adapter'));
                    $mapper = new UserMapper();
                    $mapper->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
                    $mapper->setEntityPrototype(new User());
                    $mapper->setHydrator(new UserHydrator());
                    
//                    $mapper->setHydrator(new \ZfcUser\Mapper\UserHydrator());
                    $mapper->setTableName($options->getTableName());
                    return $mapper;
                },
            ),
        );
    }

}
