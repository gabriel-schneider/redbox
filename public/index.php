<?php

error_reporting( E_ALL );

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

$di = new Phalcon\Di\FactoryDefault();

$di->set('view', function() {
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

$di->set('router', function () {
    $router = new Phalcon\Mvc\Router();
    $router->setDefaultController('index');
    $router->add('/search', [
        'action' => 'search'
    ]);
    $router->add('/signin', [
        'action' => 'signin'
    ]);
    return $router;
});

$di->set('url', function() {
    $url = new Phalcon\Mvc\Url();
    $url->setBaseUri('/uniritter-reservas/');
    return $url;
});

$di->set('assets', function() {
    $assetManager = new Phalcon\Assets\Manager();
    return $assetManager;
});

$loader = new \Phalcon\Loader();
$loader->registerDirs([
    APP_PATH . "/controllers"
]);
$loader->register();


$application = new \Phalcon\Mvc\Application($di);

echo $application->handle()->getContent();