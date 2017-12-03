<?php

use Phalcon\Mvc\Controller;

class BaseController extends Controller
{
    public function initialize()
    {
        $this->assets->addCss('https://fonts.googleapis.com/css?family=Arimo');
        $this->assets->addCss('https://fonts.googleapis.com/css?family=Kaushan+Script');
        $this->assets->addCss('static/css/normalize.css');
        $this->assets->addCss('static/flexgrid/flexboxgrid.min.css');
        $this->assets->addCss('static/font-awesome/css/font-awesome.min.css');
        $this->assets->addCss('static/css/style.css');

        $this->assets->addJs('static/js/jquery.js');
        $this->assets->addJs('static/js/jquery.mask.min.js');
        $this->assets->addJs('static/js/scripts.js');

        // $this->view->loggedUser = new \Reservas\LoggedUser();

        // $this->flashSession->error("Something went wrong!");
        // $this->flashSession->success("Everything is fine!");
        // $this->flashSession->warning("Something is maybe wrong!?");
        // $this->flashSession->notice("Hello! This is a notice message!");
    }
}
