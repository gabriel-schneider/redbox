<?php

error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('CONFIG_PATH', APP_PATH . '/config');

require(CONFIG_PATH . '/loader.php');

require(CONFIG_PATH . '/services.php');

$application = new \Phalcon\Mvc\Application($di);

echo $application->handle()->getContent();
