<?php

namespace Mvc\Controllers;

use Libs\Db;

class CurrencyController {

    public function exec($params) {
        $db = Db::getInstance();

        $sql = 'SELECT * FROM currency WHERE id = ?';
        $pdoStatePrepared = $db->prepare($sql);
        $pdoStatePrepared->execute([$params['id']]);
        $resultRaw= $pdoStatePrepared->fetch();

        $result = [
            'name' => $resultRaw['name'],
            'rate' => $resultRaw['rate']
        ];
        
        echo json_encode($result, JSON_FORCE_OBJECT);
    }
}