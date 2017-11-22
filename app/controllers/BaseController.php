<?php

use Phalcon\Mvc\Controller;

class BaseController extends Controller {

    public function initialize() {
        
        $this->assets->addCss('https://fonts.googleapis.com/css?family=Arimo');
        $this->assets->addCss('static/css/normalize.css');
        $this->assets->addCss('static/flexgrid/flexboxgrid.min.css');
        $this->assets->addCss('static/css/style.css');
    
        //$this->assets->addJs('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');

        $this->view->navbarItems = [
            "Pesquisar", "Teste", "Abc"
        ];

        $this->view->logged = false;
    }

}