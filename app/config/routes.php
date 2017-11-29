<?php 
  
$router->setDefaultController('index');
$router->add('/search', [
    'action' => 'search'
]);

$router->add('/signin', [
    'action' => 'signin'
]);

$router->add('/signup', [
    'action' => 'signup'
]);

$router->add('/404', [
    'controller' => 'error',
    'action' => 'notfound'
]);
