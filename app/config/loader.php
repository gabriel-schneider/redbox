<?php

$loader = new \Phalcon\Loader();

$loader->registerDirs([
    APP_PATH . "/controllers",
    BASE_PATH . "/library"
]);

$loader->registerNamespaces([
    "Reservas" => BASE_PATH . "/library/reservas/",
]);

$loader->register();