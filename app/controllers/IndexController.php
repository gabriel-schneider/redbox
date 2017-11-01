<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller {

    public function initialize() {
        $this->assets->addCss('static/bootstrap/css/bootstrap.min.css');
        $this->assets->addCss('static/css/style.css');
        $this->assets->addJs('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js');
    }

    public function indexAction() {
        $this->view->name = "Bob";
    }
}