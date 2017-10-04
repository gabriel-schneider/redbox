<?php


define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

$di = new Phalcon\Di\FactoryDefault();

$di->set('view', function() {
    $view = new \Phalcon\Mvc\View();
    $view->setViewsDir(APP_PATH . '/views/');

    $view->registerEngines([
        ".html" => function ($view, $di) {
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

$loader = new \Phalcon\Loader();
$loader->registerDirs([
    APP_PATH . "/controllers"
]);
$loader->register();


$application = new \Phalcon\Mvc\Application($di);

echo $application->handle()->getContent();