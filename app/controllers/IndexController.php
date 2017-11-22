<?php

use Phalcon\Mvc\Controller;

class IndexController extends BaseController {

    public function indexAction() {
        $this->assets->addCss('static/css/views/index/index.css');
    }

    public function searchAction() {
        $this->view->search = $this->request->getQuery('search');
    }

    public function signinAction() {
        
    }

    public function signupAction() {

    }

    public function signoutAction() {

    }

}