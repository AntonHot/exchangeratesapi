<?php

namespace Libs;

class Db {

    /** @var array */
    protected $_config;

    /** @var \PDO */
    protected $_connect;

    /** @var Db */
    protected static $_instance;

    private function __construct() {
        $this->_config = require_once(__DIR__ . '/../config.php');
        try {
            $this->_connect = new \PDO(
                $this->_config['database']['dsn'],
                $this->_config['database']['user'],
                $this->_config['database']['password']
            );
        } catch (PDOException $e) {
            echo 'Подключиться к БД не удалось: ' . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function prepare($sql) {
        return $this->_connect->prepare($sql);
    }    
  
    private function __clone() {
    }

    private function __wakeup() {
    }     
}
