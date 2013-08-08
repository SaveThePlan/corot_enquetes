<?php
return array(
        'db' => array(
        'driver' => 'pdo',
        'dsn' => 'mysql:host=localhost;dbname=sondages;',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    /*
    'service_manager' => array(
        'factories' => array(
            //'Zend\Db\Adapter\Adapter'
            //=> 'Zend\Db\Adapter\AdapterServiceFactory',
            //$confDb = $this->get('Config');
            'Zend\Db\Adapter\Adapter' => function ($sm) {
                // TODO recup param db de db.local et db.global et remplacer l'array ci-dessous
                //$dbParams = $sm->get('db');
                $adapter = new BjyProfiler\Db\Adapter\ProfilingAdapter(array(
                    'driver' => 'pdo',
                    'dsn' => 'mysql:dbname=zf2tutorial;host=localhost',
                    'driver_options' => array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
                    ),
                    'username' => 'root',
                    'password' => '',
                   
                   // 'driver'    => 'pdo',
                   // 'dsn'       => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
                    //'database'  => $dbParams['database'],
                    //'username'  => $dbParams['username'],
                    //'password'  => $dbParams['password'],
                    //'hostname'  => $dbParams['hostname'],
                     
                ));

                if (php_sapi_name() == 'cli') {
                    $logger = new Zend\Log\Logger();
                    // write queries profiling info to stdout in CLI mode
                    $writer = new Zend\Log\Writer\Stream('php://output');
                    $logger->addWriter($writer, Zend\Log\Logger::DEBUG);
                    $adapter->setProfiler(new BjyProfiler\Db\Profiler\LoggingProfiler($logger));
                } else {
                    $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler());
                }
                if (isset($dbParams['options']) && is_array($dbParams['options'])) {
                    $options = $dbParams['options'];
                } else {
                    $options = array();
                }
                $adapter->injectProfilingStatementPrototype($options);
                return $adapter;
            },
        ),
    ),
     * 
     */
);