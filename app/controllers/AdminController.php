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
        $this->view->lastBooks = Book::find(['limit' => 10, 'order' => 'id DESC']);
    }
}
