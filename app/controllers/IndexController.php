<?php

use Phalcon\Mvc\Controller;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $this->assets->addCss('static/css/views/index/index.css');
        $user = User::findFirst(1);
        $this->view->user = $user;
    }

}
