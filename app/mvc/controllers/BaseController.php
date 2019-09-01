<?php

namespace Mvc\Controllers;

use Libs\Db;

class BaseController {

    protected $_db;
    protected $_table = 'currency';
    
    public function __construct() {
        $this->_db = Db::getInstance();
    }

    protected function setHeaders() {
        header("Content-Type: application/json; charset=utf8");
    }
}