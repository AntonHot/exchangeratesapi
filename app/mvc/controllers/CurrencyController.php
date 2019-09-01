<?php

namespace Mvc\Controllers;

class CurrencyController extends BaseController {

    public function exec($params) {
        $sql = 'SELECT * FROM ' . $this->_table . ' WHERE id = ?';
        $pdoStatePrepared = $this->_db->prepare($sql);
        $pdoStatePrepared->execute([$params['id']]);
        $resultRaw= $pdoStatePrepared->fetch();

        $result = [
            'id' => $resultRaw['id'],
            'name' => $resultRaw['name'],
            'rate' => $resultRaw['rate']
        ];

        http_response_code(200);
        $this->setHeaders();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}