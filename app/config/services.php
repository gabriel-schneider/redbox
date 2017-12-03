<?php

$di = new Phalcon\Di\FactoryDefault();

$di->set('view', function () {
    $view = new \Phalcon\Mvc\View();
    $view->setViewsDir(APP_PATH . '/views/');
    $view->setPartialsDir('partials/');
    $view->registerEngines([
        ".volt" => function ($view, $di) {
            $volt = new Phalcon\Mvc\View\Engine\Volt($view, $di);
            $volt->setOptions([
                "compileAlways" => true,
                "compiledPath" => BASE_PATH . '/cache/',
                "compiledSeparator" => '_'
            ]);
            return $volt;
        }
    ]);


    return $view;
});

$di->set('dispatcher', function () use ($di) {
    $dispatcher = new Phalcon\Mvc\Dispatcher();
    $eventsManager = new Phalcon\Events\Manager();

    $eventsManager->attach('dispatch:beforeException', function ($event, $dispatcher, $exception) {
        // @TODO: Passar isso para um método que trate a exception de forma mais limpa
        switch ($exception->getCode()) {
            case \Phalcon\Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
            case \Phalcon\Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                $dispatcher->forward([
                    'controller' => 'error',
                    'action' => 'notfound'
                ]);
                return false;
        }
    });

    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});

$di->set('security', function () {
    $security = new \Phalcon\Security();
    $security->setWorkFactor(12);

    return $security;
});

$di->set('db', function () {
    $db = new \Phalcon\Db\Adapter\Pdo\Mysql([
        "host" => "localhost",
        "dbname" => "reservas",
        "port"  => 3306,
        "username" => "root",
        "password" => "root"
    ]);

    return $db;
});

$di->set('modelsMetadata', function () {
    return new Phalcon\Mvc\Model\MetaData\Memory();
});

$di->set('session', function () {
    $session = new \Phalcon\Session\Adapter\Files();
    $session->start();
    
    return $session;
});

$di->set('flashSession', function () {
    $flashSession = new \Phalcon\Flash\Session([
        "error" => "message error",
        "warning" => "message warning",
        "notice" => "message notice",
        "success" => "message success",
    ]);
    return $flashSession;
});

$di->set('url', function () {
    $url = new \Phalcon\Mvc\Url();
    $url->setBaseUri('/uniritter-reservas/');
    return $url;
});

$di->set('assets', function () {
    $assetManager = new \Phalcon\Assets\Manager();
    return $assetManager;
});

$di->set('router', function () {
    $router = new \Phalcon\Mvc\Router();
    require(CONFIG_PATH . '/routes.php');
    return $router;
});

$di->set('loggedUser', function () {
    return new \Reservas\LoggedUser();
});
