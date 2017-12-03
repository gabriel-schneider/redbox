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

$router->add('/signout', [
    'action' => 'signout'
]);

$router->add('/account', [
    'action' => 'account'
]);

$router->add('/history', [
    'action' => 'history'
]);

$router->add('/cancel/{bookId}', [
    'controller' => 'book',
    'action' => 'cancel',
]);

$router->add('/detail/{token}', [
    'controller' => 'book',
    'action' => 'detail',
    //'params' => 1
]);

$router->add('/404', [
    'controller' => 'error',
    'action' => 'notfound'
]);
