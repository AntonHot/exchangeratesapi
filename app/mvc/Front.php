<?php

namespace Mvc;

use Mvc\Controllers;

class Front {

    private $controller;
    private $method;
    private $params;

    public function __construct($data) {
        $this->controller = $data['controller'];
        $this->method = $data['method'];
        $this->params = $data['params'];
    }

    public function init() {
        $controller = 'Mvc\\Controllers\\' . $this->controller . 'Controller';
        $method = $this->method;
        $params = $this->params;
        
        if (class_exists($controller)) {
            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], [$params]);
            }
        }
    }

}