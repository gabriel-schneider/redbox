<?php

use Phalcon\Mvc\Controller;

class ErrorController extends BaseController {

    public function notfoundAction() {
        $this->response->setStatusCode(404, 'Not Found');    
    }

}