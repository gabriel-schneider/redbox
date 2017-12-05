<?php

use Phalcon\Mvc\Controller;

class AdminController extends BaseController
{
    public function beforeExecuteRoute()
    {
        if (!$this->loggedUser->isAdmin()) {
            $this->reponse->redirect('');
            return false;
        }
    }

    public function indexAction()
    {
        $this->assets->addCss('static/css/views/index/index.css');
        $user = User::findFirst(1);
        $this->view->user = $user;
    }
}
