<?php

namespace Mvc;

use Mvc\Controllers;
use Libs\Validator;
use Libs\Exceptions\ValidateException;

class Front {

    /** @var string */
    private $controller;

    /** @var string */
    private $method;
    
    /** @var string */
    private $params;

    public function __construct($data) {
        $jwt = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);

        try {
            Validator::validate($jwt);
        } catch (ValidateException $e){
            http_response_code(401);
            echo json_encode(array(
                "message" => "Access denied",
                "error" => $e->getMessage()
            ));
            die;
        }

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
                $handler = new $controller();
                $handler->$method($params);
            }
        }
    }
}
