<?php 


$router->setDefaultController('index');
$router->setDefaultAction('index');

$router->add('/:controller/:action/:params', [
    'controller' => 1,
    'action' => 2,
    'params' => 3
]);

$router->add('/:controller/:action', [
    'controller' => 1,
    'action' => 2
]);

$router->add('/:controller', [
    'controller' => 1
]);

$router->add('/admin', [
    'controller' => 'admin',
    'action' => 'index'
]);

$router->add('/setup/admin-user', [
    'controller' => 'setup',
    'action' => 'adminUser'
]);

$router->add('/404', [
    'controller' => 'error',
    'action' => 'notfound'
]);
